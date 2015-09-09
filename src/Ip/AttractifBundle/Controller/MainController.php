<?php

namespace Ip\AttractifBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;

class MainController extends Controller{

    public function indexAction()
    {
        $events = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Event')
            ->findAll();
        ;

        $purchase = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Purchase')->getMostPurchased();

        return $this->render("IpAttractifBundle:Main:index.html.twig", array(
            "events" => $events,
            "purchases" => $purchase
        ));
    }

    public function loginAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('ip_attractif_index'));
        }

        $session = $request->getSession();

        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }

        return $this->render("IpAttractifBundle:Main:login.html.twig", array(
            'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
            'error' => $error,
        ));
    }

    public function testAction()
    {

        $em = $this->getDoctrine()->getEntityManager();

        $users = $em->getRepository('IpAttractifBundle:User')->findAll();
        $handle = fopen('php://memory', 'r+');
        $header = array();

        foreach ($users as $user) {
            fputcsv($handle, get_object_vars($user));
        }

        return $this->render("IpAttractifBundle:Main:test.html.twig", array(

        ));
    }

} 