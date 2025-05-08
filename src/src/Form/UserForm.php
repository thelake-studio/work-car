<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\PlannedTrip;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('phoneNumber')
            ->add('email')
            ->add('password')
            ->add('profilePicture')
            ->add('userGroups', EntityType::class, [
                'class' => Group::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('passengerPlannedTrips', EntityType::class, [
                'class' => PlannedTrip::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
