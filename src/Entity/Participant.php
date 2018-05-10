<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Peloton;
use App\Entity\ArcherCategory;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiResource; 
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 * @ApiResource()
 * 
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Participant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArcherCategory", inversedBy="participantsCategory")
     * @ORM\JoinColumn(nullable=false)
     */
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
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \DateTime $contentChanged
     *
     * @ORM\Column(name="content_changed", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"category", "arc", "points", "isForfeited"})
     */
    private $contentChanged;

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


    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category; //self::getCategoryList()[$this->category];
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory(ArcherCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Get $created
     *
     * @return  \DateTime
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get $updated
     *
     * @return  \DateTime
     */ 
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Get $contentChanged
     *
     * @return  \DateTime
     */ 
    public function getContentChanged()
    {
        return $this->contentChanged;
    }

    /**
     * @ORM\PrePersist
     */
    public function createdDate()
    {
        $this->created = new \Datetime();
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function setContentChanged(?\DateTimeInterface $contentChanged): self
    {
        $this->contentChanged = $contentChanged;

        return $this;
    }
}
