<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function index()
    {
        return $this->render("post/index.html.twig");
    }
}
