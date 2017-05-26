<?php 

namespace WhiteCube\Lingua;

class Iso_639_3Converter extends Converter implements ConverterInterface
{
    public function __toString()
    {
        $string = $this->original['code'] ?? $this->original['full'];
        if($this->original['macro']){
            $string .= ' + ' . $this->original['macro'];
        }
        return $string;
    }

    public static function prepare(string $string)
    {
        $string = strtolower(trim($string));
        preg_match('/^([A-Za-z]{3})(?:\s*\+\s*(\d+))?$/', $string, $matches);
        return [
            'full' => $string,
            'code' => $matches[1] ?? null,
            'macro' => $matches[2] ?? null
        ];
    }

    public static function check($format)
    {
        if(!is_array($format)) $format = static::prepare($format);
        if($format['code']) return true;
        return false;
    }

    public function parse()
    {
        $parsed = $this->__toString();
        $this->repository = LanguagesRepository::find('iso-639-3', $parsed);
        $this->iso_639_1 = $this->repository ? $this->repository['iso-639-1'] : '';
        $this->iso_639_2t = $this->repository ? $this->repository['iso-639-2t'] : $this->original['code'];
        $this->iso_639_2b = $this->repository ? $this->repository['iso-639-2b'] : $this->original['code'];
        $this->iso_639_3 = $parsed;
    }

    public static function format(ConverterInterface $converter)
    {
        return $converter->iso_639_3;
    }
}
