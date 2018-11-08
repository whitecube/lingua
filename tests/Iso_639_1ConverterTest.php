<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class Iso_639_1ConverterTest extends TestCase
{

    /** @test */
    public function can_be_created_from_iso_639_1()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromISO_639_1('cv'));
    }
    
    /** @test */
    public function can_be_created_from_iso_639_1_with_deprecated_value()
    {
        $language = Lingua::createFromISO_639_1('iw');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals($language->toISO_639_1(), 'he');
    }

    /** @test */
    public function cannot_be_created_from_invalid_iso_639_1()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromISO_639_1('test');
    }

    /** @test */
    public function can_convert_iso_639_1_to_name()
    {
        $language = Lingua::createFromISO_639_1('cv');
        $this->assertEquals('chuvash', $language->toName());
    }

    /** @test */
    public function can_convert_iso_639_1_to_native()
    {
        $language = Lingua::createFromISO_639_1('cv');
        $this->assertEquals('чӑваш чӗлхи', $language->toNative());
    }

    /** @test */
    public function can_convert_iso_639_1_to_iso_639_2t()
    {
        $language = Lingua::createFromISO_639_1('sq');
        $this->assertEquals('sqi', $language->toISO_639_2t());
    }

    /** @test */
    public function can_convert_iso_639_1_to_iso_639_2b()
    {
        $language = Lingua::createFromISO_639_1('sq');
        $this->assertEquals('alb', $language->toISO_639_2b());
    }

    /** @test */
    public function can_convert_iso_639_1_to_iso_639_3()
    {
        $language = Lingua::createFromISO_639_1('sq');
        $this->assertEquals('sqi + 4', $language->toISO_639_3());
    }

    /** @test */
    public function can_convert_iso_639_1_to_w3c_iso_639_1()
    {
        $language = Lingua::createFromISO_639_1('sq');
        $this->assertEquals('sq', $language->toW3C());
    }

    /** @test */
    public function can_convert_iso_639_1_to_php_iso_639_1()
    {
        $language = Lingua::createFromISO_639_1('sq');
        $this->assertEquals('sq', $language->toPHP());
    }

}
