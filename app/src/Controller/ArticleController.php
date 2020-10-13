<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  // Controller/Controller has been depricated in Symfony 5. Use
  // AbstractController as a replacement
  // https://stackoverflow.com/questions/59798041/class-controller-not-found-while-loading
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use App\Entity\Article;

  # Article Controller will extend twig controller
  class ArticleController extends AbstractController {
    /**
     * @Route("/", name="artcile_index")
     * @Method({"GET"})
     */

    public function index() {
      // Return static response:
      // return new Response("<body><h1>Hello Symfony</h1></body>");

      // $articles = ['Article 1', 'Article 2'];
      $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

      return $this->render('articles/index.html.twig', array('name' => 'Andy', 'articles' => $articles));
    }

    /**
     * @Route("/articles/save", name="article_save")
     */

    public function save() {
      // Sets up GET route that writes to the Database
      // Set up Entity Manager (Doctrine) to interact with DB
      $entityManager = $this->getDoctrine()->getManager();

      $article = new Article();
      $article->setTitle("Article One");
      $article->setBody("This is article one");
      $article->setAuthor("Me");
      $entityManager->persist($article);
      $entityManager->flush();

      return new Response('Saved an article with ID of '.$article->getId());
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */

    public function show($id) {
      $article = $this
        ->getDoctrine()
        ->getRepository(Article::class)
        ->find($id);

      return $this->render(
        'articles/show.html.twig',
        array('article' => $article)
      );
    }

  }
