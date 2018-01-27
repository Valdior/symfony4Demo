<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Affiliate;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AffiliateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('affiliatedSince', DateType::class, array(
                'label' => 'Date affiliation',
                'widget' => 'single_text',
            ))
            ->add('registrationNumber', TextType::class, array(
                'label' => 'Numéro licence',
            ))
            ->add('archer', EntityType::class, array(
                'class' => User::class,
                'query_builder' => function(UserRepository $repository) {
                    return $repository->ListAllArcher();
                },
                // use the User.username property as the visible option string
                'choice_label' => 'fullname',
            ))
            ->add('save', SubmitType::class, array('label' => 'Ajouter l\'affiliation'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            //'data_class' => Affiliate::class,
        ]);
    }
}
