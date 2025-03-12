<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Personne;

class PersonneTest extends TestCase
{
    public function testCategorie()
    {
        $mineur = new Personne('Nader', 'Saidi', 16);
        $this->assertSame('mineur', $mineur->categorie());
    }

    public function testCategorie1()
    {
        $majeur = new Personne('Sahbi', 'Saidi', 25);
        $this->assertSame('majeur', $majeur->categorie());
    }

    public function testInvalidAge()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Personne('Neder', 'Saidi', -5); // L'exception doit être levée ici
    }
}
