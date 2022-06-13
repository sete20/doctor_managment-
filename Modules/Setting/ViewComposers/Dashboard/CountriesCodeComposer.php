<?php

namespace Modules\Setting\ViewComposers\Dashboard;

use Illuminate\View\View;
use PragmaRX\Countries\Package\Countries;

class CountriesCodeComposer
{
    public function compose(View $view)
    {
        $phoneCodes = [];

        foreach (Countries::all() as $key => $value) {
            if (isset($value->dialling) && isset($value->dialling->calling_code)) {

                $country['name']          = $value->name->common;
                $country['code']          = $value->cca2;
                $country['flag']          = optional($value->flag)->emoji;
                $country['calling_code']  = optional(optional($value)->dialling)->calling_code;

                $phoneCodes[] = $country;
            }
        }

        $view->with('phoneCodes' , $phoneCodes);
    }
}
