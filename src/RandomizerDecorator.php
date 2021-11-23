<?php

/*
 * Name Generator
 */

namespace Trismegiste\NameGenerator;

/**
 * Design Pattern : Decorator
 */
class RandomizerDecorator implements Repository
{

    protected $decorated;

    public function __construct(Repository $repo)
    {
        $this->decorated = $repo;
    }

    public function getGivenNameLanguage(): array
    {
        return $this->decorated->getGivenNameLanguage();
    }

    public function getGivenNameListFor(string $gender, string $lang): array
    {
        if ($lang === 'random') {
            $listing = $this->getGivenNameLanguage();
            $lang = $listing[random_int(0, count($listing) - 1)];
        }

        return $this->decorated->getGivenNameListFor($gender, $lang);
    }

    public function getSurnameLanguage(): array
    {
        return $this->decorated->getSurnameLanguage();
    }

    public function getSurnameListFor(string $lang): array
    {
        if ($lang === 'random') {
            $listing = $this->getSurnameLanguage();
            $lang = $listing[random_int(0, count($listing) - 1)];
        }

        return $this->decorated->getSurnameListFor($lang);
    }

}
