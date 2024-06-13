<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
class Product implements \App\Service\Catalog\Product
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', nullable: false)]
    private UuidInterface $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'integer', nullable: false)]
    private string $priceAmount;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: CartProducts::class)]
    private Collection $cart;

    public function __construct(string $id, string $name, int $price, ?DateTime $createdAt = null)
    {
        $this->id = Uuid::fromString($id);
        $this->name = $name;
        $this->priceAmount = $price;
        $this->createdAt = $createdAt ?? new DateTime();
    }

    public function getId(): string
    {
        return $this->id->toString();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->priceAmount;
    }

    public function setPrice(string $priceAmount): Product
    {
        $this->priceAmount = $priceAmount;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
