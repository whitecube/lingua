<?php 

namespace WhiteCube\Lingua;

class ComponentConverter extends Converter
{
    public function __toString()
    {
        return $this->original['full'];
    }

    public static function check($format)
    {
        if(!is_array($format)) $format = static::prepare($format);
        if($format['iso']) return true;
        return false;
    }

    public function parse()
    {
        $this->repository = $this->findInRepository();
        $this->fillNameBag('script', 'scripts');
        $this->fillNameBag('country', 'countries');
        $this->iso_639_1 = $this->getIsoValue('iso-639-1');
        $this->iso_639_2t = $this->getIsoValue('iso-639-2t');
        $this->iso_639_2b = $this->getIsoValue('iso-639-2b');
        $this->iso_639_3 = $this->getIsoValue('iso-639-3');
    }

    protected static function getScriptFromPregMatch($matches)
    {
        if(!isset($matches[2])) return;
        if(strlen($matches[2]) !== 4) return;
        return $matches[2];
    }

    protected static function getCountryFromPregMatch($matches)
    {
        if(isset($matches[3]) && strlen($matches[3])) return strtoupper($matches[3]);
    }

    protected function findInRepository()
    {
        if(!$this->original['iso']) return;
        if(strlen($this->original['iso']) === 3) {
            return LanguagesRepository::find('iso-639-3', $this->original['iso'])
                ?? LanguagesRepository::find('iso-639-2t', $this->original['iso'])
                ?? LanguagesRepository::find('iso-639-2b', $this->original['iso']);
        }
        return LanguagesRepository::find('iso-639-1', $this->original['iso']);
    }

    protected function fillNameBag($item, $key)
    {
        if(!$this->original[$item]) return;
        $this->$item->code = $this->original[$item];
        if(!$this->repository) return;
        $this->$item->name = $this->repository[$key][$this->$item->code] ?? null;
    }

    protected function getIsoValue($format)
    {
        if($this->repository && $this->repository[$format]){
            return $this->repository[$format];
        }
        $length = strlen($this->original['iso']);
        if($length === 2 && $format != 'iso-639-1') return '';
        if($length === 3 && $format == 'iso-639-1') return '';
        return $this->original['iso'];
    }
}
