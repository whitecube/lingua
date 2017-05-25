<?php 

namespace WhiteCube\Lingua;

interface ConverterInterface
{
    static function prepare(string $string);

    static function check(string $format);

    function validate();

    function parse();

    static function format(ConverterInterface $converter);
}
