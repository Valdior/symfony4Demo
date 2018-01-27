<?php

namespace App\Controller;

use App\Entity\Tournament;
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
}
