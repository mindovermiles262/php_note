<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  // Controller/Controller has been depricated in Symfony 5. Use
  // AbstractController as a replacement
  // https://stackoverflow.com/questions/59798041/class-controller-not-found-while-loading
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  # Article Controller will extend twig controller
  class ArticleController extends AbstractController {
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index() {
      // Return static response:
      // return new Response("<body><h1>Hello Symfony</h1></body>");

      $articles = ['Article 1', 'Article 2'];

      return $this->render('articles/index.html.twig', array('name' => 'Andy', 'articles' => $articles));
    }
  }
