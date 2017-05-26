<?php 

namespace WhiteCube\Lingua;

interface ConverterInterface
{
    static function prepare(string $string);

    static function check($format);

    function validate();

    function parse();

    static function format(ConverterInterface $converter);
}
