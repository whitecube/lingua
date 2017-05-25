<?php 

namespace WhiteCube\Lingua;

class NameConverter extends Converter implements ConverterInterface
{
    public static function check(string $format)
    {
        if(LanguagesRepository::find('name', self::prepare($format))) return true;
        return false;
    }

    public function validate()
    {
        if(!self::check($this->original)) {
            throw new \Exception('Unable to find language named "' . $this->original . '"');
        }
        return true;
    }

    public function parse()
    {
        $this->repository = LanguagesRepository::find('name', $this->original);
        $this->iso_639_1 = $this->repository['iso-639-1'];
        $this->iso_639_2t = $this->repository['iso-639-2t'];
        $this->iso_639_2b = $this->repository['iso-639-2b'];
    }

    public static function format(ConverterInterface $converter)
    {
        if(!$converter->repository) {
            throw new \Exception('Language "' . $converter->getName() . '" could not be converted to its english name since it is not registered in the Lingua repository');
        }
        return $converter->repository['name'];
    }
}
