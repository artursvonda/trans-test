<?php

namespace App\Controller;

use App\Entity\Language;
use App\Repository\LanguageRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LanguageController
 *
 * @Route("/languages")
 */
class LanguageController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function indexAction(LanguageRepository $languageRepo)
    {
        $languages = $languageRepo->findAll();

        $data = array_map(
            function (Language $language) {
                return [
                    // We use name as the public "id"
                    'id' => $language->name(),
                    'name' => $language->name(),
                    'rtl' => $language->isRtl(),
                ];
            },
            $languages
        );

        return new JsonResponse($data);
    }
}
