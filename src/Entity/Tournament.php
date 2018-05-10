<?php

namespace App\Entity;

use App\Entity\Club;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource; 
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 * @ApiResource
 * 
 * @ORM\Entity(repositoryClass="App\Repository\TournamentRepository")
 */
class Tournament
{
    const TYPE_INDOOR = 'indoor';
    const TYPE_OUTDOOR = 'outdoor';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="tournaments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $organizer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Peloton", mappedBy="tournament")
     */
    private $pelotons;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->startDate    = new \Datetime();
        $this->endDate      = new \Datetime();
        $this->type = 0;
        $this->pelotons = new ArrayCollection();
    }

    public static function getTypeList()
    {
        return [self::TYPE_INDOOR, self::TYPE_OUTDOOR];
    }    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return self::getTypeList()[$this->type]; 
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        if (!in_array($type, self::getTypeList())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->type = array_search($type, self::getTypeList());

        return $this;
    }

    /**
     * Get the value of organizer
     */ 
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Set the value of organizer
     *
     * @return  self
     */ 
    public function setOrganizer(Club $organizer)
    {
        $this->organizer = $organizer;

        return $this;
    }

    /**
     * @return Collection|Peloton[]
     */ 
    public function getPelotons()
    {
        return $this->pelotons;
    }

    /**
     * Set the value of pelotons
     *
     * @return  self
     */ 
    public function addPeloton(Peloton $peloton)
    {
        $this->pelotons[] = $peloton;

        return $this;
    }

    /**
     * Remove the value of pelotons
     *
     * @return  self
     */ 
    public function removePeloton(Peloton $peloton)
    {
        $this->pelotons->removeElement($peloton);
    }
}
