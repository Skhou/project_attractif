<?php
/**
 * Created by PhpStorm.
 * User: sykhou
 * Date: 09/12/2014
 * Time: 10:05
 */

namespace Ip\AttractifBundle\Controller;

use Ip\AttractifBundle\Entity\Admin;
use Ip\AttractifBundle\Entity\Purchase;
use Ip\AttractifBundle\Form\AdminType;
use Ip\AttractifBundle\Form\PurchaseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class FormController extends Controller
{

    protected function checkEntityTypes($entityType)
    {
        $entityTypesAllowed = array("admin", "purchase", "user", "request", "product", "location", "event", "category");

        return in_array($entityType, $entityTypesAllowed);
    }

    public function createAction(Request $request, $entityType)
    {
        if(!$this->checkEntityTypes($entityType)) {
            throw new NotFoundHttpException("Cette page n'existe pas...");
        }

        $object = "Ip\\AttractifBundle\\Entity\\" . ucfirst($entityType);
        $entity = new $object();
        $formType = "Ip\\AttractifBundle\\Form\\" . ucfirst($entityType) . "Type";
        $form = $this->createForm(new $formType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            if(method_exists($entity, "getFile")) {
                if($entity->getFile()) {
                    $entity->upload();
                }
            }
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                "notice",
                "$entityType enregistré(e)"
            );

            return $this->redirect($this->generateUrl('ip_attractif_create', array("entityType" => $entityType)));
        }

        $entityType = ucfirst($entityType);

        return $this->render("IpAttractifBundle:Form:create$entityType.html.twig", array(
            "entityType" => $entityType,
            "typeOfAction" => "Création",
            "bouton"    => "Ajouter",
            "form" => $form->createView()
        ));

    }

    public function createPurchaseAction(Request $request)
    {
        $purchase = new Purchase();
        $form = $this->createForm(new PurchaseType(), $purchase);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $product = $purchase->getProduct();
            $stock = (int) $product->getStock() - (int) $purchase->getQuantity();
            $product->setStock($stock);
            $em->persist($purchase);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Votre achat a été bien enregistré'
            );

            return $this->redirect($this->generateUrl('ip_attractif_create_purchase'));
        }

        return $this->render('IpAttractifBundle:Form:createPurchase.html.twig', array(
            'form' => $form->createView(),
            "bouton"    => "Ajouter"
        ));
    }

    public function createAdminAction(Request $request)
    {
        $admin = new Admin();
        $form = $this->createForm(new AdminType(), $admin);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'L\'utilisateur a été bien enregistré'
            );

            return $this->redirect($this->generateUrl('ip_attractif_create_admin'));
        }

        return $this->render('IpAttractifBundle:Form:register.html.twig', array(
            'form' => $form->createView(),
            "bouton"    => "Ajouter",
            "typeOfAction" => "Création",
        ));

    }

    public function editAction(Request $request, $entityType, $id)
    {

        if(!$this->checkEntityTypes($entityType)) {
            throw new NotFoundHttpException("Cette page n'existe pas..");
        }

        $formType = "Ip\\AttractifBundle\\Form\\" . ucfirst($entityType) . "Type";

        $manager = $this->getDoctrine()->getManager();
        $entity = $manager->getRepository("IpAttractifBundle:" . ucfirst($entityType))->find($id);

        $form = $this->createForm(new $formType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $manager->flush();

            $this->get('session')->getFlashBag()->add(
                "notice",
                "La modification a été effectuée"
            );

            return $this->redirect($this->generateUrl('ip_attractif_view_' . ucfirst($entityType)));
        }

        return $this->render("IpAttractifBundle:Form:create$entityType.html.twig", array(
            "entityType" => $entityType,
            "typeOfAction" => "Modification",
            "bouton"    => "Modifier",
            "form" => $form->createView()
        ));
    }

    public function modifyPurchaseAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $purchase = $manager->getRepository("IpAttractifBundle:Purchase")->find($id);

        $initialQuantity = $purchase->getQuantity();
        $form = $this->createForm(new PurchaseType(), $purchase);

        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($initialQuantity != $purchase->getQuantity()) {
                $newDiff = (int) $initialQuantity - (int) $purchase->getQuantity();
                $product = $purchase->getProduct();
                $product->setStock((int) $product->getStock() + $newDiff);
            }

            $manager->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'La commande a été bien modifiée'
            );

            return $this->redirect($this->generateUrl('ip_attractif_view_purchase'));
        }

        return $this->render('IpAttractifBundle:Form:createPurchase.html.twig', array(
            'form' => $form->createView(),
            "bouton"    => "Modifier"
        ));
    }

    public function modifyAdminAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $admin = $manager->getRepository("IpAttractifBundle:Admin")->find($id);

        $form = $this->createForm(new AdminType(), $admin);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $manager->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'L\'utilisateur a été bien modifié'
            );

            return $this->redirect($this->generateUrl('ip_attractif_view_admin'));
        }

        return $this->render('IpAttractifBundle:Form:register.html.twig', array(
            'form' => $form->createView(),
            "typeOfAction" => "Modification",
            'bouton'    => "Modifier",
        ));
    }

    public function deleteAction(Request $request, $entityType, $id)
    {
        if(!$this->checkEntityTypes($entityType)) {
            throw new NotFoundHttpException("Cette page n'existe pas..");
        }

        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Vous n'avez pas les permissions permettant de supprimer du contenu, contacter votre administrateur");
        }

        $manager = $this->getDoctrine()->getManager();
        $entity = $manager->getRepository("IpAttractifBundle:" . ucfirst($entityType))->find($id);

        $manager->remove($entity);
        $manager->flush();

        $this->get('session')->getFlashBag()->add(
            "notice",
            "$entityType supprimé(e)"
        );

        return $this->redirect($this->generateUrl('ip_attractif_view_' . $entityType));
    }
} 