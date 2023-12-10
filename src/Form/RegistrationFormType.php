<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z]).+$/',
                        'message' => "Le mot de passe doit contenir au moins une minuscule.",
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[A-Z]).+$/',
                        'message' => "Le mot de passe doit contenir au moins une majuscule.",
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*\d).+$/',
                        'message' => "Le mot de passe doit contenir au moins un chiffre.",
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[\W_]).+$/',
                        'message' => "Le mot de passe doit contenir au moins un caratère spéciale.",
                    ]),
                ],
            ])

            ->add("nom", TextType::class)

            ->add("isAdmin", ChoiceType::class, [
                'choices' => [
                    "Admin" => true,
                    "Utilisateur" => false,
                ],
                "placeholder" => "choisissez un type de profil",
                'label' => "Type de compte"
            ])
            ->add("submit", SubmitType::class, [
                'label' => "Création"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
