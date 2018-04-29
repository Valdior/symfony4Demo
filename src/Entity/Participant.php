<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Peloton;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource; 
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 * @ApiResource()
 * 
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    const CAT_Pupille   = 'Pupille';
    const CAT_Benjamin  = 'Benjamin';
    const CAT_Cadet     = 'Cadet';
    const CAT_Junior    = 'Junior';
    const CAT_Adulte1   = 'Adulte 1';
    const CAT_Adulte2   = 'Adulte 2';
    const CAT_Master    = 'Master';
    const CAT_Veterant  = 'Veterant';

    const ARC_RECURVE   = "Recurve";
    const ARC_COMPOUND  = "Compound";
    const ARC_LONGBOW   = "Longbow";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $arc;

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
        $this->category = 0;
        $this->arc = 0;
    }

    public static function getCategoryList()
    {
        return array(self::CAT_Pupille, self::CAT_Benjamin, self::CAT_Cadet, self::CAT_Junior, self::CAT_Adulte1, self::CAT_Adulte2, self::CAT_Master, self::CAT_Veterant);
    }

    public static function getArcList()
    {
        return array(self::ARC_LONGBOW, self::ARC_RECURVE, self::ARC_COMPOUND);
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


    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return self::getCategoryList()[$this->category];
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {

        if (!in_array($category, self::getCategoryList())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->category = array_search($category, self::getCategoryList());

        return $this;
    }

    /**
     * Get the value of arc
     */ 
    public function getArc()
    {
        return self::getArcList()[$this->arc];
    }

    /**
     * Set the value of arc
     *
     * @return  self
     */ 
    public function setArc($arc)
    {
        if (!in_array($arc, self::getArcList())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->arc = array_search($arc, self::getArcList());

        return $this;
    }
}
