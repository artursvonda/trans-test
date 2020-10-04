<?php

namespace App\Form\Type;

use App\DataTransferObjects\CreateTranslationRequest;
use App\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translation', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('language', EntityType::class, [
                'class' => Language::class,
                'choice_value' => function (?Language $entity) {
                    return $entity ? $entity->name() : '';
                },
                'choice_label' => function (?Language $entity) {
                    return $entity ? $entity->name() : '';
                },
                'required' => true,
                'constraints' => [
                    new NotBlank()
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => CreateTranslationRequest::class,
                'empty_data' => function (FormInterface $form) {
                    $language = $form->get('language')->getData();
                    $translation = $form->get('translation')->getData();

                    return new CreateTranslationRequest($language, $translation);
                },
            ]
        );
    }
}
