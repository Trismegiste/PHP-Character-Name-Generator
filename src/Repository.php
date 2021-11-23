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

    public function __construct(string $dbFolder)
    {
        $this->folder = $dbFolder;
    }

    public function getSurnameList(): array
    {
        $finder = new \Symfony\Component\Finder\Finder();
        $surname = $finder->files()->in($this->folder . '/surname')->name('*.yml');

        $listing = [];
        foreach ($surname as $fileInfo) {
            $listing[] = $fileInfo->getBasename('.yml');
        }

        return $listing;
    }

    public function getGivenNameList(): array
    {
        $finder = new \Symfony\Component\Finder\Finder();
        $given = $finder->files()->in($this->folder . '/female')->name('*.yml');

        $listing = [];
        foreach ($given as $fileInfo) {
            $listing[] = $fileInfo->getBasename('.yml');
        }

        return $listing;
    }

}
