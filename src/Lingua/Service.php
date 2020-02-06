<?php

namespace WhiteCube\Lingua;

/**
 * @method static static createFromName(string $string)
 * @method static static createFromNative(string $string)
 * @method static static createFromISO_639_1(string $string)
 * @method static static createFromISO_639_2b(string $string)
 * @method static static createFromISO_639_2t(string $string)
 * @method static static createFromISO_639_3(string $string)
 * @method static static createFromPHP(string $string)
 * @method static static createFromW3C(string $string)
 * @method self fromName(string $string)
 * @method self fromNative(string $string)
 * @method self fromISO_639_1(string $string)
 * @method self fromISO_639_2b(string $string)
 * @method self fromISO_639_2t(string $string)
 * @method self fromISO_639_3(string $string)
 * @method self fromPHP(string $string)
 * @method self fromW3C(string $string)
 * @method string toName()
 * @method string toNative()
 * @method string toISO_639_1()
 * @method string toISO_639_2b()
 * @method string toISO_639_2t()
 * @method string toISO_639_3()
 * @method string toPHP()
 * @method string toW3C()
 */
class Service
{
    static protected $defaultFormat = 'w3c';

    static protected $converters = [
        Iso_639_1Converter::class,
        Iso_639_2bConverter::class,
        Iso_639_2tConverter::class,
        Iso_639_3Converter::class,
        W3cConverter::class,
        PhpConverter::class,
        NameConverter::class,
        NativeConverter::class
    ];

    protected $output;

    private $converter;

    public function __construct($output = null)
    {
        $this->output = $output;
    }

    public function __toString()
    {
        return $this->convert($this->output ?? self::$defaultFormat);
    }

    public function __call($method, $arguments = [])
    {
        if(strpos($method, 'from') === 0) return $this->makeConverter($method, $arguments);
        if(strpos($method, 'to') === 0) return $this->convert($method, $arguments);
        throw new \Exception('Call to undefined Lingua method "' . $method . '"');
    }

    public static function __callStatic($method, $arguments = [])
    {
        $method = self::sanitizeInstantiationMethod($method);
        $instance = new static(count($arguments) == 2 ? $arguments[1] : null);
        call_user_func_array([$instance, $method], [$arguments[0]]);
        return $instance;
    }

    /**
    * Sets default output format for all default __toString calls
    * @param string $format
    * @return void
    */
    static function setFormat($format)
    {
        self::$defaultFormat = $format;
    }

    /**
    * Guesses the given format and returns a converter instance
    * @param string $code
    * @return static
    */
    static function create(string $code)
    {
        $instance = new static();
        if($instance->guess($code)) return $instance;
        throw new \Exception('Unable to guess the format for input string "' . $code . '"');
    }

    /**
    * Cleans static method names in order to make them forwardable on instanciated class
    * @param string $method
    * @return string
    */
    static protected function sanitizeInstantiationMethod($method)
    {
        if (strpos($method, 'create') === false) {
            throw new \Exception('Instantiation methods should begin with "create"');
        }
        return lcfirst(trim(substr($method, 6), '_'));
    }

    /**
    * Transforms a method name to converter name
    * @param string $method
    * @param string $prefix
    * @return string
    */
    static protected function transformConverterMethod($method, $prefix)
    {
        $method = strpos($method, $prefix) === 0 ? substr($method, strlen($prefix)) : $method;
        $method = ucfirst(str_replace('-', '_', trim(strtolower($method), '_')));
        $converter = __NAMESPACE__ . '\\' . $method . 'Converter';
        if (!class_exists($converter)) {
            throw new \Exception('Call to undefined "'. $prefix . '" Lingua method');
        }
        return $converter;
    }

    /**
    * Instantiates the right converter for given input string (any)
    * @param string $format
    * @return boolean
    */
    protected function guess(string $format)
    {
        $matches = [];
        foreach (self::$converters as $key => $converter) {
            if(!call_user_func_array($converter . '::check', [$format])) continue;
            $converter = new $converter($format);
            array_unshift($matches, $converter);
            if($converter->repository) break;
        }
        if(!$matches) return false;
        $this->converter = $matches[0];
        return true;
    }

    /**
    * Instantiates the right converter for given convertion method
    * @param string $method
    * @param array $arguments
    * @return $this
    */
    protected function makeConverter($method, $arguments = [])
    {
        $converter = self::transformConverterMethod($method, 'from');
        $this->converter = new $converter($arguments[0]);
        return $this;
    }

    /**
    * Calls the right static conversion method for given method
    * @param string $method
    * @param array $arguments
    * @return string
    */
    protected function convert($method, $arguments = [])
    {
        $converter = self::transformConverterMethod($method, 'to');
        return call_user_func_array($converter . '::format', [$this->converter]);
    }

}
