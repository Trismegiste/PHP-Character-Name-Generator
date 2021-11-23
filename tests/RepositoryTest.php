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
        $this->assertCount(1, $this->sut->getSurnameLanguage());
    }

}
