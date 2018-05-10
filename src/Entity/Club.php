<?php

namespace App\Entity;


use App\Entity\Region;
use App\Entity\Affiliate;
use App\Entity\Tournament;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource; 
use Doctrine\Common\Collections\ArrayCollection;

/**
 * An Club
 * 
 * @ApiResource
 * 
 * @ORM\Entity(repositoryClass="App\Repository\ClubRepository")
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $acronym;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="clubs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affiliate", mappedBy="club")
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tournament", mappedBy="organizer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tournaments;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->tournaments = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of acronym
     */ 
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Set the value of acronym
     *
     * @return  self
     */ 
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of region
     */ 
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     *
     * @return  self
     */ 
    public function setRegion(Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     *  @return Collection|Affiliate[]
     */ 
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add the value of members
     *
     * @return  self
     */ 
    public function addMember(Affiliate $member)
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * Remove the value of members
     *
     * @return  self
     */ 
    public function removeMember(Affiliate $member)
    {
        $this->members->removeElement($member);
    }


    /**
     * @return Collection|Tournament[]
     */ 
    public function getTournaments()
    {
        return $this->tournaments;
    }

    /**
     * Add the value of tournaments
     *
     * @return  self
     */ 
    public function addTournament(Tournament $tournament)
    {
        $this->tournaments[] = $tournament;

        return $this;
    }

    /**
     * Remove the value of tournaments
     *
     * @return  self
     */ 
    public function removeTournament(Tournament $tournament)
    {
        $this->tournaments->removeElement($tournament);
    }
}
