<?php

namespace App\View\Components;

use App\Models\Project;
use Illuminate\View\Component;

class MobileSideBar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $proejcts = Project::with(['plots'])->latest()->limit(4)->get();
        return view('components.mobile-side-bar', ['projects' => $proejcts]);
    }
}
