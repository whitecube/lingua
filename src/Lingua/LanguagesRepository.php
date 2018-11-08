<?php

namespace WhiteCube\Lingua;

class LanguagesRepository
{
    protected static $instance;

    public $languages;

    protected $path;


    public function __construct()
    {
        $this->path = realpath(__DIR__ . '/../../languages.php');
        $this->languages = $this->loadRepository();
    }

    protected static function getInstance()
    {
        if(is_null(self::$instance)) self::$instance = new self();
        return self::$instance;
    }

    public static function find($format, $value)
    {
        $instance = self::getInstance();
        foreach ($instance->languages as $language) {
            if(!isset($language[$format])) continue;
            if($language[$format] == $value) return $language;
            if(self::hasDeprecated($language, $format, $value)) return $language;
            if($format == 'iso-639-3' && strpos($language[$format], $value) === 0) return $language;
        }
    }

    public static function hasDeprecated($language, $format, $value)
    {
        return isset($language['deprecated']) && isset($language['deprecated'][$format]) && $language['deprecated'][$format] == $value;
    }

    public static function register(array $definition)
    {
        $instance = self::getInstance();
        $instance->languages[] = array_replace_recursive([
            'name' => '',
            'native' => '',
            'iso-639-1' => '',
            'iso-639-2t' => '',
            'iso-639-2b' => '',
            'iso-639-3' => '',
            'countries' => [],
            'scripts' => []
        ], $definition);
    }

    protected function loadRepository()
    {
        if(!$this->path) {
            throw new \Exception('Lingua\'s languages repository could not be loaded');
        }
        return include($this->path);
    }
}
