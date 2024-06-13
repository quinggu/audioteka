<?php

namespace App\Entity;

use App\Service\Catalog\Product;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'cart_products')]
#[ORM\Entity]
class CartProducts implements \App\Service\CartProducts\CartProducts
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Cart::class, cascade: [], fetch: 'EXTRA_LAZY', inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'cart_id', referencedColumnName: 'id')]
    private Cart $cart;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Product::class, cascade: [], fetch: 'EXTRA_LAZY', inversedBy: 'ordered')]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product $product;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 1])]
    private int $productCounter;

    public function __construct()
    {
        $this->productCounter = 1;
    }

    public function getProductCounter(): int
    {
        return $this->productCounter;
    }

    public function setProductCounter(int $productCounter): CartProducts
    {
        $this->productCounter = $productCounter;

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

}
