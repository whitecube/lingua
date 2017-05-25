<?php 

namespace WhiteCube\Lingua;

class NameConverter extends Converter implements ConverterInterface
{
    public static function prepare(string $string)
    {
        return strtolower(trim($string));
    }

    public static function check(string $format)
    {
        if(LanguagesRepository::find('name', self::prepare($format))) return true;
        return false;
    }

    public function validate()
    {
        if(!self::check($this->original)) {
            throw new Exception('Unable to find language named "' . $this->original . '"');
        }
        return true;
    }

    public function parse()
    {
        $this->repository = LanguagesRepository::find('name', $this->original);
    }

    public static function format(ConverterInterface $converter)
    {
        if(!$converter->repository) {
            throw new Exception('Language "' . $converter->getName() . '" could not be converted to its english name, because it is not registered in the Lingua repository');
        }
        return $converter->repository['name'];
    }
}
