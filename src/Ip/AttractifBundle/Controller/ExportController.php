<?php
/**
 * Created by PhpStorm.
 * User: ghenao
 * Date: 11/12/2014
 * Time: 11:00
 */

namespace Ip\AttractifBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExportController extends Controller
{
    /**
     * Export users
     *
     * @return Response
     */
    public function exportAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('IpAttractifBundle:User')->findAll();
        $handle = fopen('php://memory', 'r+');
        $header = array();

        foreach ($users as $user) {

            $requests = array();
            foreach ($user->getRequests() as $request) {
                $requests []= $request->getEvent()->getName();
            }

            $values = array();
            $values["username"] = $user->getUsername();
            $values["email"] = $user->getEmail();
            $values["event"] = implode("/", $requests);
            fputcsv($handle, $values);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return new Response($content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="export.csv"'
        ));
    }

} 