<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @ORM\Table(name="person")
 *
 * @Vich\Uploadable
 */
class Person
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="post_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="Person", inversedBy="children", cascade={"all"})
     * @ORM\JoinTable(name="parent",
     *      joinColumns={@ORM\JoinColumn(name="child_person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent_person_id", referencedColumnName="id")}
     * )
     * @var ArrayCollection
     */
    private $parents;

    /**
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="parents", cascade={"all"})
     * @var ArrayCollection
     */
    private $children;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->parents  = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param File|null $image
     */
    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param null|string $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return null|string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return Collection
     */
    public function getParents(): Collection
    {
        return $this->parents;
    }


    /**
     * @param Person[] ...$parents
     */
    public function addParent(Person ...$parents): void
    {
        foreach ($parents as $parent) {
            if (!$this->parents->contains($parent)) {
                $parent->addChild($this);
                $this->parents->add($parent);
            }
        }
    }

    ///**
    // * @param Person $parent
    // */
    //public function removeParent(Person $parent): void
    //{
    //    $this->parents->removeElement($parent);
    //}


    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }


    /**
     * @param Person[] ...$children
     */
    public function addChild(Person ...$children): void
    {
        foreach ($children as $child) {
            if (!$this->children->contains($child)) {
                $child->addParent($this);
                $this->children->add($child);
            }
        }
    }

    ///**
    // * @param Person $child
    // */
    //public function removeChild(Person $child): void
    //{
    //    $this->children->removeElement($child);
    //}

    public function __toString()
    {
        return $this->name;
    }

    ///**
    // * @param ArrayCollection $parents
    // */
    //public function setParents(ArrayCollection $parents): void
    //{
    //    $this->parents = $parents;
    //}
}
