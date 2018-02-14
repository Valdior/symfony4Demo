<?php

namespace App\Controller;

use App\Entity\Peloton;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PelotonController extends Controller
{
    public function index(RegistryInterface $doctrine)
    {
        $archers = $doctrine->getRepository(Peloton::class)->findBy(['isArcher' => true],['lastname' => 'ASC', 'firstname' => 'ASC']);

        return $this->render("archer/index.html.twig", compact('archers'));
    }

    public function show(Peloton $archer)
    {
        return $this->render("archer/show.html.twig", compact('archer'));
    }
}
