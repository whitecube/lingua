<?php

use \WhiteCube\Lingua\LanguagesRepository;
use PHPUnit\Framework\TestCase;

class LanguageRespositoryTest extends TestCase
{
    protected $buffer;

    public function setUp()
    {
        $this->buffer = file_get_contents('./languages.php');
    }

    /** @test */
    public function throws_an_exception_if_repository_not_found()
    {
        $this->expectException(\Exception::class);
        unlink('./languages.php');
        new LanguagesRepository();
    }

    public function tearDown()
    {
        file_put_contents('./languages.php', $this->buffer);
    }

}
