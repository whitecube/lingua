<?php

use PHPUnit\Framework\TestCase;
use \WhiteCube\Lingua\Service as Lingua;
use WhiteCube\Lingua\LanguagesRepository;

class W3cConverterTest extends TestCase
{

    /** @test */
    public function can_be_created_from_w3c()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromW3c('fr-BE'));
    }

    /** @test */
    public function cannot_be_created_from_invalid_w3c()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromW3c('test');
    }

    /** @test */
    public function can_convert_w3c_to_name()
    {
        $language = Lingua::createFromW3c('fr');
        $this->assertEquals('french', $language->toName());
    }

    /** @test */
    public function can_convert_w3c_to_name_with_country()
    {
        $language = Lingua::createFromW3c('fr-BE');
        $this->assertEquals('french (Belgium)', $language->toName());
    }

    /** @test */
    public function can_convert_w3c_to_name_with_script()
    {
        $language = Lingua::createFromW3c('ha-Latn');
        $this->assertEquals('hausa (latin)', $language->toName());
    }

    /** @test */
    public function can_convert_w3c_to_name_with_script_and_country()
    {
        $language = Lingua::createFromW3c('zh-Hant-TW');
        $this->assertEquals('chinese (traditional han, Taiwan)', $language->toName());
    }

    /** @test */
    public function can_convert_w3c_to_native()
    {
        $language = Lingua::createFromW3c('zh-Hant-TW');
        $this->assertEquals('中文 (zhōngwén), 汉语, 漢語', $language->toNative());
    }

    /** @test */
    public function can_convert_w3c_to_iso_639_1()
    {
        $language = Lingua::createFromW3c('zh-Hant-TW');
        $this->assertEquals('zh', $language->toISO_639_1());
    }

    /** @test */
    public function can_convert_w3c_to_iso_639_2t()
    {
        $language = Lingua::createFromW3c('zh-Hant-TW');
        $this->assertEquals('zho', $language->toISO_639_2t());
    }

    /** @test */
    public function can_convert_w3c_to_iso_639_2b()
    {
        $language = Lingua::createFromW3c('zh-Hant-TW');
        $this->assertEquals('chi', $language->toISO_639_2b());
    }

    /** @test */
    public function can_convert_w3c_to_iso_639_3()
    {
        $language = Lingua::createFromW3c('zh-Hant-TW');
        $this->assertEquals('zho + 13', $language->toISO_639_3());
    }

    /** @test */
    public function can_convert_incorrect_w3c_to_w3c()
    {
        $language = Lingua::createFromW3c('zh-test-tw');
        $this->assertEquals('zh-Test-TW', $language->toW3C());
    }

    /** @test */
    public function can_convert_w3c_to_php()
    {
        $language = Lingua::createFromW3c('zh');
        $this->assertEquals('zh', $language->toPHP());
    }

    /** @test */
    public function can_convert_w3c_to_php_with_country()
    {
        $language = Lingua::createFromW3c('zh-TW');
        $this->assertEquals('zh_TW', $language->toPHP());
    }

    /** @test */
    public function can_convert_w3c_to_php_with_script()
    {
        $language = Lingua::createFromW3c('zh-Hans');
        $this->assertEquals('zh_Hans', $language->toPHP());
    }

    /** @test */
    public function can_convert_w3c_to_php_with_script_and_country()
    {
        $language = Lingua::createFromW3c('zh-Hans-TW');
        $this->assertEquals('zh_Hans_TW', $language->toPHP());
    }

    /** @test */
    public function can_convert_incorrect_w3c_to_php_with_script_and_country()
    {
        $language = Lingua::createFromW3c('zh-test-tw');
        $this->assertEquals('zh_Test_TW', $language->toPHP());
    }

    /** @test */
    public function can_convert_w3c_to_php_from_iso_639_2t_part()
    {
        LanguagesRepository::register(['iso-639-1' => 'xx', 'iso-639-2t' => 'xxx', 'iso-639-3' => 'xyx']);
        $language = Lingua::createFromW3c('xxx-BE');
        $this->assertEquals('xx_BE', $language->toPHP());
    }

}
