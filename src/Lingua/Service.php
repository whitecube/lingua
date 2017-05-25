<?php 

namespace WhiteCube\Lingua;

class Service
{
    static protected $defaultFormat = 'W3C';

    protected $output;

    private $converter;

    public function __construct($output = null)
    {
        $this->output = is_null($output) ? static::$defaultFormat : $output;
    }

    public function __toString()
    {
        //  TODO : this is not correct, should call $this->convert();
        return call_user_func([$this->converter, 'to' . ucfirst($this->output)]);
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
        $instance = new static();
        call_user_func_array([$instance, $method], $arguments);
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
        $converter = __NAMESPACE__ . '\\' . ucfirst(trim(substr(strtolower($method), strlen($prefix)), '_')) . 'Converter';
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
    public function fromISO639_1($iso)
    {
        $this->setFormatLookup('ISO639-1', $iso);
        return $this;
    }

    public function fromISO639_2t($iso)
    {
        $this->setFormatLookup('ISO639-2/t', $iso);
        return $this;
    }

    public function fromISO639_2b($iso)
    {
        $this->setFormatLookup('ISO639-2/b', $iso);
        return $this;
    }

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
