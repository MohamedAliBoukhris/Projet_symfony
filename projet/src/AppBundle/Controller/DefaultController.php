<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $repository=$em->getRepository(Blog::class);
        $blogs=$repository->findAll();
        return $this->render('default/list.html.twig',['blogs'=>$blogs]);
    }
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $repository=$em->getRepository(Blog::class);
        $blogs=$repository->findAll();
        return $this->render('default/list.html.twig',['blogs'=>$blogs]);
    }
}
