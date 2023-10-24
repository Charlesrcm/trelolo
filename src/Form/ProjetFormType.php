<?php

namespace App\Form;

use App\Entity\Priorite;
use App\Entity\Projet;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = new Utilisateur;
        // dd($user);
        $user = $user->getId();

        $builder
            ->add('nom_projet', TypeTextType::class, [
                'label' => 'Nom du projet'
            ])
            ->add('priorite', Priorite::class, [
                'choices' => [
                    "A faire" => null,
                    "Urgent" => null,
                    "Prioritaire" => null
                ]
            ])
            ->add('enregistrer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
