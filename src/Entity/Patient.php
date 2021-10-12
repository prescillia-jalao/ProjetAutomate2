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
     * @var Hopital|null
     *
     * @ORM\ManyToOne(targetEntity=Hopital::class, fetch="EAGER")
     * @ORM\JoinColumn(name="Hopital_id", referencedColumnName="ID_hopital")
     */
    public ?Hopital $hopital;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Analyse::class, mappedBy="patient", fetch="EAGER")
     */
    public Collection $listeAnalyses;

    /**
     * Patient constructor.
     * @param string $nom
     * @param string $prenom
     * @param int $age
     * @param Hopital|null $hopital
     */
    public function __construct(string $nom, string $prenom, int $age, ?Hopital $hopital = null)
    {
        $this->hopital = $hopital;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->listeAnalyses = new ArrayCollection();
    }


}