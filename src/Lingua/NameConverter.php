<?php 

namespace WhiteCube\Lingua;

class NameConverter extends Converter implements ConverterInterface
{
    public static function check($format)
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
        $this->iso_639_3 = $this->repository['iso-639-3'];
    }

    public static function format(ConverterInterface $converter)
    {
        if(!$converter->repository) {
            throw new \Exception('Language "' . $converter . '" could not be converted to its english name since it is not registered in the Lingua repository');
        }
        $string = $converter->repository['name'];
        if(!$converter->script->name && !$converter->country->name) return $string;
        $string .= ' (';
        if($converter->script->name) $string .= $converter->script->name;
        if($converter->script->name && $converter->country->name) $string .= ', ';
        if($converter->country->name) $string .= $converter->country->name;
        return $string . ')';
    }
}
