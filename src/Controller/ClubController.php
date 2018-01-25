<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use App\Entity\Affiliate;
use App\Form\AffiliateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClubController extends Controller
{
    public function index(RegistryInterface $doctrine)
    {
        $clubs = $doctrine->getRepository(Club::class)->findBy([],['region' => 'ASC', 'number' => 'ASC']);

        return $this->render("club/index.html.twig", compact('clubs'));
    }


    public function show(Club $club)
    {
        //$clubs = $doctrine->getRepository(Club::class)->findBy([],['region' => 'ASC', 'number' => 'ASC']);

        return $this->render("club/show.html.twig", compact('club'));
    }

    public function add(Request $request)
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Club "' . $club->getName() . '" bien enregistré.');

            return $this->redirectToRoute('club.index');
        }

        return $this->render(
            'club/add.html.twig',
            array('form' => $form->createView())
        );
    }

    public function addAffiliateMember(Club $club, Request $request)
    {
        $affiliate = new Affiliate();
        $form = $this->createForm(AffiliateType::class, $affiliate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($affiliate);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'L\'affiliation de l\'archer a bien été enregistré.');

            return $this->redirectToRoute('club.index');
        }

        return $this->render(
            'club/addAffiliate.html.twig',
            array('form' => $form->createView())
        );
    }
}
