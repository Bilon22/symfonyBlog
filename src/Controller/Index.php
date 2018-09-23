<?php
    namespace App\Controller;

    use App\Entity\Article;
    use App\Entity\Users;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class Index extends AbstractController{
        /**
         * Route("/", name="article_list")
         * @Method({"GET"})
         */
        public function index() {
            $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

            return $this->render('pages/index.html.twig', array('articles' => $articles));
        }

        /**
         * @Route("/article/save")
         */
        public function save(){
            $entityManager = $this -> getDoctrine()->getManager();

            $article = new Article();
            $article -> setTitle('Article Two');
            $article -> setContent('Two funny texts');
            $article -> setAuthor('Dawid');
            $article -> setDate('20.03.2018');

            $entityManager->persist($article);

            $entityManager->flush();

            return new Response('Saves an article with the id of '.$article->getId());
        }
        
        /**
         * @Route("/articleCreate")
         */
        public function articleCreate(Request $request){
            // $entityManager = $this -> getDoctrine()->getManager();

             $article = new Article();
            // $article -> setTitle('Article Two');
            // $article -> setContent('Two funny texts');
            // $article -> setAuthor('Dawid');
            // $article -> setDate('20.03.2018');

            // $entityManager->persist($article);
            // $entityManager->flush();
    
            $form = $this->createFormBuilder( $article)
                ->add('title', TextType::class)
                ->add('content', TextareaType::class)
                ->add('save', SubmitType::class, array('label' => 'Article'))
                ->getForm();
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this -> getDoctrine()->getManager();
                $article = $form->getData();
                $article -> setAuthor('Dawid');
                $article -> setDate('20.03.2018');
                $entityManager->persist($article);
                $entityManager->flush();

                $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
                return $this->render('pages/index.html.twig', array('articles' => $articles));
            }
            return $this->render('pages/registration.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        /**
         * @Route("/article/{id}", name = "article_show")
         */
        public function show($id){
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            return $this->render('pages/article.html.twig',array('article' => $article));
        }

        /**
         * Route("/about")
         * @Method({"GET"})
         */
        public function about() {
            return $this->render('pages/about.html.twig');
        }
        /**
         * Route("/login")
         * @Method({"GET"})
         */
        public function login() {
            return $this->render('pages/login.html.twig');
        }
        /**
         * Route("/registration")
         * @Method({"GET"})
         */
        public function registration(Request $request){
            $entityManager = $this -> getDoctrine()->getManager();

            $users = new Users();
            $users -> setLogin('admin');
            $users -> setPassword('12345');
            $users -> setEmail('admin@admin.pl');

            $entityManager->persist($users);
            $entityManager->flush();
    
            $form = $this->createFormBuilder($users)
                ->add('email', TextType::class)
                ->add('login', TextType::class)
                ->add('password', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Register'))
                ->getForm();
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $task = $form->getData();

                return $this->redirectToRoute('task_success');
            }
            return $this->render('pages/registration.html.twig', array(
                'form' => $form->createView(),
            ));
        }
        /**
         * Route("/article")
         * @Method({"GET"})
         */
        public function article() {
            return $this->render('pages/article.html.twig');
        }
    }
?>