<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;


/**
 * Class Hopital
 * @package App\Entity
 * @Entity
 * @ORM\Table(name="hopital")
 */
class Hopital
{

    /**
     * @var Int
     * @ORM\Column(name="ID_hopital", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    public Int $id;

    public function getId()
    {
        return $this->id;
    }


    public function setId(Int $id)
    {
        $this->id = $id;
    }

    /**
     * @var string
     * @ORM\Column(name="Nom_hopital", type="string")
     */
    public string $nom_hopital;


    /**
    * @var Collection
     * @ORM\OneToMany(targetEntity=Patient::class, mappedBy="hopital", fetch="EAGER")
     */
    public Collection $listePatients;

    /**
    * @param string $nom_hopital
    *
    */
    public function __construct(string $nom_hopital){
    $this->nom_hopital = $nom_hopital;
    $this->listePatients = new ArrayCollection();
}

}