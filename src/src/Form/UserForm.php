<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

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
            ->add('phoneNumber', TelType::class, [
                'label' => 'Teléfono móvil',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ej: +34612345678',
                    'autocomplete' => 'tel',
                    'pattern' => '^(\+34|0034|34)?[6-9]\d{8}$'
                ],
                'help' => 'Formato: +34 seguido de 9 dígitos'
            ])
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
