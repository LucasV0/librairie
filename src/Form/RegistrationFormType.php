<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;



class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        
        ->add('email', TextType::class, [
            'label' => 'Email',
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter an email address',
                ]),
                new email([
                    'message' => 'The email "{{ value }}" is not a valid email.',
                ]),
            ],
        ])
        ->add('firt_name', TextType::class, [
            'label' => 'First Name'
        ])
        ->add('name', TextType::class, [
            'label' => 'Name'
        ])
        ->add('date_of_birth', DateType::class, [
            'label' => 'Date of Birth',
            'widget' => 'single_text', // Utiliser un widget de type texte unique
            'html5' => false, // Désactiver le support HTML5
            'format' => 'yyyy-MM-dd', // Format de date
        ])
        ->add('address', TextType::class, [
            'label' => 'address'
        ])
        ->add('phone', TextType::class, [
            'label' => 'phone'
        ])
            
        ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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