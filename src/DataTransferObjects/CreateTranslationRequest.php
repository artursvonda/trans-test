<?php

namespace App\DataTransferObjects;

use App\Entity\Language;

class CreateTranslationRequest
{
    private $translation;
    private $language;

    public function __construct(?Language $language, ?string $translation)
    {
        $this->translation = $translation;
        $this->language = $language;
    }

    public function translation(): ?string
    {
        return $this->translation;
    }

    public function language(): ?Language
    {
        return $this->language;
    }
}
