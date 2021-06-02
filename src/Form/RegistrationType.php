<?php

namespace App\Form;

use App\Entity\Users;
use App\Form\DataTransformer\CityToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
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
                'attr' => [
                    'placeholder' => 'Nom de l\'utilisateur'
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prenom',
                'attr' => [
                    'placeholder' => 'Prenom de l\'utilisateur'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email de l\'utilisateur'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'first_name' => 'password',
                'second_name' => 'confirm',
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation'],
                'type' => PasswordType::class,
            ])
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'attr' => [
                    'placeholder' => 'Nom d\'utilisateur'
                ]
            ])
            ->add('address1', TextType::class, [
                'label' => 'Adresse',
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
                'attr' => [
                    'placeholder' => '34000'
                ]
            ])
            ->add('idCity', TextType::class, [
                'label' => 'Ville',
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],

            ]);

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
