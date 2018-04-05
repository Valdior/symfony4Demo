<?php

namespace App\Controller;

use App\Entity\Peloton;
use App\Form\PelotonType;
use App\Entity\Tournament;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PelotonController extends Controller
{
    public function show(Peloton $peloton)
    {
        return $this->render("peloton/show.html.twig", compact('peloton'));
    }

    public function add(Tournament $tournament, Request $request)
    {
        $peloton = new Peloton();
        $form = $this->createForm(PelotonType::class, $peloton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $peloton->setTournament($tournament);
            $em->persist($peloton);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Peloton "' . $peloton->getId() . '" bien enregistré.');

            return $this->redirectToRoute('tournament.index');
        }

        return $this->render(
            'peloton/add.html.twig',
            array('form' => $form->createView(), 'tournament' => $tournament)
        );
    }

    public function addParticipant(Peloton $peloton, Request $request)
    {
        $participant = new Participant();
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $peloton->setPeloton($peloton);
            $em->persist($participant);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le nouveau participant a bien été enregistré.');

            return $this->redirectToRoute('tournament.index');
        }

        return $this->render(
            'peloton/add.html.twig',
            array('form' => $form->createView(), 'peloton' => $peloton)
        );
    }
}
