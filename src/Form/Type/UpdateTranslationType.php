<?php

namespace App\Form\Type;

use App\DataTransferObjects\UpdateTranslationRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UpdateTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'translation',
                TextType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UpdateTranslationRequest::class,
                'empty_data' => function (FormInterface $form) {
                    $translation = $form->get('translation')->getData();

                    return new UpdateTranslationRequest($translation);
                },
            ]
        );
    }
}
