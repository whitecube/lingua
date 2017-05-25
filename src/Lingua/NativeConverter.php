<?php 

namespace WhiteCube\Lingua;

class NativeConverter extends Converter implements ConverterInterface
{
    public static function check(string $format)
    {
        if(LanguagesRepository::find('native', self::prepare($format))) return true;
        return false;
    }

    public function validate()
    {
        if(!self::check($this->original)) {
            throw new \Exception('Unable to find native language named "' . $this->original . '"');
        }
        return true;
    }

    public function parse()
    {
        $this->repository = LanguagesRepository::find('native', $this->original);
        $this->iso_639_1 = $this->repository['iso-639-1'];
    }

    public static function format(ConverterInterface $converter)
    {
        if(!$converter->repository) {
            throw new \Exception('Language "' . $converter->getName() . '" could not be converted to its native name, because it is not registered in the Lingua repository');
        }
        return $converter->repository['native'];
    }
}
