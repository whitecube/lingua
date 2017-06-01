<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class NativeConverterTest extends TestCase
{

    /** @test */
    public function can_be_created_from_native()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromNative('български език'));
    }

    /** @test */
    public function cannot_be_created_from_invalid_native()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromNative('test');
    }

    /** @test */
    public function can_convert_native_to_name()
    {
        $language = Lingua::createFromNative('български език');
        $this->assertEquals('bulgarian', $language->toName());
    }

    /** @test */
    public function can_convert_native_to_iso_639_1()
    {
        $language = Lingua::createFromNative('shqip');
        $this->assertEquals('sq', $language->toISO_639_1());
    }

    /** @test */
    public function can_convert_native_to_iso_639_2t()
    {
        $language = Lingua::createFromNative('shqip');
        $this->assertEquals('sqi', $language->toISO_639_2t());
    }

    /** @test */
    public function can_convert_native_to_iso_639_2b()
    {
        $language = Lingua::createFromNative('shqip');
        $this->assertEquals('alb', $language->toISO_639_2b());
    }

    /** @test */
    public function can_convert_native_to_iso_639_3()
    {
        $language = Lingua::createFromNative('shqip');
        $this->assertEquals('sqi + 4', $language->toISO_639_3());
    }

    /** @test */
    public function can_convert_native_to_w3c_iso_639_1()
    {
        $language = Lingua::createFromNative('shqip');
        $this->assertEquals('sq', $language->toW3C());
    }

    /** @test */
    public function can_convert_native_to_w3c_and_fallback_to_iso_639_3()
    {
        $language = Lingua::createFromNative('tachelhit');
        $this->assertEquals('tzm', $language->toW3C());
    }

    /** @test */
    public function can_convert_native_to_php_iso_639_1()
    {
        $language = Lingua::createFromNative('shqip');
        $this->assertEquals('sq', $language->toPHP());
    }

    /** @test */
    public function can_convert_native_to_php_and_fallback_to_iso_639_3()
    {
        $language = Lingua::createFromNative('tachelhit');
        $this->assertEquals('tzm', $language->toPHP());
    }

    /** @test */
    public function native_conversion_throws_error_if_lang_not_registered()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromW3c('har')->toNative();
    }

}
