<?php 

namespace WhiteCube\Lingua;

class Iso_639_1Converter extends Converter implements ConverterInterface
{
    public static function check(string $format)
    {
        if(preg_match('/^([A-Za-z]){2}$/', static::prepare($format))) return true;
        return false;
    }

    public function parse()
    {
        $this->repository = LanguagesRepository::find('iso-639-1', $this->original);
        $this->iso_639_1 = $this->original;
        $this->iso_639_2t = $this->repository ? $this->repository['iso-639-2t'] : '';
        $this->iso_639_2b = $this->repository ? $this->repository['iso-639-2b'] : '';
    }

    public static function format(ConverterInterface $converter)
    {
        return $converter->iso_639_1;
    }
}
