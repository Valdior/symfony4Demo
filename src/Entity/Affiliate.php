<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource; 

/**
 * 
 * @ApiResource
 * 
 * @ORM\Entity(repositoryClass="App\Repository\AffiliateRepository")
 */
class Affiliate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="registrationNumber", type="string", length=10)
     */
    private $registrationNumber;

    /**
     * @ORM\Column(name="affiliatedSince", type="date")
     */
    private $affiliatedSince;

    /** 
     * @ORM\Column(name="affiliateEnd", type="date", nullable=true)
     */
    private $affiliateEnd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="affiliations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $archer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get /*
     */ 
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Set /*
     *
     * @return  self
     */ 
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * Get /*
     */ 
    public function getAffiliatedSince()
    {
        return $this->affiliatedSince;
    }

    /**
     * Set /*
     *
     * @return  self
     */ 
    public function setAffiliatedSince($affiliatedSince)
    {
        $this->affiliatedSince = $affiliatedSince;

        return $this;
    }

    /**
     * Get /*
     */ 
    public function getAffiliateEnd()
    {
        return $this->affiliateEnd;
    }

    /**
     * Set /*
     *
     * @return  self
     */ 
    public function setAffiliateEnd($affiliateEnd)
    {
        $this->affiliateEnd = $affiliateEnd;

        return $this;
    }

    /**
     * Get the value of archer
     */ 
    public function getArcher()
    {
        return $this->archer;
    }

    /**
     * Set the value of archer
     *
     * @return  self
     */ 
    public function setArcher($archer)
    {
        $this->archer = $archer;

        return $this;
    }

    /**
     * Get the value of club
     */ 
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set the value of club
     *
     * @return  self
     */ 
    public function setClub($club)
    {
        $this->club = $club;

        return $this;
    }
}
