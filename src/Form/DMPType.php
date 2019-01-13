<?php

namespace App\Form;

use App\Entity\DMP;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\HospitalNode;

class DMPType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', TextType::class)
            ->add('name', TextType::class)
            ->add('socialNumber', NumberType::class)
            ->add('birthDate' , DateType::class)
            ->add('birthPlace', TextType::class)
            ->add('address', TextType::class)
            ->add('nodeManaging', EntityType::class, [
                'class' => HospitalNode::class,
                'choice_label' => 'name',
            ])
            // ->add('histories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DMP::class,
        ]);
    }
}
