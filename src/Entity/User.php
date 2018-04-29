<?php

namespace App\Entity;

use App\Entity\Affiliate;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;


/**
 *  An User
 *  @ApiResource
 * 
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * 
 * @author Valdior <marechal.pierre@live.be>
 */
class User implements AdvancedUserInterface, \Serializable
{
    const SEXE_M = "Homme";
    const SEXE_W = "Femme";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isExpired;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLocked;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCredentialsExpired;

     /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $apikey;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isArcher;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affiliate", mappedBy="archer")
     */
    private $affiliations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="archer")
     */
    private $competitions;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $sexe;


    public function __construct()
    {
        $this->isArcher = false;
        $this->isActive = true;
        $this->isExpired = false;
        $this->isLocked = false;
        $this->isCredentialsExpired = false;
        $this->affiliations = new ArrayCollection();
        $this->sexe = 0;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public static function getSexeList(): array
    {
        return array(self::SEXE_M, self::SEXE_W);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        // See "Do you need to use a Salt?" at https://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return null;
    }

    /**
     * Returns the roles or permissions granted to the user for security.
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    /**
     * Add role
     */ 
    public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }

    /**
     * Remove role
     */ 
    public function removeRole(string $role)
    {
        $this->roles->removeElement($role);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * Removes sensitive data from the user.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * {@inheritdoc}
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Get the value of plainPassword
     */ 
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return  self
     */ 
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get the value of isActive
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */ 
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the below length depends on the "algorithm" you use for encoding
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the below length depends on the "algorithm" you use for encoding
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of isExpired
     */ 
    public function getIsExpired()
    {
        return $this->isExpired;
    }

    /**
     * Set the value of isExpired
     *
     * @return  self
     */ 
    public function setIsExpired($isExpired)
    {
        $this->isExpired = $isExpired;

        return $this;
    }

    /**
     * Get the value of isLocked
     */ 
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set the value of isLocked
     *
     * @return  self
     */ 
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get the value of isCredentialsExpired
     */ 
    public function getIsCredentialsExpired()
    {
        return $this->isCredentialsExpired;
    }

    /**
     * Set the value of isCredentialsExpired
     *
     * @return  self
     */ 
    public function setIsCredentialsExpired($isCredentialsExpired)
    {
        $this->isCredentialsExpired = $isCredentialsExpired;

        return $this;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function isAccountNonExpired()
    {
        return !$this->isExpired;
    }

    public function isAccountNonLocked()
    {
        return !$this->isLocked;
    }

    public function isCredentialsNonExpired()
    {
        return !$this->isCredentialsExpired;
    }

    public function isNonArcher()
    {
        return !$this->isArcher;
    }

    /**
     * Get the value of apikey
     */ 
    public function getApikey()
    {
        return $this->apikey;
    }

    /**
     * Set the value of apikey
     *
     * @return  self
     */ 
    public function setApikey($apikey)
    {
        $this->apikey = $apikey;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of affiliations
     */ 
    public function getAffiliations()
    {
        return $this->affiliations;
    }

    /**
     * Set the value of affiliations
     *
     * @return  self
     */ 
    public function addAffiliation(Affiliate $affiliation)
    {
        $this->affiliations[] = $affiliation;

        return $this;
    }

    /**
     * Remove the value of affiliations
     *
     * @return  self
     */ 
    public function removeAffiliation(Affiliate $affiliation)
    {
        $this->affiliations->removeElement($affiliation);
    }

    /**
     * Get the value of isArcher
     */ 
    public function getIsArcher()
    {
        return $this->isArcher;
    }

    /**
     * Set the value of isArcher
     *
     * @return  self
     */ 
    public function setIsArcher($isArcher)
    {
        $this->isArcher = $isArcher;

        return $this;
    }

    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Get the value of sexe
     */ 
    public function getSexe()
    {
        return self::getSexeList()[$this->sexe];
    }

    /**
     * Set the value of sexe
     *
     * @return  self
     */ 
    public function setSexe($sexe)
    {
        if (!in_array($sexe, self::getSexeList())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->sexe = array_search($sexe, self::getSexeList());

        return $this;
    }
}
