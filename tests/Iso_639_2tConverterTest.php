<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class Iso_639_2tConverterTest extends TestCase
{

    /** @test */
    public function can_be_created_from_iso_639_2t()
    {
        $this->assertInstanceOf(WhiteCube\Lingua\Service::class, Lingua::createFromISO_639_2t('zho'));
    }

    /** @test */
    public function cannot_be_created_from_invalid_iso_639_2t()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromISO_639_2t('test');
    }

    /** @test */
    public function can_convert_iso_639_2t_to_name()
    {
        $language = Lingua::createFromISO_639_2t('zho');
        $this->assertEquals('chinese', $language->toName());
    }

    /** @test */
    public function can_convert_iso_639_2t_to_native()
    {
        $language = Lingua::createFromISO_639_2t('zho');
        $this->assertEquals('中文 (zhōngwén), 汉语, 漢語', $language->toNative());
    }

    /** @test */
    public function can_convert_iso_639_2t_to_iso_639_1()
    {
        $language = Lingua::createFromISO_639_2t('zho');
        $this->assertEquals('zh', $language->toISO_639_1());
    }

    /** @test */
    public function can_convert_iso_639_2t_to_iso_639_2b()
    {
        $language = Lingua::createFromISO_639_2t('zho');
        $this->assertEquals('chi', $language->toISO_639_2b());
    }

    /** @test */
    public function can_convert_iso_639_2t_to_iso_639_3()
    {
        $language = Lingua::createFromISO_639_2t('zho');
        $this->assertEquals('zho + 13', $language->toISO_639_3());
    }

    /** @test */
    public function can_convert_iso_639_2t_to_w3c_iso_639_1()
    {
        $language = Lingua::createFromISO_639_2t('zho');
        $this->assertEquals('zh', $language->toW3C());
    }

    /** @test */
    public function can_convert_iso_639_2t_to_php_iso_639_1()
    {
        $language = Lingua::createFromISO_639_2t('zho');
        $this->assertEquals('zh', $language->toPHP());
    }

}
