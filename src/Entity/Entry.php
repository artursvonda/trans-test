<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Entry
{
    private $id;
    private $name;
    private $translations;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->translations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function getTranslation(string $language): ?Translation
    {
        return $this->translations->filter(
            function (Translation $translation) use ($language) {
                return $translation->language()->name() === $language;
            }
        )->first() ?: null;
    }

    public function removeTranslation(string $language): void
    {
        $translation = $this->getTranslation($language);
        if (!$translation) {
            return;
        }

        $this->translations->removeElement($translation);
    }

    public function addTranslation(Language $language, string $translation): Translation
    {
        $inst = new Translation($this, $language, $translation);
        $this->translations->add($inst);

        return $inst;
    }
}
