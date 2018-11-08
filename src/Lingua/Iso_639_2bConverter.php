<?php 

namespace WhiteCube\Lingua;

class Iso_639_2bConverter extends Converter implements ConverterInterface
{
    public static function check($format)
    {
        if(preg_match('/^([A-Za-z]{3})$/', static::prepare($format))) return true;
        return false;
    }

    public function parse()
    {
        $this->repository = LanguagesRepository::find('iso-639-2b', $this->original);
        $this->iso_639_1 = $this->repository ? $this->repository['iso-639-1'] : '';
        $this->iso_639_2t = $this->repository ? $this->repository['iso-639-2t'] : $this->original;
        $this->iso_639_2b = $this->repository ? $this->repository['iso-639-2b'] : '';
        $this->iso_639_3 = $this->repository ? $this->repository['iso-639-3'] : $this->original;
    }

    public static function format(ConverterInterface $converter)
    {
        return $converter->iso_639_2b;
    }
}
