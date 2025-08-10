<?php

namespace Theme\FptInternet\Mails;

use Botble\Theme\Facades\Theme;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $contactData;

    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    public function build()
    {
        return $this->subject("Có khách hàng mới đăng ký dịch vụ #{$this->contactData['id']}")
            ->view(Theme::getThemeNamespace() . '::views.emails.contact_notification')
            ->with([
                'contact' => $this->contactData
            ]);
    }
}
