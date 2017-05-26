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
            if($format == 'iso-639-3' && strpos($language[$format], $value) === 0) return $language;
        }
        return false;
    }

    protected function loadRepository()
    {
        if(!$this->path) {
            throw new \Exception('Lingua\'s languages repository could not be loaded');
        }
        return include($this->path);
    }
}
