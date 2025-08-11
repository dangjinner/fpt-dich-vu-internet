<?php

namespace Theme\FptInternet\Jobs;

use Botble\Theme\Facades\Theme;
use Google\Service\Sheets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Google\Client;
use Theme\FptInternet\Mails\ContactNotification;

class ProcessContactSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $contactData;
    protected string $sheetId;
    protected string $sheetName;

    /**
     * Create a new job instance.
     */
    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
        $this->sheetId = theme_option('google_spreadsheet_id');
        $this->sheetName = theme_option('google_sheet_name');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // 1. Gửi dữ liệu lên Google Sheet
        try {
            $this->appendToGoogleSheet($this->contactData);
        } catch (\Exception $e) {
            \Log::error('Gửi Google Sheet thất bại: ' . $e->getMessage());
        }

        // 2. Gửi email thông báo
//        try {
//            $emails = theme_option('notify_emails');
//            $emailArray = array_filter(array_map('trim', preg_split('/[,;]+/', $emails)));
//
//            Mail::to($emailArray)->send(new ContactNotification($this->contactData));
//        } catch (\Exception $e) {
//            \Log::error('Gửi email thất bại: ' . $e->getMessage());
//        }
    }

    private function appendToGoogleSheet($contact)
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google-service-account.json'));
        $client->addScope(Sheets::SPREADSHEETS);

        $service = new Sheets($client);

        $range = $this->sheetName . '!A:L';
        $values = [
            [
                $contact['time'],
                $contact['name'],
                $contact['phone'],
                $contact['service'],
                $contact['address'],
                $contact['ip'],
                $contact['utm_source'] ?? '',
                $contact['utm_campaign'] ?? '',
                $contact['utm_medium'] ?? '',
                $contact['utm_content'] ?? '',
                $contact['utm_term'] ?? '',
                $contact['from_page'],
            ]
        ];

        $body = new Sheets\ValueRange(['values' => $values]);
        $params = ['valueInputOption' => 'RAW'];

        $service->spreadsheets_values->append($this->sheetId, $range, $body, $params);
    }
}
