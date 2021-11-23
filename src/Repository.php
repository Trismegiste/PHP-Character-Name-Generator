<?php

/*
 * Name Generator
 */

namespace Trismegiste\NameGenerator;

/**
 * A service for name generating
 */
interface Repository
{

    public function getSurnameLanguage(): array;

    public function getGivenNameLanguage(): array;

    public function getGivenNameListFor(string $gender, string $lang): array;

    public function getSurnameListFor(string $lang): array;
}
