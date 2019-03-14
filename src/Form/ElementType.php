<?php

namespace App\Form;

use App\Entity\Backlog;
use App\Entity\Element;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('type')
            ->add('status')
            ->add('priority')
            ->add('estimation')
            ->add('listeCheck')
            ->add('criteresTests')
            ->add('backlog', EntityType::class, array(
                'class' => Backlog::class,
                'choice_label' => 'title'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Element::class,
        ]);
    }
}
