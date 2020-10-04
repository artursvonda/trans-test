<?php

namespace App\Entity;

class Language {
    private $id;
    private $name;
    private $rtl;

    public function __construct(string $name, bool $rtl)
    {
        $this->name = $name;
        $this->rtl = $rtl;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function isRtl(): bool
    {
        return $this->rtl;
    }


}
