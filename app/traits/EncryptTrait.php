<?php
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
trait EncryptTrait 
{
    public function prepararEncriptador()
    {
        $factory = new PasswordHasherFactory ([
            'common' => ['algorithm' => 'bcrypt'],
            'memory-hard' => ['algorithm' => 'sodium'],
        ]);
        return $factory->getPasswordHasher('common');
    }
}