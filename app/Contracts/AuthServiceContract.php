<?php

namespace App\Contracts;

interface AuthServiceContract
{
    public function authenticate($username, $password);
}