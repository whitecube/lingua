<?php 

namespace WhiteCube\Lingua;

class Converter
{
    protected $original;

    public $repository;

    public $iso_639_1;

    public $iso_639_2t;

    public $iso_639_2b;

    public $iso_639_3;

    public function __construct($format)
    {
        $this->original = static::prepare($format);
        if($this->validate()) $this->parse();
    }

    public function __toString()
    {
        return $this->original;
    }

    public function getName()
    {
        if($this->repository) return $this->repository->name;
        if($this->iso_639_3) return $this->iso_639_3;
        if($this->iso_639_2t) return $this->iso_639_2t;
        if($this->iso_639_2b) return $this->iso_639_2b;
        if($this->iso_639_1) return $this->iso_639_1;
    }

    public function validate()
    {
        if(!static::check($this->original)) {
            throw new \Exception('Unable to create language from "' . $this . '"');
        }
        return true;
    }

    public static function prepare(string $string)
    {
        return strtolower(trim($string));
    }
}
