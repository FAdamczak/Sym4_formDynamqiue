<?php

namespace App\Controller;

use App\Form\GeoType;
use App\Controller\Geo;
use App\Form\PaysType;
use App\Repository\MonumentRepository;
use App\Repository\PaysRepository;
use App\Repository\VilleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{

    /** 
     * @Route("/testJS", name="testJS")
     */
    public function avecJQuery(VilleRepository $rv, MonumentRepository $rm, Request $request) {
        
        $villes = $rv->findAll();
        $monuments = $rm->findAll();
        $form = $this->createForm(PaysType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump("Form submitted");
        }

        return $this->render('test/indexJS.html.twig', [
            'villes' => $villes,
            'monuments' => $monuments,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/", name="testEvent")
     */
    public function testListner(Request $request, PaysRepository $repo): Response
    {
        $pays = $repo->findOneBy(["id" => 1]);
        $ville = $pays->getVilles()[0];
        
        $geo = new Geo();
        $geo->setPays($pays);
        $geo->setVille($ville);
        //$geo->setMonument(null);

        $form = $this->createForm(GeoType::class, $geo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump("ici");
        }
        return $this->render('test/indexEvent.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
