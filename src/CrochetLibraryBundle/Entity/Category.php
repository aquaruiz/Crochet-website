<?php

namespace CrochetLibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="CrochetLibraryBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="parent", type="integer", nullable=true)
     */
    private $parent;

    /**
     * @var Pattern[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="CrochetLibraryBundle\Entity\Pattern", mappedBy="categories", cascade={"remove"})
     */
    private $patterns;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->patterns = new ArrayCollection();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parent.
     *
     * @param int|null $parent
     *
     * @return Category
     */
    public function setParent($parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return int|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return Pattern[]|ArrayCollection
     */
    public function getPatterns()
    {
        return $this->patterns;
    }

    /**
     * @param Pattern $product
     */
    public function addProduct($product)
    {
        $this->patterns[] = $product;
    }
}