<?php
// src/Controller/BlogController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Thomas',
        ]);
    }

    /**
     * @Route("/blog/show/{page}", requirements={"page"="[a-z0-9-]+"}, name="blog_show")
     */
    public function show($page = "Article Sans Titre")
    {
        $page = str_replace("-", " ", $page);
        $page = ucwords(strtolower($page));
        return $this->render('blog/show.html.twig', [
            'page' => $page,
        ]);
    }



}