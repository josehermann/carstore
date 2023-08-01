<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    //* une route est définie par 2 arguments : son chemin (/blog) dans l'url et son nom (app_blog)
    public function index(ArticleRepository $repo): Response
    {
        //*$repo est instance de la classe ArticleRepository et possède du cout les 4 méthodes de bases find(), findOneBy(), findAll(), findBy()
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            "articles" =>  $articles
        ]);
        //* render() permet d'afficher le contenu d'un template. Elle va chercher directement dans le dossier template
    }

    #[Route('/', name:'home')]
    public function home() : Response
    {
        return $this->render('blog/home.html.twig', [
            'title' => 'Bienvenu sur mon blog',
            'age' => 28,
        ]);
        // * dans le render en deuxième argument on peut envoyer des données dans la vue (twig) sous forme de tableau avec indice => valeur
        //* l'indice étant le nom de la variable dans le fichier twig et valeur sa valeur réel
    }

    #[Route('/blog/ajout', name:"blog_ajout")]
    public function form(Request $globals, EntityManagerInterface $manager ) : Response
    {
        $article = new Article;

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($globals);
        // * handleRequest() permet de récupérer tout les données de mes inputs
        if($form->isSubmitted() && $form->isValid())
        {
            // dd($globals->request);
            // $article->setTitle('un titre');
            $article->setCreatedAt(new \Datetime);
            // dd($article);
            //*persist() va permettre de préparer ma requete SQL a envoyer par rapport a l'objet donné en argument
            $manager->persist($article);
            //* flush() permettre d'executer tout les persist précédent
            $manager->flush();
            //* redirectToRoute() permet de rediriger vers une autre page de notre site a l'aide du nom de la route (name)
            return $this->redirectToRoute('home');
        }

        
        return $this->render('blog/form.html.twig', [
            'formArticle' => $form
        ]);
    }
}
