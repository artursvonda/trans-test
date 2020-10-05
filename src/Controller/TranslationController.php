<?php

namespace App\Controller;

use App\DataTransferObjects\CreateTranslationRequest;
use App\DataTransferObjects\UpdateTranslationRequest;
use App\Entity\Entry;
use App\Entity\Translation;
use App\Form\Type\CreateTranslationType;
use App\Form\Type\UpdateTranslationType;
use App\Repository\EntryRepository;
use Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TranslationController
 *
 * @Route("/key")
 */
class TranslationController
{
    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function keyAction(Entry $entry)
    {
        // Should use better way to serialize entities
        $data = [
            'id' => $entry->getId(),
            'name' => $entry->name(),
            'translations' => fromEntries(
                $entry->getTranslations()->toArray(),
                function (Translation $translation) {
                    return [
                        $translation->language()->name(),
                        [
                            'language' => $translation->language()->name(),
                            'rtl' => $translation->language()->isRtl(),
                            'translation' => $translation->translation(),
                        ],
                    ];
                }
            ),
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/{id}/translation", methods={"POST"})
     */
    public function createTranslationAction(
        Entry $entry,
        Request $request,
        EntryRepository $entryRepo,
        FormFactoryInterface $formFactory
    ) {
        $form = $formFactory->create(CreateTranslationType::class);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isSubmitted() && $form->isValid()) {
            $createTranslationRequest = $form->getData();
            if (!($createTranslationRequest instanceof CreateTranslationRequest)) {
                throw new BadRequestHttpException('Missing request');
            }

            $entry->addTranslation($createTranslationRequest->language(), $createTranslationRequest->translation());

            try {
                $entryRepo->save($entry);
            } catch (Exception $exception) {
                throw new ServiceUnavailableHttpException(null, 'Failed to save');
            }

            return new Response(204);
        }

        // Should return errors
        throw new BadRequestHttpException();
    }

    /**
     * @Route("/{id}/translation/{language}", methods={"PATCH"})
     */
    public function updateTranslationAction(
        Entry $entry,
        string $language,
        Request $request,
        EntryRepository $entryRepo,
        FormFactoryInterface $formFactory
    ) {
        $form = $formFactory->create(UpdateTranslationType::class);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isSubmitted() && $form->isValid()) {
            $updateTranslationRequest = $form->getData();
            if (!($updateTranslationRequest instanceof UpdateTranslationRequest)) {
                throw new BadRequestHttpException('Missing request');
            }

            $translation = $entry->getTranslation($language);
            if (!$translation) {
                throw new NotFoundHttpException('Translation entry not found');
            }

            $translation->setTranslation($updateTranslationRequest->translation());

            try {
                $entryRepo->save($entry);
            } catch (Exception $exception) {
                throw new ServiceUnavailableHttpException(null, 'Failed to save');
            }

            return new Response(204);
        }

        // Should return errors
        throw new BadRequestHttpException();
    }

    /**
     * @Route("/{id}/translation/{language}", methods={"DELETE"})
     */
    public function deleteAction(Entry $entry, string $language, EntryRepository $entryRepo)
    {
        $translation = $entry->getTranslation($language);
        $entryRepo->removeTranslation($translation);

        return new Response(204);
    }
}
