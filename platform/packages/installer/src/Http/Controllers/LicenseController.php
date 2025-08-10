<?php

namespace Botble\Installer\Http\Controllers;

use Botble\Base\Exceptions\LicenseInvalidException;
use Botble\Base\Exceptions\LicenseIsAlreadyActivatedException;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Core;
use Botble\Setting\Http\Requests\LicenseSettingRequest;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Throwable;

class LicenseController extends BaseController
{
    public function index(): View|RedirectResponse
    {
        return view('packages/installer::license');
    }

    public function store(LicenseSettingRequest $request, Core $core): RedirectResponse
    {
        $licenseKey = $request->input('purchase_code');
        $buyer = $request->input('buyer');
        $finalUrl = URL::temporarySignedRoute('installers.final', Carbon::now()->addMinutes(30));

        try {
            $core->activateLicense($licenseKey, $buyer);

            setting()->set(['licensed_to' => $buyer])->save();

            return redirect()->to($finalUrl);
        } catch (LicenseInvalidException|LicenseIsAlreadyActivatedException $exception) {
            throw ValidationException::withMessages([
                'purchase_code' => [$exception->getMessage()],
            ]);
        } catch (Throwable $exception) {
            report($exception);

            throw ValidationException::withMessages([
                'purchase_code' => ['Something went wrong. Please try again later.'],
            ]);
        }
    }

    public function skip(): RedirectResponse
    {
        Core::make()->skipLicenseReminder();

        return redirect()->to(
            URL::temporarySignedRoute('installers.final', Carbon::now()->addMinutes(30))
        );
    }
}
