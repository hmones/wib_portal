<?php

namespace App\View\Components;

use App\Models\Sector;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use Sentry;

class Sectors extends Component
{
    public $label;
    public $fieldname;
    public $defaultText;
    public $emptyOption;
    public $value;
    public $offset;
    public $dropdownCss;

    public function __construct($label = null, $fieldname = null, $defaultText = null, $emptyOption = null, $value = null, $offset = 0, $dropdownCss = "")
    {
        $this->label = $label;
        $this->fieldname = $fieldname;
        $this->defaultText = $defaultText;
        $this->emptyOption = $emptyOption;
        $this->value = $value;
        $this->offset = $offset;
        $this->dropdownCss = $dropdownCss;
    }

    public function render()
    {
        return view('components.Sectors');
    }

    public function sectors()
    {
        try {
            $sectors = Cache::rememberForever('sectors', function () {
                return Sector::all();
            });
        } catch (\Throwable $exception) {
            Sentry\captureException($exception);
            $sectors = Sector::all();
        }

        return $sectors;
    }

    public function sectorList()
    {
        return request()->has('sectors') ? request()->sectors : '';
    }
}
