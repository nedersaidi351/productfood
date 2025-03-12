<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testDefauld()
    {
        $product = new Product('Pomme', 'food', 1);
        $this->assertSame(0.055, $product->computeTVA());
    }

    public function testDefauld1()
    {
        $product = new Product('Pomme', 'fruit', 1);
        $this->assertSame(0.196, $product->computeTVA());
    }

    public function testInvalidPrice()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Product('Pomme', 'food', -5); // L'exception doit être levée ici
    }

    /**
     * @dataProvider pricesForFood
     */
    public function testMultiPrices($prix, float $TVA)
    {
        $product = new Product("Produit", "food", $prix);
        $this->assertSame($TVA, $product->computeTVA());
    }

    public function pricesForFood()
    {
        return [
            [0.0, 0.0],
            [1.0, 0.055],
            [10.0, 0.55],
            [20.0, 1.1]
        ];
    }
}
