<?php

namespace App\View\Components;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use Sentry;

class Countries extends Component
{
    public $label;

    public $fieldname;

    public $countrycode;

    public $value;

    public $dropdownCss;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $fieldname = null, $countrycode = 0, $value = "", $dropdownCss = "")
    {
        $this->label = $label;
        $this->fieldname = $fieldname;
        $this->countrycode = $countrycode;
        $this->value = $value;
        $this->dropdownCss = $dropdownCss;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.Countries');
    }

    public function countries()
    {
        try {
            $countries = Cache::rememberForever('countries', function () {
                return Country::all();
            });
        } catch (\Throwable $exception) {
            Sentry\captureException($exception);
            $countries = Country::all();
        }

        return $countries;
    }

    public function countryList()
    {
        if (request()->has('countries')) {
            return request()->countries;
        }

        return '';
    }
}
