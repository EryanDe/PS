<?php

namespace App\Form;

use App\Entity\Exercices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('contenu_facile_exercice', TextareaType::class, [
                'label' => 'Contenu facile',
                // Autres options comme 'required'
                'attr' => [
                    'style' => 'height: 200px;width: 100%;',
                    // Ajoutez votre style ici
                    // Vous pouvez ajouter d'autres attributs ici si nécessaire
                ],
            ])
            ->add('contenu_difficile_exercice', TextareaType::class, [
                'label' => 'Contenu facile',
                // Autres options comme 'required'
                'attr' => [
                    'style' => 'height: 200px;width: 100%;',
                    // Ajoutez votre style ici
                    // Vous pouvez ajouter d'autres attributs ici si nécessaire
                ],
            ])
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
