<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class PhoneNumberResolutionService
{
    private array $networks = ['MTN', 'VOD', 'ATL'];

    public function __construct(private readonly string $phoneNumber)
    {

    }

    public function resolve()
    {
        foreach ($this->networks as $network) {
            if ($response = $this->getName($network)) return $response;
        }
        return null;
    }

    public function getName(string $bankCode)
    {
        try {
            $response = Http::withToken('NnRlVE9maE1ueXFxbTNKdGpUWWM5MVlNcmJjS3JiMVRjSXp5ek5YNElqRWJ0RFVEMlRSeXhRU0RUZ3FyeVIyNDZmRTBxY29tYUVKanF1aWxqOGhSbEU5UFlKUU5BRFdZYXNndA==
')
                ->get("https://paystack.zuberipay.com/api/v1.0/accounts/resolve?accountNumber={$this->phoneNumber}&bankCode={$bankCode}&employeeId=121&employeePhoneNumber=0506327253&employeeFullName=solomon appier-sign");

            logger()->info($response->json());

            if ($response->successful()) {
                $data = $response->json();
                $data['data']['network'] = $bankCode;
                return $data;
            };
        } catch (Exception $e) {
            report($e);
        }

        return null;
    }
}
