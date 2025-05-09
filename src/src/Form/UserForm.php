<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    TextType,
    EmailType,
    PasswordType,
    TelType,
    FileType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre *',
                'attr' => [
                    'class' => 'form-control-lg',
                    'placeholder' => 'Ej: José Luis',
                    'autocomplete' => 'given-name'
                ],
                'row_attr' => ['class' => 'mb-4'],
                'help' => 'Mínimo 2 caracteres, máximo 50',
                'help_attr' => ['class' => 'form-text text-muted mt-1']
            ])
            ->add('surname', TextType::class, [
                'label' => 'Apellidos *',
                'attr' => [
                    'class' => 'form-control-lg',
                    'placeholder' => 'Ej: García García',
                    'autocomplete' => 'family-name'
                ],
                'row_attr' => ['class' => 'mb-4'],
                'help' => 'Mínimo 2 caracteres, máximo 100',
                'help_attr' => ['class' => 'form-text text-muted mt-1']
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Teléfono móvil',
                'required' => false,
                'attr' => [
                    'class' => 'form-control-lg',
                    'placeholder' => '+34 612 345 678',
                    'pattern' => '^(\+34|0034|34)?[6-9]\d{8}$',
                    'autocomplete' => 'tel'
                ],
                'row_attr' => ['class' => 'mb-4'],
                'help' => 'Formato: +34 seguido de 9 dígitos',
                'help_attr' => ['class' => 'form-text text-muted mt-1']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email *',
                'attr' => [
                    'class' => 'form-control-lg',
                    'placeholder' => 'usuario@dominio.com',
                    'autocomplete' => 'email'
                ],
                'row_attr' => ['class' => 'mb-4'],
                'help' => 'Debe ser un email válido y único',
                'help_attr' => ['class' => 'form-text text-muted mt-1']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña *',
                'attr' => [
                    'class' => 'form-control-lg',
                    'placeholder' => '••••••••',
                    'autocomplete' => 'new-password',
                    'data-password-toggle' => true
                ],
                'row_attr' => ['class' => 'mb-4'],
                'help' => 'Mínimo 8 caracteres con mayúsculas, números y símbolos',
                'help_attr' => ['class' => 'form-text text-muted mt-1']
            ])
            ->add('profilePicture', FileType::class, [
                'label' => 'Foto de perfil',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control-lg',
                    'accept' => 'image/jpeg, image/png, image/webp'
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Formatos permitidos: JPEG, PNG o WEBP'
                    ])
                ],
                'row_attr' => ['class' => 'mb-4'],
                'help' => 'Formatos permitidos: JPG, PNG o WEBP (max 2MB)',
                'help_attr' => ['class' => 'form-text text-muted mt-1']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => true,
                'autocomplete' => 'off'
            ],
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'user_form'
        ]);
    }
}
