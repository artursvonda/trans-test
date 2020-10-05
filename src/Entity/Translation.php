<?php

namespace App\Entity;

class Translation
{
    private $id;
    private $language;
    private $translation;
    private $entry;

    public function __construct(Entry $entry, Language $language, string $translation)
    {
        $this->language = $language;
        $this->translation = $translation;
        $this->entry = $entry;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function language(): Language
    {
        return $this->language;
    }

    public function translation(): string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): void
    {
        $this->translation = $translation;
    }
}
