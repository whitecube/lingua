<?php 

namespace WhiteCube\Lingua;

class Converter
{
    protected $original;

    public $repository;

    public $iso_639_1;

    public $iso_639_2t;

    public function __construct($format)
    {
        $this->original = static::prepare($format);
        if($this->validate()) $this->parse();
    }

    public function getName()
    {
        if($this->repository) return $this->repository->name;
        if($this->iso_639_1) return $this->iso_639_1;
        if($this->iso_639_2t) return $this->iso_639_2t;
    }

    public function validate()
    {
        if(!static::check($this->original)) {
            throw new \Exception('Unable to create language from "' . $this->original . '"');
        }
        return true;
    }

    public static function prepare(string $string)
    {
        return strtolower(trim($string));
    }
}
