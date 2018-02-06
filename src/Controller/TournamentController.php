<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TournamentController extends Controller
{
    public function index(RegistryInterface $doctrine)
    {
        $tournaments = $doctrine->getRepository(Tournament::class)->findAll();

        return $this->render("tournament/index.html.twig", compact('tournaments'));
    }

    public function add(Request $request)
    {
        $tournament = new Tournament();
        $form = $this->createForm(TournamentType::class, $tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tournament);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Compétition "' . $tournament->getId() . '" bien enregistré.');

            return $this->redirectToRoute('tournament.index');
        }

        return $this->render(
            'tournament/add.html.twig',
            array('form' => $form->createView())
        );
    }

    public function show(Tournament $tournament)
    {
        return $this->render("tournament/show.html.twig", compact('tournament'));
    }
}
