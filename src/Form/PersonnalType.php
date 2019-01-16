<?php

namespace App\Form;

use App\Entity\Personnal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname')
            ->add('lastname')
            ->add('email')
            ->add('password')
            ->add('role')
            ->add('specialization')
            ->add('hospitalNode')
            ->add('assignment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnal::class,
        ]);
    }
}
