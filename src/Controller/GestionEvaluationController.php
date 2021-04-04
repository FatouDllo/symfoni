<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Entity\Matiere;
use App\Entity\Etudiant;
use App\Form\MatiereType;
use App\Entity\Professeur;
use App\Form\EtudiantType;
use App\Form\ProfesseurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionEvaluationController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function home()
    {
        return $this->render('gestion_evaluation/home.html.twig');
    }

    /**
     * @Route("/etudiant/ajouter", name="ajouter_etudiant")
     */
    public function ajouterEtudiant(Request $request): Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            $this->addFlash('info', 'Etudiant ajouter avec succès!');
        }

        return $this->render(
            'gestion_evaluation/ajouter_etudiant.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/professeur/ajouter", name = "ajouter_professeur")
     */
    public function ajouterProfesseur(Request $request): Response
    {
        $professeur = new Professeur();
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($professeur);
            $em->flush();

            $this->addFlash('info', 'Professeur ajouter avec succès!');
        }

        return $this->render(
            'gestion_evaluation/ajouter_professeur.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/matiere/ajouter", name = "ajouter_matiere")
     */
    public function ajouterMatiere(Request $request): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            $this->addFlash('info', 'Matière ajouter avec succès!');
        }

        return $this->render(
            'gestion_evaluation/ajouter_matiere.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/note/ajouter", name = "ajouter_note")
     */
    public function ajouterNote(Request $request): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            $this->addFlash('info', 'Votre évaluation a été pris en compte!');
        }

        return $this->render(
            'gestion_evaluation/ajouter_note.html.twig',
            ['form' => $form->createView()]
        );
    }
}
