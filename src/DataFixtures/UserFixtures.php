<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $om): void
    {
        $u = new User();
        $u->setEmail('admin@example.com');
        $u->setRoles(['ROLE_ADMIN']);
        $u->setPassword($this->hasher->hashPassword($u, 'admin123'));
        $om->persist($u);
        $om->flush();
    }
}
