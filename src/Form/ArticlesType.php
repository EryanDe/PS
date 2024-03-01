<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('image_article', FileType::class, [
            'label' => 'Image de l\'article',
            
            // Ne pas mapper directement à la propriété de l'entité si vous gérez le fichier manuellement dans le contrôleur
            'mapped' => false,

            // Rendre ce champ facultatif pour ne pas avoir à télécharger une image à chaque fois que vous éditez l'article
            'required' => false,

            // Ajouter des contraintes de fichier
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpeg',
                        'image/jpg',
                        'image/gif',
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger une image valide (png, jpeg, jpg, gif)',
                ])
            ],
        ])
            ->add('titre_article')
            ->add('contenu_article', TextareaType::class, [
                'label' => 'Contenu de l\'article',
                // Autres options comme 'required'
                'attr' => [
                    'style' => 'height: 200px;width: 100%;',
                    // Ajoutez votre style ici
                    // Vous pouvez ajouter d'autres attributs ici si nécessaire
                ],
            ])
            ->add('date_creation_article')
            ->add('source_article', TextareaType::class, [
                'label' => 'Source de l\'article',
                // Autres options comme 'required'
                'attr' => [
                    'style' => 'width: 100%;',
                    // Ajoutez votre style ici
                    // Vous pouvez ajouter d'autres attributs ici si nécessaire
                ],
            ])
            ->add('auteur_article')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
