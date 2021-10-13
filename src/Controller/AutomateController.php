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

    // AFFICHAGE DES OBJETS ( liste et unitaire) //

    /**
     * Permet d'afficher la liste des patients
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: "/patients")]
    public function routeAffichePatientListe(EntityManagerInterface $em)
    {
        $liste = $em->getRepository(Patient::class)->findAll();
        return $this->render('patients.json.twig', ['liste' => $liste]);
    }

    /**
     * Permet d'afficher un patient
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/patient/{id}", methods: ['GET'])]
    public function routeAffichePatient(EntityManagerInterface $em, int $id)
    {
        $patient = $em->getRepository(Patient::class)->find($id);
        return $this->render('patient.json.twig', ['patient' => $patient]);
    }

    /**
     * Permet d'afficher la liste des analyses
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: "/analyses")]
    public function routeAfficheAnalyseListe(EntityManagerInterface $em)
    {
        $liste = $em->getRepository(Analyse::class)->findAll();
        return $this->render('analyses.json.twig', ['liste' => $liste]);
    }

    /**
     * Permet d'afficher une analyse
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/analyse/{id}", methods: ['GET'])]
    public function routeAfficheAnalyse(EntityManagerInterface $em, int $id)
    {
        $analyse = $em->getRepository(Analyse::class)->find($id);
        return $this->render('analyse.json.twig', ['analyse' => $analyse]);
    }

    /**
     * Permet d'afficher la liste des échantillons
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: "/echantillons")]
    public function routeAfficheEchantillonListe(EntityManagerInterface $em)
    {
        $liste = $em->getRepository(Echantillon::class)->findAll();
        return $this->render('echantillons.json.twig', ['liste' => $liste]);
    }

    /**
     * Permet d'afficher un échantillon
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/echantillon/{id}", methods: ['GET'])]
    public function routeAfficheEchantillon(EntityManagerInterface $em, int $id)
    {
        $echantillon = $em->getRepository(Echantillon::class)->find($id);
        return $this->render('echantillon.json.twig', ['echantillon' => $echantillon]);
    }

    /**
     * Permet d'afficher la liste des echantillons d'un patient
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/patientEch/{id}", methods: ['GET'])]
    public function routeAffichePatientListeEch(EntityManagerInterface $em, int $id)
    {
        $patient = $em->getRepository(Patient::class)->find($id);
        $listeEch = $em->getRepository(Echantillon::class)->findBy(['patient'=> $patient]);

        return $this->render('echantListePat.json.twig', ['liste' => $listeEch, 'patient' => $patient]);
    }


    // CREATION DES OBJETS //

    /**
     * Permet de creer un nouveau patient
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: "/patient", methods: ['POST'])]
    public function routeCreationPatient(Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent());

        $nom=$data->nom;
        $prenom=$data->prenom;
        $age=$data->age;
        $patient = new Patient($nom, $prenom, $age);

        $em->persist($patient);
        $em->flush();

        return $this->render('patient.json.twig', ['patient' => $patient]);
    }

    /**
     * Permet de creer une nouvelle analyse
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: "/analyse", methods: ['POST'])]
    public function routeCreationAnalyse(Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent());

        $nom=$data->nom;
        $val_inf=$data->val_inf;
        $val_sup=$data->val_sup;
        $analyse = new Analyse($nom, $val_inf, $val_sup);

        $em->persist($analyse);
        $em->flush();

        return $this->render('analyse.json.twig', ['analyse' => $analyse]);
    }

    /**
     * Permet de creer un nouveau echantillon
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: "/echantillon", methods: ['POST'])]
    public function routeCreationEchantillon(Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent());

        $type=$data->type;
        $ana=$data->analyse;
        $analyse = $em->getRepository(Analyse::class)->find($ana);
        $pat=$data->patient;
        $patient = $em->getRepository(Patient::class)->find($pat);
        $echantillon = new Echantillon($type, $patient, $analyse);

        $em->persist($echantillon);
        $em->flush();

        return $this->render('echantillon.json.twig', ['echantillon' => $echantillon]);
    }

    // MODIFICATION DES OBJETS //

    /**
     * Permet de modifier un patient
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/patient/{id}", methods: ['PUT'])]
    public function routeModifPatient(Request $request, EntityManagerInterface $em, int $id)
    {
        $data = json_decode($request->getContent());

        $patient = $em->getRepository(Patient::class)->find($id);

        $patient->nom = $data->nom;
        $patient->prenom = $data->prenom;
        $patient->age = $data->age;

        $em->flush();

        return $this->render('patient.json.twig', ['patient' => $patient]);
    }

    /**
     * Permet de modifier une analyse
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/analyse/{id}", methods: ['PUT'])]
    public function routeModifAnalyse(Request $request, EntityManagerInterface $em, int $id)
    {
        $data = json_decode($request->getContent());

        $analyse = $em->getRepository(Analyse::class)->find($id);

        $analyse->nom = $data->nom;
        $analyse->val_inf = $data->val_inf;
        $analyse->val_sup = $data->val_sup;

        $em->flush();

        return $this->render('analyse.json.twig', ['analyse' => $analyse]);
    }

    /**
     * Permet de modifier un echantillon
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/echantillon/{id}", methods: ['PUT'])]
    public function routeModifEchantillon(Request $request, EntityManagerInterface $em, int $id)
    {
        $data = json_decode($request->getContent());

        $echantillon = $em->getRepository(Echantillon::class)->find($id);

        $echantillon->type = $data->type;
        $pat = $data->patient;
        $echantillon->patient = $em->getRepository(Patient::class)->find($pat);
        $ana = $data->analyse;
        $echantillon->anlyse = $em->getRepository(Analyse::class)->find($ana);

        $em->flush();

        return $this->render('echantillon.json.twig', ['echantillon' => $echantillon]);
    }

    // SUPPRESSION DES OBJETS //

    /**
     * Permet de supprimer un patient
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/patient/{id}", methods: ['DELETE'])]
    public function routeSuppPatient(EntityManagerInterface $em, int $id)
    {
        $patient = $em->getRepository(Patient::class)->find($id);
        $em->remove($patient);
        $em->flush();
        return new Response('Suppression bien effectuée');
    }

    /**
     * Permet de supprimer une analyse
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/analyse/{id}", methods: ['DELETE'])]
    public function routeSuppAnalyse(EntityManagerInterface $em, int $id)
    {
        $analyse = $em->getRepository(Analyse::class)->find($id);
        $em->remove($analyse);
        $em->flush();
        return new Response('Suppression bien effectuée');
    }

    /**
     * Permet de supprimer un echantillon
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path: "/echantillon/{id}", methods: ['DELETE'])]
    public function routeSuppEchantillon(EntityManagerInterface $em, int $id)
    {
        $echantillon = $em->getRepository(Echantillon::class)->find($id);
        $em->remove($echantillon);
        $em->flush();
        return new Response('Suppression bien effectuée');
    }

}

