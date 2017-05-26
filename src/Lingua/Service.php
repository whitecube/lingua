<?php 

namespace WhiteCube\Lingua;

class Service
{
    static protected $defaultFormat = 'name';

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
        throw new \Exception('Call to undefined Lingua method');
        
    }

    public static function __callStatic($method, $arguments = [])
    {
        $method = self::sanitizeInstanciationMethod($method);
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
    * @return this
    */
    static function create($code)
    {
        $instance = new static();
        $instance->guess($code);
        return $instance;
    }

    /**
    * Cleans static method names in order to make them forwardable on instanciated class
    * @param string $method
    * @return string
    */
    static protected function sanitizeInstanciationMethod($method)
    {
        if (strpos($method, 'create') < 0) {
            throw new \Exception('Instanciation methods should begin with "create"');
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
    * Parses given string (any)
    * @param string $name
    * @return this
    */
    protected function guess($format)
    {
        //  TODO : condition against the check() method of every converter
    }

    protected function makeConverter($method, $arguments = [])
    {
        $converter = self::transformConverterMethod($method, 'from');
        $this->converter = new $converter($arguments[0]);
        return $this;
    }

    protected function convert($method, $arguments = [])
    {
        $converter = self::transformConverterMethod($method, 'to');
        return call_user_func_array($converter. '::format', [$this->converter]);
    }

    /**
    public function fromISO639_3($iso)
    {
        $this->setFormatLookup('ISO639-3', $iso);
        return $this;
    }

    public function fromW3C($string)
    {
        $this->setFormatLookup('W3C', $string);
        return $this;
    }

    public function fromPHP($string)
    {
        $this->setFormatLookup('PHP', $string);
        return $this;
    }

    */
}
