<?php

namespace App\DataTransferObjects;

class UpdateTranslationRequest
{
    private $translation;

    public function __construct(string $translation)
    {
        $this->translation = $translation;
    }

    public function translation(): string
    {
        return $this->translation;
    }
}
