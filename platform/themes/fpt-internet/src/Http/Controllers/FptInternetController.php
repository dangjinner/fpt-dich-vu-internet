<?php

namespace Theme\FptInternet\Http\Controllers;

use Botble\Theme\Http\Controllers\PublicController;
use Theme\FptInternet\Http\Requests\RegisterServiceRequest;

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
        return true;
    }
}
