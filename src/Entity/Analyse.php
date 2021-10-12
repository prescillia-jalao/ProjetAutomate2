<?php


namespace App\Entity;


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
     * @var Int
     * @ORM\Column(name="Plaquettes", type="integer")
     */
    public int $plaquettes;

    /**
     * @var Int
     * @ORM\Column(name="Cholesterol", type="integer")
     */
    public int $cholesterol;

    /**
     * @var Int
     * @ORM\Column(name="Glucose", type="integer")
     */
    public int $glucose;

    /**
     * @var Patient|null
     *
     * @ORM\ManyToOne(targetEntity=Patient::class, fetch="EAGER")
     * @ORM\JoinColumn(name="Patient_id", referencedColumnName="ID_patient")
     */
    public ?Patient $patient;

    /**
     * Constructor de l'analyse
     * @param int $plaquettes
     * @param int $cholesterol
     * @param int $glucose
     * @param Patient|null $patient
     */
    public function __construct(int $plaquettes, int $cholesterol, int $glucose, ?Patient $patient = null)
    {
        $this->plaquettes = $plaquettes;
        $this->cholesterol = $cholesterol;
        $this->glucose = $glucose;
        $this->patient = $patient;
    }
}