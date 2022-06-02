<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email)
    {
        $mailchimp = new ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us13',
        ]);

        return $response = $mailchimp->lists->addListMember('931e1b1331', [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
}
