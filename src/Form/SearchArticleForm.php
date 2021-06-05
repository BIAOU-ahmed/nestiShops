<?php

namespace App\Form;

use App\Data\SearchArticleData;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchArticleForm extends AbstractType{
    
    /**
     * buildForm
     *
     * @param  FormBuilderInterface<int> $builder
     * @param  array<string> $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ])
            ;
    }    
    /**
     * configureOptions
     *
     * @param  OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchArticleData::class,
            'method' => 'GET',
            'crsf_protection' => false
        ]);
    }
    
    /**
     * getBlockPrefix
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return '';
    }
}