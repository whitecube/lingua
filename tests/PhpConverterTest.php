<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class PhpConverterTest extends TestCase
{

    /** @test */
    public function can_be_created_from_php()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromPhp('fr_BE'));
    }

    /** @test */
    public function cannot_be_created_from_invalid_php()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromPhp('test');
    }

    /** @test */
    public function can_convert_php_to_name()
    {
        $language = Lingua::createFromPhp('fr');
        $this->assertEquals('french', $language->toName());
    }

    /** @test */
    public function can_convert_php_to_name_with_country()
    {
        $language = Lingua::createFromPhp('fr_BE');
        $this->assertEquals('french (Belgium)', $language->toName());
    }

    /** @test */
    public function can_convert_php_to_name_with_script()
    {
        $language = Lingua::createFromPhp('ha_Latn');
        $this->assertEquals('hausa (latin)', $language->toName());
    }

    /** @test */
    public function can_convert_php_to_name_with_script_and_country()
    {
        $language = Lingua::createFromPhp('zh_Hant_TW');
        $this->assertEquals('chinese (traditional han, Taiwan)', $language->toName());
    }

    /** @test */
    public function can_convert_php_to_native()
    {
        $language = Lingua::createFromPhp('zh_Hant_TW');
        $this->assertEquals('中文 (zhōngwén), 汉语, 漢語', $language->toNative());
    }

    /** @test */
    public function can_convert_php_to_iso_639_1()
    {
        $language = Lingua::createFromPhp('zh_Hant_TW');
        $this->assertEquals('zh', $language->toISO_639_1());
    }

    /** @test */
    public function can_convert_php_to_iso_639_2t()
    {
        $language = Lingua::createFromPhp('zh_Hant_TW');
        $this->assertEquals('zho', $language->toISO_639_2t());
    }

    /** @test */
    public function can_convert_php_to_iso_639_2b()
    {
        $language = Lingua::createFromPhp('zh_Hant_TW');
        $this->assertEquals('chi', $language->toISO_639_2b());
    }

    /** @test */
    public function can_convert_php_to_iso_639_3()
    {
        $language = Lingua::createFromPhp('zh_Hant_TW');
        $this->assertEquals('zho + 13', $language->toISO_639_3());
    }

    /** @test */
    public function can_convert_php_to_w3c()
    {
        $language = Lingua::createFromPhp('zh');
        $this->assertEquals('zh', $language->toW3C());
    }

    /** @test */
    public function can_convert_php_to_w3c_with_country()
    {
        $language = Lingua::createFromPhp('zh_TW');
        $this->assertEquals('zh-TW', $language->toW3C());
    }

    /** @test */
    public function can_convert_php_to_w3c_with_script()
    {
        $language = Lingua::createFromPhp('zh_Hans');
        $this->assertEquals('zh-Hans', $language->toW3C());
    }

    /** @test */
    public function can_convert_php_to_w3c_with_script_and_country()
    {
        $language = Lingua::createFromPhp('zh_Hans_TW');
        $this->assertEquals('zh-Hans-TW', $language->toW3C());
    }

    /** @test */
    public function can_convert_incorrect_php_to_w3c_with_script_and_country()
    {
        $language = Lingua::createFromPhp('zh_test_tw');
        $this->assertEquals('zh-Test-TW', $language->toW3C());
    }

    /** @test */
    public function can_convert_incorrect_php_to_php()
    {
        $language = Lingua::createFromPhp('zh_test_tw');
        $this->assertEquals('zh_Test_TW', $language->toPHP());
    }

}
