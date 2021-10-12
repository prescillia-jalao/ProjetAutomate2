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
    private string $nom;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @var Int
     * @ORM\Column(name="Val_inf", type="integer")
     */
    private int $val_inf;


    /**
     * @return Int
     */
    public function getValInf(): int
    {
        return $this->val_inf;
    }

    /**
     * @param Int $val_inf
     */
    public function setValInf(int $val_inf): void
    {
        $this->val_inf = $val_inf;
    }

    /**
     * @var Int
     * @ORM\Column(name="Val_sup", type="integer")
     */
    private int $val_sup;

    /**
     * @return Int
     */
    public function getValSup(): int
    {
        return $this->val_sup;
    }

    /**
     * @param Int $val_sup
     */
    public function setValSup(int $val_sup): void
    {
        $this->val_sup = $val_sup;
    }


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Echantillon::class, mappedBy="analyse", fetch="EAGER")
     */
    private Collection $listeEchantillonsA;

    /**
     * @return Collection
     */
    public function getListeEchantillonsA(): Collection
    {
        return $this->listeEchantillonsA;
    }

    /**
     * @param Collection $listeEchantillonsA
     */
    public function setListeEchantillonsA(Collection $listeEchantillonsA): void
    {
        $this->listeEchantillonsA = $listeEchantillonsA;
    }

    /**
     * Constructor de l'analyse
     * @param string $nom
     * @param int $val_inf
     * @param int $val_sup
     * @param Echantillon|null $listeEchantillonA
     */
    public function __construct(string $nom, int $val_inf, int $val_sup, ?Echantillon $listeEchantillonA = null)
    {
        $this->nom = $nom;
        $this->val_inf = $val_inf;
        $this->val_sup = $val_sup;
        $this->listeEchantillonsA = new ArrayCollection();
    }



}