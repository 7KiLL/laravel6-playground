<?php
    Route::apiResource('users', 'V1\UserController')->only(['index', 'show', 'update']);
