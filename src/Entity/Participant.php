<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Peloton;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource; 
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 * 
 * @ApiResource()
 * 
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    private $category;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $points;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $numberOfX;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $numberOfTen;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $numberOfNine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isForfeited;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Peloton", inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $peloton;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $archer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPoints(0);
        $this->setNumberOfX(0);
        $this->setNumberOfTen(0);
        $this->setNumberOfNine(0);
        $this->setIsForfeited(false);
    }

    /**
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints(int $points)
    {
        $this->points = $points;
        return $this;
    }

    public function getNumberOfX()
    {
        return $this->numberOfX;
    }

    public function setNumberOfX(int $numberOfX)
    {
        $this->numberOfX = $numberOfX;
        return $this;
    }

    public function getNumberOfTen()
    {
        return $this->numberOfTen;
    }

    public function setNumberOfTen(int $numberOfTen)
    {
        $this->numberOfTen = $numberOfTen;
        return $this;
    }

    public function getNumberOfNine()
    {
        return $this->numberOfNine;
    }

    public function setNumberOfNine(int $numberOfNine)
    {
        $this->numberOfNine = $numberOfNine;
        return $this;
    }

    public function getIsForfeited()
    {
        return $this->isForfeited;
    }

    public function setIsForfeited(bool $isForfeited)
    {
        $this->isForfeited = $isForfeited;
        return $this;
    }

    public function getPeloton()
    {
        return $this->peloton;
    }

    public function setPeloton(Peloton $peloton)
    {
        $this->peloton = $peloton;
        return $this;
    }

    public function getArcher()
    {
        return $this->archer;
    }

    public function setArcher(User $archer)
    {
        $this->archer = $archer;
        return $this;
    }

}
