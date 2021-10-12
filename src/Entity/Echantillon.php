<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;


/**
 * Class Echantillon
 * @package App\Entity
 * @Entity
 * @ORM\Table(name="echantillon")
 */
class Echantillon
{

    /**
     * @var Int
     * @ORM\Column(name="ID_echantillon", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private Int $id;

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @var string
     * @ORM\Column(name="Type", type="string")
     */
    private string $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
    * @var Patient|null
     * @ORM\ManyToOne(targetEntity=Patient::class)
     * @ORM\JoinColumn(name=FK_patient, referencedColumnName="ID_patient")
     */
    private ?Patient $patient;

    /**
     * @return Patient|null
     */
    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    /**
     * @param Patient|null $patient
     */
    public function setPatient(?Patient $patient): void
    {
        $this->patient = $patient;
    }

    /**
     * @var Analyse|null
     * @ORM\ManyToOne(targetEntity=Analyse::class)
     * @ORM\JoinColumn(name=FK_ana, referencedColumnName="ID")
     */
    private ?Analyse $analyse;

    /**
     * @return Analyse|null
     */
    public function getAnalyse(): ?Analyse
    {
        return $this->analyse;
    }

    /**
     * @param Analyse|null $analyse
     */
    public function setAnalyse(?Analyse $analyse): void
    {
        $this->analyse = $analyse;
    }

    /**
    * @param string $type
    * @param Patient|null $patient
    * @param Analyse|null $analyse
    *
    */
    public function __construct(string $type, ?Patient $patient=null, ?Analyse $analyse=null){
    $this->type = $type;
    $this->patient = $patient;
    $this->analyse = $analyse;
    }


}