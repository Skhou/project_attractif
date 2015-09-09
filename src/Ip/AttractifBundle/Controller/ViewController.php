<?php

namespace Ip\AttractifBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ViewController extends Controller
{
    public function viewAdminAction()
    {
        $users = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Admin')
            ->findAll()
        ;

        return $this->render('IpAttractifBundle:View:viewAdmin.html.twig', array(
            'users' => $users,
        ));

    }

    public function viewCategoryAction()
    {
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Category')
            ->findAll()
        ;

        return $this->render('IpAttractifBundle:View:viewCategory.html.twig', array(
            'categories' => $categories,
        ));

    }

    public function viewEventAction()
    {
        $events = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Event')
            ->findAll()
        ;

        return $this->render('IpAttractifBundle:View:viewEvent.html.twig', array(
            'events' => $events,
        ));

    }

    public function viewLocationAction()
    {
        $locations = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Location')
            ->findAll()
        ;

        return $this->render('IpAttractifBundle:View:viewLocation.html.twig', array(
            'locations' => $locations,
        ));

    }

    public function viewUserAction()
    {
        $users = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:User')
            ->findAll()
        ;

        return $this->render('IpAttractifBundle:View:viewUser.html.twig', array(
            'users' => $users,
        ));

    }

    public function viewProductAction()
    {
        $products = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Product')
            ->findAll()
        ;

        return $this->render('IpAttractifBundle:View:viewProduct.html.twig', array(
            'products' => $products,
        ));

    }

    public function viewPurchaseAction()
    {
        $purchases = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Purchase')
            ->findAll()
        ;

        return $this->render('IpAttractifBundle:View:viewPurchase.html.twig', array(
            'purchases' => $purchases,
        ));
    }

    public function viewRequestAction($id, $randomSelect)
    {

        $repositoryEvent = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Event');
        $event = $repositoryEvent->find($id);

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('IpAttractifBundle:Request');

        if($randomSelect){
            $requests = $repository->findBy(array("event" => $id));

            foreach($requests as $request) {
                $request->setStatus("pending");
            }

            shuffle($requests);

            $y = 2;
            $i = 0;
            foreach($requests as $request) {
                $i++;
                if($i > $y) {
                    break;
                }
                $request->setStatus("accepted");
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $this->get('session')->getFlashBag()->add(
                "notice",
                "Tirage au sort effectué pour cet évènement"
            );

            return $this->redirect($this->generateUrl("ip_attractif_requests", array("id" => $id)));
        }

        $requestsPending = $repository->findWithEventByStatus("pending", $id);
        $requestsAccepted = $repository->findWithEventByStatus("accepted", $id);




        return $this->render('IpAttractifBundle:View:viewRequest.html.twig', array(
            'event' => $event,
            'requestsPending' => $requestsPending,
            'requestsAccepted' => $requestsAccepted,
        ));
    }


} 