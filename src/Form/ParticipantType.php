<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Participant;
use App\Entity\ArcherCategory;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('arc', ChoiceType::class, array(
                'choices'  => Participant::getArcList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
                //'mapped'        => false,
                'placeholder'   => "Sélectionnez l'arc utilisé"
            ))
            ->add('categoryArcher', ChoiceType::class, array(
                'choices'  => Participant::getCategoryList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
                'mapped'    => false,
                'placeholder'   => "Sélectionnez votre catégorie"
            ))
            ->add('category', EntityType::class, array(
                'class' => ArcherCategory::class,  
                'mapped'    => false,
                'placeholder'   => "Sélectionnez votre catégorie"
            ))
            ->add('save',      SubmitType::class)
            ;    

            $builder->addEventListener(FormEvents::POST_SUBMIT, //POST_SET_DATA
                function (FormEvent $event) 
                {
                    $form = $event->getForm();
                    $category = $event->getForm()->get('categoryArcher');
                    $this->addCategoryField($form, $category->getData());
                }
            );

            // Edit
            // $builder->addEventListener(FormEvents::POST_SET_DATA, //POST_SET_DATA
            //     function (FormEvent $event) 
            //     {
            //         dump($event->getData());
            //     }
            // );
    }

    /*
     * Ajoute le champs Category dans le formulaire
     */
    public function addCategoryField(FormInterface $form, string $category)
    {        
        dump($form->get("category"));
        $er = $this->getDoctrine();
        dump($er);
        // $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
        //     'category',
        //     EntityType::class,
        //     null,
        //     [
        //       'class'           => ArcherCategory::class,
        //       'auto_initialize' => false,
        //       //'choices'         => []
        //     ]
        // );

        // $form->add($builder->getForm());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
