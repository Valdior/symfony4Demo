<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Participant;
use App\Entity\ArcherCategory;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entity = $builder->getData();
        $pattern = $entity->getPeloton()->getId();

        $builder
            ->add('archer', EntityType::class, array(
                'class' => User::class,                
                'choice_label' => 'fullname',
                'query_builder' => function(UserRepository $repository)  use($pattern) {
                    return $repository->ListAllArcherNotRegistred($pattern);
                },
                'placeholder'   => "Sélectionnez l'archer"
            ))
            ->add('category', EntityType::class, array(
                'class' => ArcherCategory::class,  
                'mapped'    => false,
                'placeholder'   => "Sélectionnez votre catégorie"
            ))
            ->add('save',      SubmitType::class)
            ;    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
