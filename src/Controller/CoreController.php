<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function index()
    {
        return $this->render("core/index.html.twig");
    }
}
