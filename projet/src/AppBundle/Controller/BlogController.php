<?php
/**
 * Created by PhpStorm.
 * User: daly
 * Date: 08/05/2017
 * Time: 13:24
 */

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\Entity\Blog;
use AppBundle\Form\Type\BlogType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{

 /**
 * @Route("/list", name="list")
 */
    public function listAction(Request $request)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $repository=$em->getRepository(Blog::class);
        $blogs=$repository->findAll();
        return $this->render('default/list.html.twig',['blogs'=>$blogs]);
    }
    /**
     * @Route("/list/details/{id}", name="detail")
     */
    public function listDetailsAction(Blog $blog)
    {
        return $this->render('default/detail.html.twig',['blog'=>$blog]);
    }

    /**
     * @Route("/blog/details/{id}/mark", name="mark")
     */
    public function markAction(Blog $blog)
    {
        if($blog->getPublished()){
            $this->addFlash('error','this contact already ');
        }
        else {
            $blog->setPublished(true);
            $this->addFlash('success','this contact has been marked as..');
            $em=$this->get('doctrine.orm.entity_manager');
            $em->flush();
        }
        return $this->redirectToRoute('list',['id'=>$blog->getId()]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutAction(Request $request)
    {
        $blog=new Blog();
        $form = $this->createForm(BlogType::class,$blog);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $blog->setPublishedAt(new \DateTime());
            $blog->setPublished(false);
            $em=$this->get('doctrine.orm.entity_manager');
            $em->persist($blog);
            $em->flush();


            $messgae=sprintf('Contact ajouté avec succes');
            $this->addFlash('success',$messgae); // message de remerciement
            return $this->redirectToRoute('home'); // redirection vers une autre page

        }

        return $this->render('default/ajout.html.twig',['form'=>$form->createView()]);
    }
}