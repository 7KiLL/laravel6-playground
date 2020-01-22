<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Passport\PersonalAccessTokenResult;

class BearerToken extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var JsonResource|PersonalAccessTokenResult $this */
        return [
            'accessToken' => $this->accessToken,
            'type' => 'Bearer',
            'expires_at' => $this->token->expires_at
        ];
    }
}
