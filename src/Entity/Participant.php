<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
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
     * @ORM\OneToMany(targetEntity="App\Entity\Peloton", mappedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $archer;
}
