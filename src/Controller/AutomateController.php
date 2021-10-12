<?php


namespace App\Controller;

use App\Entity\Analyse;
use App\Entity\Echantillon;
use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AutomateController extends AbstractController

{
    /**
     * @return Response
     * @Route ("/listehopital")
     */
    #[Route(path: "/listehopital")]
    public function demo(EntityManagerInterface $em)
    {
        $echantillons = $em->getRepository(Echantillon::class)->findAll();
        dump($echantillons);
        return new Response('Il y a '.count($echantillons).' echantillons.');
    }

    #[Route(path: "/listeana")]
    public function listeAnalyse(EntityManagerInterface $em)
    {
        $analyses = $em->getRepository(Analyse::class)->findAll();
        dump($analyses);
        return new Response('Il y a '.count($analyses).' analyses.');
    }

    #[Route(path: "/createpatient")]
    public function createPatient(EntityManagerInterface $em)
    {

        // Création de la promo M3
        $hopital1 = new Echantillon('nouveaunom1');
        $em->persist($hopital1);
        $hopital1->type = 'nouveaunom2';

        // Ou autre façon d'avoir la promo
        $hopital = $em->getRepository(Echantillon::class)->findOneBy(['nom_hopital' => 'CHU Poitiers']);

        //$em->remove($promoL3);
        $patient = new Patient('Toto', 'Tutu', 20, $hopital);
        $em->persist($patient);

        $em->flush();
        dump($patient);
        return new Response(' ');

    }

    #[Route(path: "/patients")] // récupérer tous les étudiants en format json
    public function premiereRoute(EntityManagerInterface $em)
    {
        $liste = $em->getRepository(Patient::class)->findAll();
        return $this->render('patients.json.twig', ['liste' => $liste]);
    }

    #[Route(path: "/patient/{id}", methods: ['GET'])] // récupérer tous les étudiants en format json
    public function secondeRoute(EntityManagerInterface $em, int $id)
    {
        $patient = $em->getRepository(Patient::class)->find($id);
        //Solution 1 pour afficher l'étutiant
        // $r = '{"nom" : "'.$etu->name.'", "id" : "'.$etu->id.'" }';

        //solution 2
        return $this->render('patient.json.twig', ['patient' => $patient]);

    }

    #[Route(path: "/patient/{id}", methods: ['DELETE'])] // récupérer tous les étudiants en format json
    public function troisiemeRoute(EntityManagerInterface $em, int $id)
    {
        $patient = $em->getRepository(Patient::class)->find($id);
        $em->remove($patient);
        $em->flush();

        return new Response('ok');
    }

    #[Route(path: "/patient/{id}", methods: ['PUT'])]
    public function quatriemeRoute(Request $request, EntityManagerInterface $em, int $id)
    {
        $data = json_decode($request->getContent()); //récupération de ce qu'on a ajouté dans POSTMAN

        $patient = $em->getRepository(Patient::class)->find($id);

        $patient->nom = $data->nom; //récupération de la nouvelle valeur dans le name de l'étudiant
      //  $patient->prenom = $data->prenom;
        $em->flush();
        return $this->render('patient.json.twig', ['patient' => $patient]);
    }

    #[Route(path: "/patient", methods: ['POST'])]
    public function cinquiemeRoute(Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent()); //récupération de ce qu'on a ajouté dans POSTMAN
        $nom=$data->nom;
        $prenom=$data->prenom;
        $age=$data->age;
        $hopital = $em->getRepository(Echantillon::class)->findOneBy(['nom_hopital' => 'CHU Poitiers']);
        $patient = new Patient($nom, $prenom, $age, $hopital);
        $em->persist($patient);

        $em->flush();
        return $this->render('patient.json.twig', ['patient' => $patient]);
    }

}

