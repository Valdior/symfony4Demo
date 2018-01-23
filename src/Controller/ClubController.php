<?php

namespace App\Controller;

use App\Entity\Club;
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
}
