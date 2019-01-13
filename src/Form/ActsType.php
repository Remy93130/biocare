<?php

namespace App\Form;

use App\Entity\Acts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Type;
use App\Entity\DMP;

class ActsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('dateCreation', HiddenType::class)
            // ->add('author', TextType::class, ['attr' => ['readonly' => true]])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
            ])
            ->add('state', CheckboxType::class, [
                'required' => false
            ])
            ->add('DMP', EntityType::class, [
                'class' => DMP::class,
                'choice_label' => function($dmp) {
                    return $dmp->getDisplayName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Acts::class,
            'translation_domain' => 'form_act',
        ]);
    }
}
