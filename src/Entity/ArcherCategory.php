<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArcherCategoryRepository")
 */
class ArcherCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $fullname;

    /**
     * @ORM\Column(type="integer")
     */
    private $minimumAge; 
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="category")
     */
    private $participantsCategory;

    public function __construct()
    {
        $this->participantsCategory = new ArrayCollection();
    }  

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
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of fullname
     */ 
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set the value of fullname
     *
     * @return  self
     */ 
    public function setFullname(string $fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get the value of minimumAge
     */ 
    public function getMinimumAge()
    {
        return $this->minimumAge;
    }

    /**
     * Set the value of minimumAge
     *
     * @return  self
     */ 
    public function setMinimumAge(int $minimumAge)
    {
        $this->minimumAge = $minimumAge;

        return $this;
    }

    /**
     * Get the value of participantsCategory
     */ 
    public function getParticipantsCategory()
    {
        return $this->participantsCategory;
    }

    /**
     * Set the value of participantsCategory
     *
     * @return  self
     */ 
    public function setParticipantsCategory($participantsCategory)
    {
        $this->participantsCategory = $participantsCategory;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function addParticipantsCategory(Participant $participantsCategory): self
    {
        if (!$this->participantsCategory->contains($participantsCategory)) {
            $this->participantsCategory[] = $participantsCategory;
            $participantsCategory->setCategory($this);
        }

        return $this;
    }

    public function removeParticipantsCategory(Participant $participantsCategory): self
    {
        if ($this->participantsCategory->contains($participantsCategory)) {
            $this->participantsCategory->removeElement($participantsCategory);
            // set the owning side to null (unless already changed)
            if ($participantsCategory->getCategory() === $this) {
                $participantsCategory->setCategory(null);
            }
        }

        return $this;
    }
}
