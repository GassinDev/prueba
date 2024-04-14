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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add form fields for username, email, agreeTerms checkbox, password, profile picture, and submit button
        $builder
            ->add('username') // Field for username
            ->add('email') // Field for email
            ->add('agreeTerms', CheckboxType::class, [ // Checkbox for agreeing to terms
                'mapped' => false, // This field is not mapped to the User entity
                'constraints' => [ // Validation constraints for the checkbox
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('Password', PasswordType::class, [ // Field for password
                'mapped' => false, // This field is not mapped to the User entity
                'attr' => ['autocomplete' => 'new-password'], // Set autocomplete attribute to 'new-password'
                'constraints' => [ // Validation constraints for the password
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('fotoPerfil', FileType::class) // Field for profile picture
            ->add('submit', SubmitType::class, [ // Submit button
                'label' => 'Registrarme', // Button label
                'attr' => ['class' => 'btn btn-primary'], // CSS class for styling
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Configure the form options
        $resolver->setDefaults([
            'data_class' => User::class, // Data class for the form (User entity)
        ]);
    }
}
