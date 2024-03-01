<?php

namespace App\Form;

use App\Entity\Protocoles;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'label' => false, // Ajustez selon le besoin
                    'choices' => [
                        'Admin' => 'ROLE_ADMIN',
                        'User' => 'ROLE_USER',
                        // Ajoutez autant de rôles que nécessaire
                    ],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_data' => 'ROLE_USER', // Valeur par défaut pour les nouveaux éléments
            ])
            ->add('password')
            ->add('nom_utilisateur')
            ->add('prenom_utilisateur')
            ->add('numero_rue_utilisateur')
            ->add('rue_utilisateur')
            ->add('ville_utilisateur')
            ->add('code_postal_utilisateur')
            ->add('pays_utilisateur')
            ->add('telephone_utilisateur')
            ->add('isVerified')
            ->add('relation', EntityType::class, [
                'class' => Protocoles::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
