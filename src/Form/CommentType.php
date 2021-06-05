<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{    
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
            ->add('commentTitle', TextType::class, [
                'label' => 'Titre',
                'required' => false,
            ])
            ->add('commentContent', TextareaType::class, [
                'label' => 'Contenue',
                'required' => false,
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
            'data_class' => Comment::class,
        ]);
    }
}
