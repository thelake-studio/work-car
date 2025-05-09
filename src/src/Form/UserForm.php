<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre *',
                'attr' => [
                    'placeholder' => 'Ej: José Luis',
                    'autocomplete' => 'given-name'
                ],
                'help' => 'Mínimo 2 caracteres, máximo 50'
            ])
            ->add('surname', TextType::class, [
                'label' => 'Apellidos *',
                'attr' => [
                    'placeholder' => 'Ej: García García',
                    'autocomplete' => 'family-name'
                ],
                'help' => 'Mínimo 2 caracteres, máximo 100'
            ])
            ->add('phoneNumber')
            ->add('email')
            ->add('password')
            ->add('profilePicture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
