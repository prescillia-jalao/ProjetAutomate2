<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Analyse
 * @package App\Entity
 *
 * @Entity
 * @ORM\Table(name="analyse")
 */
class Analyse
{

    /**
     * @var Int
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    public int $id;

    /**
     * @var string
     * @ORM\Column(name="Nom", type="text")
     */
    public string $nom;


    /**
     * @var float
     * @ORM\Column(name="Val_inf", type="float")
     */
    public float $val_inf;


    /**
     * @var float
     * @ORM\Column(name="Val_sup", type="float")
     */
    public float $val_sup;


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Echantillon::class, mappedBy="analyse", fetch="EAGER")
     */
    private Collection $listeEchantillonsA;


    /**
     * Constructor de l'analyse
     * @param string $nom
     * @param float $val_inf
     * @param float $val_sup
     */
    public function __construct(string $nom, float $val_inf, float $val_sup)
    {
        $this->nom = $nom;
        $this->val_inf = $val_inf;
        $this->val_sup = $val_sup;
        $this->listeEchantillonsA = new ArrayCollection();
    }



}