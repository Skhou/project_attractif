<?php

namespace Ip\AttractifBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ip\AttractifBundle\Repository\RequestRepository")
 */
class Request
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
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var \Ip\AttractifBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Ip\AttractifBundle\Entity\User", inversedBy="requests")
     */
    private $user;

    /**
     * @var \Ip\AttractifBundle\Entity\Event
     * @ORM\ManyToOne(targetEntity="Ip\AttractifBundle\Entity\Event", inversedBy="requests")
     */
    private $event;

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
     * Set status
     *
     * @param string $status
     * @return Request
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \Ip\AttractifBundle\Entity\User $user
     * @return Request
     */
    public function setUser(\Ip\AttractifBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ip\AttractifBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param \Ip\AttractifBundle\Entity\User $event
     * @return Request
     */
    public function setEvent(\Ip\AttractifBundle\Entity\User $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Ip\AttractifBundle\Entity\User 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
