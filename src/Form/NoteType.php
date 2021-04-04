<?php

namespace App\Form;

use App\Entity\Note;
use App\Entity\Matiere;
use App\Entity\Etudiant;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note', IntegerType::class, ['attr' => ['max' => 20, 'min' => 0]])
            ->add('commentaire', TextareaType::class)
            ->add(
                'etudiant',
                EntityType::class,
                [
                    'class' => Etudiant::class,
                    'choice_label' => function ($etudiant) {
                        return "{$etudiant->getNom()} {$etudiant->getPrenom()}";
                    },
                    'expanded' => false,
                    'multiple' => false
                ]
            )
            ->add(
                'matiere',
                EntityType::class,
                [
                    'class' => Matiere::class,
                    'choice_label' => 'libelle',
                    'expanded' => false,
                    'multiple' => false
                ]
            )
            ->add(
                'professeur',
                EntityType::class,
                [
                    'class' => Professeur::class,
                    'choice_label' => function ($professeur) {
                        return "{$professeur->getNomProfesseur()}
                            {$professeur->getPrenomProfesseur()}";
                    },
                    'expanded' => false,
                    'multiple' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
