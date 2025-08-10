<?php

namespace Theme\FptInternet\Http\Controllers;

use Botble\Contact\Models\Contact;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Theme\FptInternet\Http\Requests\RegisterServiceRequest;
use Theme\FptInternet\Jobs\ProcessContactSubmission;

class FptInternetController extends PublicController
{
    public function getIndex()
    {
        return parent::getIndex();
    }

    public function getView(?string $key = null, string $prefix = '')
    {
        return parent::getView($key);
    }

    public function getSiteMapIndex(string $key = null, string $extension = 'xml')
    {
        return parent::getSiteMapIndex();
    }

    public function registerService(RegisterServiceRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'subject' => $request->get('service'),
        ]);

        ProcessContactSubmission::dispatch([
            'id' => $contact->id,
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'service' => $request->get('service'),
            'utm_content' => $request->get('utm_content'),
            'utm_term' => $request->get('utm_term'),
            'utm_campaign' => $request->get('utm_campaign'),
            'utm_medium' => $request->get('utm_medium'),
            'utm_source' => $request->get('utm_source'),
            'time' => now()->format('Y-m-d H:i:s'),
            'ip' => $request->getClientIp(),
            'from_page' => $request->headers->get('referer')
        ]);

        return $contact;
    }

    public function thankYou()
    {
        return Theme::scope('thank-you')->render();
    }
}
