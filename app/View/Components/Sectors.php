<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Sector;

class Sectors extends Component
{
    public $label;

    public $fieldname;

    public $defaultText;

    public $emptyOption;

    public $value;

    public $offset;

    public $dropdownCss;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label=null,$fieldname=null,$defaultText=null,$emptyOption=null,$value=null,$offset=0,$dropdownCss="")
    {
        $this->label = $label;
        $this->fieldname = $fieldname;
        $this->defaultText = $defaultText;
        $this->emptyOption = $emptyOption;
        $this->value = $value;
        $this->offset = $offset;
        $this->dropdownCss = $dropdownCss;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.Sectors');
    }

    public function sectors()
    {
        return Sector::all();
    }

    public function sectorList()
    {
        if(isset(request()->sectors))
        {
            return implode(', ', request()->sectors);
        }

        return '';
    }
}
