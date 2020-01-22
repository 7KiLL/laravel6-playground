<?php

namespace App\Exceptions\Core;

use Exception;

class InvalidUUID extends Exception
{
    protected $message = 'Invalid UUID given';
}
