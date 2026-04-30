<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType; // ✅ À utiliser
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Adresse Email',
                'attr' => ['placeholder' => 'contact@entreprise'] // Optionnel : pour ajouter un indice
            ])
            ->add('first_name', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => ' Antoine'] // Optionnel : pour ajouter un indice
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => ' Dupont'] // Optionnel : pour ajouter un indice
            ])
            ->add('company_name', TextType::class, [
                'label' => 'Raison Sociale',
                'attr' => ['placeholder' => ' Tech Solutions'] // Optionnel : pour ajouter un indice
            ])
            ->add('iban', TextType::class, [
                'label' => 'IBAN',
                'attr' => ['placeholder' => 'FR76 1234 5678 9012 3456 7890 123'] // Optionnel : pour ajouter un indice
            ])
            ->add('agreeTerms', CheckboxType::class, [
                                'mapped' => false,
                'constraints' => [
                    new IsTrue(
                        message: 'You should agree to our terms.',
                    ),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank(
                        message: 'Please enter a password',
                    ),
                    new Length(
                        min: 6,
                        minMessage: 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        max: 4096,
                    ),
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
