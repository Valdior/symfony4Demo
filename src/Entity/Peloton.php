<?php

namespace App\Entity;

use App\Entity\Tournament;
use App\Entity\Participant;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PelotonRepository")
 */
class Peloton
{
    const TYPE_18 = '18 m';
    const TYPE_25 = '25 m';
    const TYPE_50_30 = '50/30';
    const TYPE_50 = '50 m';
    const TYPE_70 = '70 m';
    const TYPE_1440 = '1440';

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
    private $maxParticipants;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @ORM\Column(type="time")
     */
    private $startTime;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="peloton")
     */
    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tournament", inversedBy="pelotons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tournament;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->startTime        = new \Datetime();
        $this->participants     = new ArrayCollection();
        $this->type             = 0;
    }

    public static function getTypeList()
    {
        return array(self::TYPE_18, self::TYPE_25, self::TYPE_50_30, self::TYPE_50, self::TYPE_70, self::TYPE_1440);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of maxParticipants
     */ 
    public function getMaxParticipants()
    {
        return $this->maxParticipants;
    }

    /**
     * Set the value of maxParticipants
     *
     * @return  self
     */ 
    public function setMaxParticipants($maxParticipants)
    {
        $this->maxParticipants = $maxParticipants;

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
     * Set type
     */ 
    public function setType(string $type): void
    {
        if (!in_array($type, self::getTypeList())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->type = array_search($type, self::getTypeList());
    }

    /**
     * Get the value of startTime
     */ 
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set the value of startTime
     *
     * @return  self
     */ 
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     *  @return Collection|Participant[]
     */ 
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set the value of participants
     *
     * @return  self
     */ 
    public function addParticipant(Participant $participant): void
    {
        $this->participants[] = $participant;
    }

     /**
     * Remove the value of participants
     *
     * @return  self
     */ 
    public function removeParticipant(Participant $participant): void
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get the value of tournament
     */ 
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set the value of tournament
     *
     * @return  self
     */ 
    public function setTournament(Tournament $tournament)
    {
        $this->tournament = $tournament;

        if($this->getStartDate() != null)
        {
            $this->setStartDate($this->tournament->getStartDate());
        }

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}
