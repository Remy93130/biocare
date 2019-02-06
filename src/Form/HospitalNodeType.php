<?php

namespace App\Form;

use App\Entity\HospitalNode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Personnal;
use App\Entity\TypeNode;
use Doctrine\ORM\EntityRepository;

class HospitalNodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('responsible', EntityType::class, [
                'class' => Personnal::class,
                "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->join("p.role", "r")
                        ->andWhere("r.name = 'MEDECIN'")
                        ->orderBy("p.surname", "ASC")
                    ;
                },
                'choice_label' => function ($p) {
                    return $p->getDisplayName();
                }
            ])
            ->add('ancestorNode', EntityType::class, [
                'class' => HospitalNode::class,
                'choice_label' => 'name'
            ])
            ->add('typeNode', EntityType::class, [
                'class' => TypeNode::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HospitalNode::class,
            'translation_domain' => 'form_hospitalNode',
        ]);
    }
}
