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
    public function show(Tournament $tournament)
    {
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
}
