<?php

namespace App\Controller;

use App\Entity\Peloton;
use App\Form\PelotonType;
use App\Entity\Tournament;
use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Form\ParticipantEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PelotonController extends Controller
{
    public function show(Peloton $peloton, RegistryInterface $doctrine)
    {
        return $this->render("peloton/show.html.twig", compact('peloton'));
    }

    public function add(Tournament $tournament, Request $request)
    {
        $peloton = new Peloton();
        $peloton->setTournament($tournament);
        
        $form = $this->createForm(PelotonType::class, $peloton);        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($peloton);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Peloton "' . $peloton->getId() . '" bien enregistré.');

            return $this->redirectToRoute('tournament.show', array('tournament' => $tournament->getId()));
        }

        return $this->render(
            'peloton/add.html.twig',
            array('form' => $form->createView(), 'tournament' => $tournament)
        );
    }

    public function addParticipant(Peloton $peloton, Request $request)
    {
        $participant = new Participant();
        $participant->setPeloton($peloton);
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();            
            $em->persist($participant);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le nouveau participant a bien été enregistré.');

            return $this->redirectToRoute('peloton.show', array('tournament' => $peloton->getTournament()->getId(), 'peloton' => $peloton->getId()));
        }

        return $this->render(
            'participant/add.html.twig',
            array('form' => $form->createView(), 'peloton' => $peloton)
        );
    }

    public function editParticipant(Peloton $peloton, Participant $participant, Request $request)
    {
        $form = $this->createForm(ParticipantEditType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();    
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le participant a bien été modifié.');

            return $this->redirectToRoute('peloton.show', array('tournament' => $peloton->getTournament()->getId(), 'peloton' => $peloton->getId()));
        }

        return $this->render(
            'participant/edit.html.twig',
            array('form' => $form->createView(), 'participant' => $participant, 'peloton' => $peloton)
        );
    }
}
