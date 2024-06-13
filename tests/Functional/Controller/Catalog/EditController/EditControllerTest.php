<?php

namespace App\Tests\Functional\Controller\Catalog\RemoveController;

use App\Tests\Functional\WebTestCase;

class EditControllerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadFixtures(new EditControllerFixture());
    }

    public function test_edit_product(): void
    {
        $this->client->request('PUT', '/products/' . EditControllerFixture::PRODUCT_ID, [
            'name' => 'Product after edit',
            'price' => 1992,
        ]);

        self::assertResponseStatusCodeSame(202);

        $this->client->request('GET', '/products');
        self::assertResponseStatusCodeSame(200);

        $response = $this->getJsonResponse();
        self::assertCount(1, $response['products']);
        self::assertequals('Product after edit', $response['products'][0]['name']);
        self::assertequals(1992, $response['products'][0]['price']);
    }

    public function test_product_with_empty_name_and_price_cannot_be_edited(): void
    {
        $this->client->request('PUT', '/products/' . EditControllerFixture::PRODUCT_ID, [
            'name' => '    ',
            'price' => 0,
        ]);

        self::assertResponseStatusCodeSame(422);

        $response = $this->getJsonResponse();
        self::assertequals('Invalid name or price.', $response['error_message']);
    }
}