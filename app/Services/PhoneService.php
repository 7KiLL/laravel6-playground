<?php


namespace App\Services;


use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;
use Nexmo\Verify\Verification;

class PhoneService
{
    /** @var Client  */
    private $client;

    public function __construct(array $options)
    {
        $basic = new Basic($options['key'], $options['secret']);
        $this->client = new Client($basic);
    }

    /**
     * Start phone verification process,
     * get $requestId to identify with user`s code
     *
     * @param string $number
     * @return string|null
     */
    public function verify(string $number)
    {
        $verification = $this->client->verify()->start([
            'number' => $number,
            'brand'  => config('phone.brand'),
            'code_length'  => config('phone.code_length')
        ]);

        return $verification->getRequestId();
    }

    /**
     * Check user`s code with request ID
     *
     * @param string $requestId
     * @param string|int $code
     * @return bool
     */
    public function check($requestId, $code)
    {
        $request_id = $requestId;
        $verification = new Verification($request_id);
        $result = $this->client->verify()->check($verification, $code);
        if ($result->getStatus() == 0) {
            return true;
        } else {
            return false;
        }
    }
}
