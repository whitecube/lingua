<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class Iso_639_3ConverterTest extends TestCase
{

    /** @test */
    public function can_be_created_from_iso_639_3()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromISO_639_3('isl'));
    }

    /** @test */
    public function can_be_created_from_partial_iso_639_3()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromISO_639_3('kln'));
    }

    /** @test */
    public function cannot_be_created_from_invalid_iso_639_3()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromISO_639_3('test');
    }

    /** @test */
    public function can_convert_iso_639_3_to_name()
    {
        $language = Lingua::createFromISO_639_3('isl');
        $this->assertEquals('icelandic', $language->toName());
    }

    /** @test */
    public function can_convert_partial_iso_639_3_to_name()
    {
        $language = Lingua::createFromISO_639_3('kln');
        $this->assertEquals('kalenjin', $language->toName());
    }

    /** @test */
    public function can_convert_iso_639_3_to_native()
    {
        $language = Lingua::createFromISO_639_3('isl');
        $this->assertEquals('íslenska', $language->toNative());
    }

    /** @test */
    public function can_convert_iso_639_3_to_iso_639_1()
    {
        $language = Lingua::createFromISO_639_3('isl');
        $this->assertEquals('is', $language->toISO_639_1());
    }

    /** @test */
    public function can_convert_iso_639_3_to_iso_639_2t()
    {
        $language = Lingua::createFromISO_639_3('isl');
        $this->assertEquals('isl', $language->toISO_639_2t());
    }

    /** @test */
    public function can_convert_iso_639_3_to_iso_639_2b()
    {
        $language = Lingua::createFromISO_639_3('isl');
        $this->assertEquals('ice', $language->toISO_639_2b());
    }

    /** @test */
    public function can_convert_iso_639_3_to_w3c_iso_639_1()
    {
        $language = Lingua::createFromISO_639_3('isl');
        $this->assertEquals('is', $language->toW3C());
    }

    /** @test */
    public function can_convert_iso_639_3_to_w3c_and_fallback_to_iso_639_3()
    {
        $language = Lingua::createFromISO_639_3('kea');
        $this->assertEquals('kea', $language->toW3C());
    }

    /** @test */
    public function can_convert_iso_639_3_to_php_iso_639_1()
    {
        $language = Lingua::createFromISO_639_3('isl');
        $this->assertEquals('is', $language->toPHP());
    }

    /** @test */
    public function can_convert_iso_639_3_to_php_and_fallback_to_iso_639_3()
    {
        $language = Lingua::createFromISO_639_3('kea');
        $this->assertEquals('kea', $language->toPHP());
    }

}
