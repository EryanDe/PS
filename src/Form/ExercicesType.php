<?php

namespace App\Form;

use App\Entity\Exercices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExercicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_exercice')
            ->add('duree_exercice')
            ->add('frequence_exercice')
            ->add('etat_exercice')
            ->add('description_exercice')
            ->add('materiel_exercice')
            ->add('contenu_facile_exercice')
            ->add('contenu_difficile_exercice')
            ->add('protocoles')
            ->add('semaines')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercices::class,
        ]);
    }
}
