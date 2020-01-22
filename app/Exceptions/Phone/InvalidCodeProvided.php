<?php

namespace App\Exceptions\Phone;

use Exception;

class InvalidCodeProvided extends Exception
{
    protected $message = 'Invalid verification code provided';
}
