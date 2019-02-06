<?php

namespace App\Form;

use App\Entity\Exam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\DMP;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('state', CheckboxType::class, [
                "required" => false,
            ])
            ->add('content', TextareaType::class, [
                "attr" => ['rows' => 10]
            ])
            ->add('dmp', EntityType::class, [
                'class' => DMP::class,
                'choice_label' => function ($dmp) {
                    return $dmp->getDisplayName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
            'translation_domain' => 'form_exam',
        ]);
    }
}
