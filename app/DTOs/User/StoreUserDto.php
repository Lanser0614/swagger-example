<?php
declare(strict_types=1);

namespace App\DTOs\User;

class StoreUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    )
    {
    }


    public function validateData()
    {

    }

}
