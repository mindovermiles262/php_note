<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;

  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  // Controller/Controller has been depricated in Symfony 5. Use
  // AbstractController as a replacement
  // https://stackoverflow.com/questions/59798041/class-controller-not-found-while-loading
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use App\Entity\Article;

  # Article Controller will extend twig controller
  class ArticleController extends AbstractController {
    /**
     * @Route("/", name="article_index")
     * @Method({"GET"})
     */

    public function index() {

      $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

      return $this->render(
        'articles/index.html.twig', 
        array(
          'name' => 'Andy', 
          'articles' => $articles
        )
      );
    }


    /**
     * @Route("/article/save", name="article_save")
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
     * @Route("/article/new", name="article_new")
     * Method({"GET", "POST"})
     */
     public function new(Request $request) {
        $article = new Article();

        $form = $this->createFormBuilder($article)
          ->add('title', TextType::class, array(
            'attr' => array(
              'class' => 'form-control'
            )
          ))
          ->add('author', TextType::class, array(
            'attr' => array(
              'class' => 'form-control'
            )
          ))
          ->add('body', TextareaType::class, array(
            'required' => false,
            'attr' => array(
              'class' => 'form-control'
            )
          ))
          ->add('save', SubmitType::class, array(
            'label' => 'Create',
            'attr' => array(
              'class' => 'btn btn-primary mt-3'
            )
          ))
          ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush(); 

            // 'article_index' is the name of the index() route
            return $this->redirectToRoute('article_index'); 
          }

          return $this->render(
            'articles/new.html.twig', array(
              'form' => $form->createView()
            )
          );
     }


    /**
     * @Route("/article/edit/{id}", name="article_edit")
     * Method({"GET", "POST"})
     */
     public function edit(Request $request, $id) {
        $article = new Article();

        $article = $this
          ->getDoctrine()
          ->getRepository(Article::class)
          ->find($id);

        $form = $this->createFormBuilder($article)
          ->add('title', TextType::class, array(
            'attr' => array(
              'class' => 'form-control'
            )
          ))
          ->add('author', TextType::class, array(
            'attr' => array(
              'class' => 'form-control'
            )
          ))
          ->add('body', TextareaType::class, array(
            'required' => false,
            'attr' => array(
              'class' => 'form-control'
            )
          ))
          ->add('save', SubmitType::class, array(
            'label' => 'Create',
            'attr' => array(
              'class' => 'btn btn-primary mt-3'
            )
          ))
          ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush(); 

            // 'article_index' is the name of the index() route
            return $this->redirectToRoute('article_index'); 
          }

          return $this->render(
            'articles/edit.html.twig', array(
              'form' => $form->createView()
            )
          );
     }


     /**
      * @Route("/article/delete/{id}")
      * Method({"DELETE"})
      */
    public function delete(Request $request, $id) {
      $article = $this
        ->getDoctrine()
        ->getRepository(Article::class)
        ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush(); 

        $response = new Response();
        $response->send();
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
