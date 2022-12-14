<?php

namespace App\View\Components;

use App\Models\Project;
use Illuminate\View\Component;

class SideBar extends Component
{
    public $projects;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->projects = Project::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.side-bar');
    }
}
