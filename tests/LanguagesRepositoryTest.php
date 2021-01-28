<?php

use \WhiteCube\Lingua\LanguagesRepository;
use \WhiteCube\Lingua\Service as Lingua;
use PHPUnit\Framework\TestCase;

class LanguageRespositoryTest extends TestCase
{
    protected $buffer;

    public function setUp(): void
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

    /** @test */
    public function can_register_new_language_in_repository()
    {
        LanguagesRepository::register(['name' => 'whitecube', 'native' => 'whitecube', 'iso-639-3' => 'whi']);
        $this->assertEquals('whi', Lingua::createFromName('whitecube')->toISO_639_3());
    }

    public function tearDown(): void
    {
        file_put_contents('./languages.php', $this->buffer);
    }

}
