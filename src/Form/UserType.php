<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Luhn;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use App\Entity\City;
use App\Form\CityType;
use App\Form\DataTransformer\CityToStringTransformer;

class UserType extends AbstractType
{
    private $transformer;

    public function __construct(CityToStringTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de l\'utilisateur'
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prenom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prenom de l\'utilisateur'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Email de l\'utilisateur'
                ]
            ])
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom d\'utilisateur'
                ]
            ])
            ->add('address1', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Adresse'
                ]
            ])
            ->add('address2', TextType::class, [
                'label' => 'Complement',
                'required' => false,
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code Postal',
                'required' => false,
                'attr' => [
                    'placeholder' => '34000'
                ]
            ])
            ->add('idCity', TextType::class, [
                'label' => 'Ville',
                'required' => false,
                'constraints' => [
                    new NotBlank(['message'=>'Ce champ est obligatoire']),
                ],

            ])
            ->add('Valider', SubmitType::class);

        $builder->get('idCity')
            ->addModelTransformer($this->transformer);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
