<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;


/**
 * Class Patient
 * @package App\Entity
 *
 * @Entity
 * @ORM\Table(name="patient")
 */
class Patient
{
    /**
     * @var Int
     * @ORM\Column(name="ID_patient", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    public int $id;

    /**
     * @var string
     * @ORM\Column(name="Nom", type="string")
     */
    public string $nom;

    /**
     * @var string
     * @ORM\Column(name="Prenom", type="string")
     */
    public string $prenom;

    /**
     * @var Int
     * @ORM\Column(name="Age", type="integer")
     */
    public int $age;



    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Echantillon::class, mappedBy="patient", fetch="EAGER")
     */
    public Collection $listeEchantillonsP;

    /**
     * Patient constructor.
     * @param string $nom
     * @param string $prenom
     * @param int $age
     * @param Echantillon|null $listeEchantillonsP
     */
    public function __construct(string $nom, string $prenom, int $age, ?Echantillon $listeEchantillonsP = null)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->listeEchantillonsP = new ArrayCollection();
    }


}