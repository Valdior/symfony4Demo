<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * 
 * @author Valdior <marechal.pierre@live.be>
 */
class User implements AdvancedUserInterface, \Serializable
{
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

    public function __construct()
    {
        $this->isActive = true;
        $this->isExpired = false;
        $this->isLocked = false;
        $this->isCredentialsExpired = false;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
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
}
