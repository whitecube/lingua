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

    public $script;

    public $country;

    public function __construct($format)
    {
        $this->script = $this->getEmptyNameBag();
        $this->country = $this->getEmptyNameBag();
        $this->original = static::prepare($format);
        if($this->validate()) $this->parse();
    }

    public function __toString()
    {
        return $this->original;
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
        return mb_strtolower(trim($string));
    }

    protected function getEmptyNameBag()
    {
        $item = new \stdClass();
        $item->name = null;
        $item->code = null;
        return $item;
    }
}
