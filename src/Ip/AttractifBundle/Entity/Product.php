<?php

namespace Ip\AttractifBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Ip\AttractifBundle\Repository\ProductRepository")
 */
class Product extends EntityWithFileUpload
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Ip\AttractifBundle\Entity\Purchase", mappedBy="product")
     */
    private $users;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Ip\AttractifBundle\Entity\User", inversedBy="favorites")
     */
    private $usersFavorites;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Ip\AttractifBundle\Entity\Event", mappedBy="products")
     */
    private $events;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="Ip\AttractifBundle\Entity\Category", inversedBy="products")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ref
     *
     * @param string $ref
     * @return Product
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }


    /**
     * Set category
     *
     * @param \Ip\AttractifBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Ip\AttractifBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Ip\AttractifBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usersFavorites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \Ip\AttractifBundle\Entity\Purchase $users
     * @return Product
     */
    public function addUser(\Ip\AttractifBundle\Entity\Purchase $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Ip\AttractifBundle\Entity\Purchase $users
     */
    public function removeUser(\Ip\AttractifBundle\Entity\Purchase $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add usersFavorites
     *
     * @param \Ip\AttractifBundle\Entity\User $usersFavorites
     * @return Product
     */
    public function addUsersFavorite(\Ip\AttractifBundle\Entity\User $usersFavorites)
    {
        $this->usersFavorites[] = $usersFavorites;

        return $this;
    }

    /**
     * Remove usersFavorites
     *
     * @param \Ip\AttractifBundle\Entity\User $usersFavorites
     */
    public function removeUsersFavorite(\Ip\AttractifBundle\Entity\User $usersFavorites)
    {
        $this->usersFavorites->removeElement($usersFavorites);
    }

    /**
     * Get usersFavorites
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsersFavorites()
    {
        return $this->usersFavorites;
    }

    /**
     * Add events
     *
     * @param \Ip\AttractifBundle\Entity\Event $events
     * @return Product
     */
    public function addEvent(\Ip\AttractifBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Ip\AttractifBundle\Entity\Event $events
     */
    public function removeEvent(\Ip\AttractifBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
