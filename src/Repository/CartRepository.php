<?php

namespace App\Repository;

use App\Entity\CartProducts;
use App\Entity\Product;
use App\Service\Cart\Cart;
use App\Service\Cart\CartService;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Ramsey\Uuid\Uuid;

class CartRepository implements CartService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function addProduct(string $cartId, string $productId): void
    {
        $this->entityManager->beginTransaction();
        try {
            $cart = $this->entityManager->find(\App\Entity\Cart::class, $cartId, LockMode::PESSIMISTIC_WRITE);
            $product = $this->entityManager->find(Product::class, $productId);

            if ($cart && $product) {
                if ($cart->hasProduct($product)) {
                    $cartProduct = $this->entityManager->getRepository(CartProducts::class)->findOneBy(['product' => $product]);
                    $cartProduct->setProductCounter($cartProduct->getProductCounter() + 1);
                } else {
                    $cart->addProduct($product);
                }

                $this->entityManager->persist($cart);
                $this->entityManager->flush();
            }

            $this->entityManager->commit();
        } catch (Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }

    public function removeProduct(string $cartId, string $productId): void
    {
        $cart = $this->entityManager->find(\App\Entity\Cart::class, $cartId);
        $product = $this->entityManager->find(Product::class, $productId);

        if ($cart && $product && $cart->hasProduct($product)) {
            $cartProduct = $this->entityManager->getRepository(CartProducts::class)->findOneBy(['product' => $product]);
            if ($cartProduct->getProductCounter() > 1) {
                $cartProduct->setProductCounter($cartProduct->getProductCounter() - 1);
            } else {
                $cart->removeProduct($product);
            }

            $this->entityManager->persist($cart);
            $this->entityManager->flush();
        }
    }

    public function create(): Cart
    {
        $cart = new \App\Entity\Cart(Uuid::uuid4()->toString());

        $this->entityManager->persist($cart);
        $this->entityManager->flush();

        return $cart;
    }
}