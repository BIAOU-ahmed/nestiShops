<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Luhn;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'required'=> true,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('creditCard', TextType::class, [
                'label' => false,
                'required'=> true,
                'attr' => [
                    'placeholder' => '1112'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Luhn(['message'=>'Le numéro de cart est invalid']),
                ],
            ])
            ->add('secretCode', TextType::class, [
                'label' => false,
                'required'=> true,
                'attr' => [
                    'placeholder' => '854'
                ],'constraints' => [
                    new NotBlank(),
                    new Length(['min'=>3,'max'=>3,'minMessage'=>'Le code secret doit avoir trois chiffre', 'maxMessage' =>'Le code secret doit avoir trois chiffre'])
                ],
            ])
            ->add('address', TextType::class, [
                'label' => false,
                'required'=> true,
                'attr' => [
                    'placeholder' => '14 avenue du grand Alec'
                ],'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('month', ChoiceType::class, [
                'choices' => [
                    '01' => '01',
                    '02' => '02',
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                    '09' => '09',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                ],
            ])
            ->add('year', ChoiceType::class, [
                'choices' => [
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025',
                    '2026' => '2026',
                    '2027' => '2027',
                    '2028' => '2028',
                    '2029' => '2029',
                    '2030' => '2030',
                ],
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
