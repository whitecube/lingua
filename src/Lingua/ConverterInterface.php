<?php 

namespace WhiteCube\Lingua;

interface ConverterInterface
{
    protected static function prepare(string $string);

    public static function check(string $format);

    public function validate();

    public function format(ConverterInterface $converter);

    public function parse();
}
