<?php

/*
 * Name Generator
 */

use PHPUnit\Framework\TestCase;
use Trismegiste\NameGenerator\Repository;

/**
 * Description of RepositoryTest
 */
class RepositoryTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new Repository(__DIR__ . '/database');
    }

    public function testSurnameLang()
    {
        $l = $this->sut->getSurnameLanguage();
        $this->assertCount(1, $l);
        $this->assertEquals(['starwars'], $l);
    }

    public function testGivenNameLang()
    {
        $l = $this->sut->getGivenNameLanguage();
        $this->assertCount(1, $l);
        $this->assertEquals(['trilogy'], $l);
    }

    public function testSurnameListFor()
    {
        $this->assertCount(3, $this->sut->getSurnameListFor('starwars'));
    }

    public function testGivenNameListFor()
    {
        $this->assertCount(4, $this->sut->getGivenNameListFor('female', 'trilogy'));
    }

}
