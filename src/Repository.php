<?php

/*
 * Name Generator
 */

namespace App\NameGenerator;

/**
 * A service for name generating
 */
class Repository
{

    protected $folder;
    private $givenNameLanguage = null;
    private $surnameLanguage = null;
    private $cacheSurname = [];
    private $cacheFemaleName = [];
    private $cacheMaleName = [];

    public function __construct(string $dbFolder)
    {
        $this->folder = $dbFolder;
    }

    public function getSurnameLanguage(): array
    {
        if (is_null($this->surnameLanguage)) {
            $finder = new \Symfony\Component\Finder\Finder();
            $surname = $finder->files()->in($this->folder . '/surname')->name('*.yml');

            $this->surnameLanguage = [];
            foreach ($surname as $fileInfo) {
                $this->surnameLanguage[] = $fileInfo->getBasename('.yml');
            }
        }

        return $this->surnameLanguage;
    }

    public function getGivenNameLanguage(): array
    {
        if (is_null($this->givenNameLanguage)) {
            $finder = new \Symfony\Component\Finder\Finder();
            $given = $finder->files()->in($this->folder . '/female')->name('*.yml');

            $this->givenNameLanguage = [];
            foreach ($given as $fileInfo) {
                $this->givenNameLanguage[] = $fileInfo->getBasename('.yml');
            }
        }

        return $this->givenNameLanguage;
    }

    public function getMaleGivenNameListFor(string $lang): array
    {
        if (!array_key_exists($lang, $this->cacheMaleName)) {
            $langListing = $this->getGivenNameLanguage();
            // this seems a little overkill but it prevents some clowns to inject some infamous path in the form
            if (!array_search($lang, $langListing)) {
                throw new \OutOfBoundsException("$lang is not a valid language for a given name");
            }
            $this->cacheMaleName[$lang] = \Symfony\Component\Yaml\Yaml::parseFile("{$this->folder}/male/$lang.yml");
        }

        return $this->cacheMaleName[$lang];
    }

    public function getSurnameListFor(string $lang): array
    {
        if (!array_key_exists($lang, $this->cacheSurname)) {
            $langListing = $this->getSurnameLanguage();
            // this seems a little overkill but it prevents some clowns to inject some infamous path in the form
            if (!array_search($lang, $langListing)) {
                throw new \OutOfBoundsException("$lang is not a valid language for Surname");
            }
            $this->cacheSurname[$lang] = \Symfony\Component\Yaml\Yaml::parseFile("{$this->folder}/surname/$lang.yml");
        }

        return $this->cacheSurname[$lang];
    }

}
