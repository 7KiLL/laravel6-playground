<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhoneValidation;
use App\Models\User;
use App\Services\PhoneService;

class PhoneController extends Controller
{

    /**
     * @var PhoneService
     */
    private $phoneService;

    /** @var User */
    private $user;

    public function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
        $this->user = auth()->user();
    }

    /**
     * Send code to the phone and give request ID to check with
     *
     * @param PhoneValidation $phoneValidation
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendCode(PhoneValidation $phoneValidation)
    {
        $request = $this->phoneService->verify($phoneValidation->phone);
        $this->user->update(['phone' =>  $phoneValidation->phone]);
        return response()->json(['request_id' => $request]);
    }

    public function checkVerificationCode(PhoneValidation $phoneRegistration)
    {
        if ($this->phoneService->check($phoneRegistration['request_id'], $phoneRegistration['code'])) {
            $this->user->verifyPhone();
            return response()->json(['message' => 'Phone number was successfully verified']);
        }
    }
}
