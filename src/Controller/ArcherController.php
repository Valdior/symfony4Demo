<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArcherController extends Controller
{
    public function index(RegistryInterface $doctrine)
    {
        $archers = $doctrine->getRepository(User::class)->findBy(['isArcher' => true],['lastname' => 'ASC', 'firstname' => 'ASC']);

        return $this->render("archer/index.html.twig", compact('archers'));
    }

    public function show(User $archer)
    {
        return $this->render("archer/show.html.twig", compact('archer'));
    }
}
