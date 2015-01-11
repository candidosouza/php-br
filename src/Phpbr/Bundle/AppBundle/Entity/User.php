<?php

namespace Phpbr\Bundle\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $facebook_id;

    /**
     * @var string
     */
    protected $facebook_access_token;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $artigos;


    public function __construct() {
        $this->artigos = new ArrayCollection();

        parent::__construct();
    }

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
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Add artigos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Artigo $artigos
     * @return User
     */
    public function addArtigo(\Phpbr\Bundle\AppBundle\Entity\Artigo $artigos)
    {
        $this->artigos[] = $artigos;

        return $this;
    }

    /**
     * Remove artigos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Artigo $artigos
     */
    public function removeArtigo(\Phpbr\Bundle\AppBundle\Entity\Artigo $artigos)
    {
        $this->artigos->removeElement($artigos);
    }

    /**
     * Get artigos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtigos()
    {
        return $this->artigos;
    }
}