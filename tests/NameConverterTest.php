<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class NameConverterTest extends TestCase
{

    /** @test */
    public function can_be_created_from_name()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromName('cornish'));
    }

    /** @test */
    public function cannot_convert_if_not_in_repository()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromW3C('fu')->toName();
    }

    /** @test */
    public function cannot_be_created_from_invalid_name()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromName('test');
    }

    /** @test */
    public function can_convert_name_to_native()
    {
        $language = Lingua::createFromName('cornish');
        $this->assertEquals('kernewek', $language->toNative());
    }

    /** @test */
    public function can_convert_name_to_iso_639_1()
    {
        $language = Lingua::createFromName('albanian');
        $this->assertEquals('sq', $language->toISO_639_1());
    }

    /** @test */
    public function can_convert_name_to_iso_639_2t()
    {
        $language = Lingua::createFromName('albanian');
        $this->assertEquals('sqi', $language->toISO_639_2t());
    }

    /** @test */
    public function can_convert_name_to_iso_639_2b()
    {
        $language = Lingua::createFromName('albanian');
        $this->assertEquals('alb', $language->toISO_639_2b());
    }

    /** @test */
    public function can_convert_name_to_iso_639_3()
    {
        $language = Lingua::createFromName('albanian');
        $this->assertEquals('sqi + 4', $language->toISO_639_3());
    }

    /** @test */
    public function can_convert_name_to_w3c_iso_639_1()
    {
        $language = Lingua::createFromName('albanian');
        $this->assertEquals('sq', $language->toW3C());
    }

    /** @test */
    public function can_convert_name_to_w3c_and_fallback_to_iso_639_3()
    {
        $language = Lingua::createFromName('bena');
        $this->assertEquals('bez', $language->toW3C());
    }

    /** @test */
    public function can_convert_name_to_php_iso_639_1()
    {
        $language = Lingua::createFromName('albanian');
        $this->assertEquals('sq', $language->toPHP());
    }

    /** @test */
    public function can_convert_name_to_php_and_fallback_to_iso_639_3()
    {
        $language = Lingua::createFromName('bena');
        $this->assertEquals('bez', $language->toPHP());
    }

}
