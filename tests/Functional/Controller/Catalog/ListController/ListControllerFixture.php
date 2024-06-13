<?php

namespace App\Tests\Functional\Controller\Catalog\ListController;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class ListControllerFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            new Product('fbcb8c51-5dcc-4fd4-a4cd-ceb9b400bff7', 'Product 1', 1990, new DateTime('2024-06-09 07:27:21')),
            new Product('9670ea5b-d940-4593-a2ac-4589be784203', 'Product 2', 3990, new DateTime('2024-06-09 08:36:22')),
            new Product('15e4a636-ef98-445b-86df-46e1cc0e10b5', 'Product 3', 4990, new DateTime('2024-06-09 09:40:23')),
            new Product('00e91390-3af8-4735-bd06-0311e7131757', 'Product 4', 5990, new DateTime('2024-06-10 06:26:24')),
            new Product('0a5d83f1-8c7e-4253-b020-156439f3d3c9', 'Product 5', 6990, new DateTime('2024-06-10 07:45:24')),
            new Product('e41ac303-11ab-446e-a253-28572278fdbe', 'Product 6', 7990, new DateTime('2024-06-10 08:45:24')),
            new Product('b7747f7b-ae35-4225-af9a-6ecc803ebf0f', 'Product 7', 8990, new DateTime('2024-06-10 08:48:24'))
        ];

        foreach ($products as $product) {
            $manager->persist($product);
        }

        $manager->flush();
    }
}