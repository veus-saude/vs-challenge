<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")  
 * @Table(name="products")
 * @JMS\ExclusionPolicy("all")
 */
class Product
{
    /**
     * @ORM\Id()
     * @JMS\Expose()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @JMS\Expose()
     * @JMS\Since("1.1")
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(payload={"error_code"="INVALID_NAME"})
     * @Assert\Length(
     *          min=3,
     *          max=80,
     *          minMessage = "The property NAME must be at least {{ limit }} characters long",
     *          maxMessage = "The property NAME cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @JMS\Expose()
     * @JMS\Until("1.1")
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(payload={"error_code"="INVALID_NAME"})
     * @Assert\Length(
     *          min=3, 
     *          max=80,
     *          minMessage = "The property BRAND must be at least {{ limit }} characters long",
     *          maxMessage = "The property BRAND cannot be longer than {{ limit }} characters"
     * )
     */
    private $brand;

    /**
     * @JMS\Expose()
     * @JMS\Since("1.1")
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @JMS\Expose()
     * @JMS\Since("1.1")
     * @ORM\Column(type="integer")
     */
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
