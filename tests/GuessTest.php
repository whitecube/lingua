<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class GuessTest extends TestCase
{

    /** @test */
    public function cannot_guess_from_incorrect_format()
    {
        $this->expectException(\Exception::class);
        Lingua::create('test');
    }

    /** @test */
    public function can_guess_format_from_native()
    {
        $language = Lingua::create('føroyskt');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('fao', $language->toISO_639_3());
    }

    /** @test */
    public function can_guess_format_from_name()
    {
        $language = Lingua::create('finnish');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('fin', $language->toISO_639_3());
    }

    /** @test */
    public function can_guess_format_from_ISO_639_3()
    {
        $language = Lingua::create('ipk + 2');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('ik', $language->toISO_639_1());
    }

    /** @test */
    public function can_guess_format_from_incorrect_ISO_639_3()
    {
        $language = Lingua::create('ipk+2');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('ik', $language->toISO_639_1());
    }

    /** @test */
    public function can_guess_format_from_ISO_639_2t()
    {
        $language = Lingua::create('sqi');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('sq', $language->toISO_639_1());
    }

    /** @test */
    public function can_guess_format_from_ISO_639_2b()
    {
        $language = Lingua::create('alb');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('sq', $language->toISO_639_1());
    }

    /** @test */
    public function can_guess_format_from_ISO_639_1()
    {
        $language = Lingua::create('sq');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('albanian', $language->toName());
    }

    /** @test */
    public function can_guess_format_from_w3c_with_country()
    {
        $language = Lingua::create('af-ZA');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('af_ZA', $language->toPHP());
    }

    /** @test */
    public function can_guess_format_from_w3c_with_iso_639_3_and_country()
    {
        $language = Lingua::create('asa-TZ');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('asa_TZ', $language->toPHP());
    }

    /** @test */
    public function can_guess_format_from_w3c_with_script()
    {
        $language = Lingua::create('az-Cyrl');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('az_Cyrl', $language->toPHP());
    }

    /** @test */
    public function can_guess_format_from_w3c_with_script_and_country()
    {
        $language = Lingua::create('az-Cyrl-AZ');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('az_Cyrl_AZ', $language->toPHP());
    }

    /** @test */
    public function can_guess_format_from_php_with_country()
    {
        $language = Lingua::create('af_ZA');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('af-ZA', $language->toW3C());
    }

    /** @test */
    public function can_guess_format_from_php_with_iso_639_3_and_country()
    {
        $language = Lingua::create('asa_TZ');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('asa-TZ', $language->toW3C());
    }

    /** @test */
    public function can_guess_format_from_php_with_script()
    {
        $language = Lingua::create('az_Cyrl');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('az-Cyrl', $language->toW3C());
    }

    /** @test */
    public function can_guess_format_from_php_with_script_and_country()
    {
        $language = Lingua::create('az_Cyrl_AZ');
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, $language);
        $this->assertEquals('az-Cyrl-AZ', $language->toW3C());
    }

}
