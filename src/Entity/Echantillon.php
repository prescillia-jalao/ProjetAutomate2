<?php


namespace App\Entity;


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
    public int $id;


    /**
     * @var string
     * @ORM\Column(name="Type", type="string")
     */
    public string $type;


    /**
    * @var Patient|null
     * @ORM\ManyToOne(targetEntity=Patient::class)
     * @ORM\JoinColumn(name="FK_patient", referencedColumnName="ID_patient")
     */
    public ?Patient $patient;


    /**
     * @var Analyse|null
     * @ORM\ManyToOne(targetEntity=Analyse::class)
     * @ORM\JoinColumn(name="FK_ana", referencedColumnName="ID")
     */
    public ?Analyse $analyse;


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