<?php

namespace App\Form;

use App\Entity\Personnal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Role;
use App\Entity\Specialization;
use App\Entity\HospitalNode;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PersonnalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname')
            ->add('lastname')
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'name'
            ])
             ->add('specialization', EntityType::class, [
                 'class' => Specialization::class,
                 'choice_label' => 'name',
                 'multiple' => true,
             ])
            // ->add('hospitalNode')
            ->add('assignment', EntityType::class, [
                'class' => HospitalNode::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnal::class,
            'translation_domain' => 'form_personnal',
            'allow_delete' => true,
        ]);
    }
}
