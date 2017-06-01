<?php

use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{

    /** @test */
    public function can_change_format()
    {
        Lingua::setFormat('native');
        $this->assertEquals('norsk nynorsk', '' . Lingua::createFromW3C('nn'));
    }

    /** @test */
    public function a_user_can_echo_the_class_and_get_a_string_output()
    {
        $this->assertTrue(is_string('' . Lingua::createFromNative('norsk nynorsk')));
    }

    /** @test */
    public function throws_error_if_calling_undefined_method()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromW3C('nn')->test();
    }

    /** @test */
    public function throws_error_if_instanciation_method_does_not_start_with_create()
    {
        $this->expectException(\Exception::class);
        Lingua::testFromW3C('nn');
    }

    /** @test */
    public function throws_error_if_converter_does_not_exist()
    {
        $this->expectException(\Exception::class);
        Lingua::createFromW3C('nn')->toTestConverter();
    }


}
