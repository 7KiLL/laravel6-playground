<?php
    return [
        'provider' => 'nexmo', // config('services.PROVIDER')
        'brand' => env('PHONE_BRAND', 'PetProject'),
        'code_length' => 4, // 4 or 6
    ];
