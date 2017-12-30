<?php

namespace App\Controller;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Post;

class PostController extends Controller
{
    public function index(RegistryInterface $doctrine)
    {
        $posts = $doctrine->getRepository(Post::class)->findAll();


        return $this->render("post/index.html.twig", compact('posts'));
    }
}
