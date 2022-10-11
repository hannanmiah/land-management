<?php

namespace App\Http\Livewire\Admin\SoldLand;

use App\Models\SoldLand;
use Livewire\Component;

class View extends Component
{
    public SoldLand $sold;
    public function render()
    {
        return view('livewire.admin.sold-land.view');
    }
}
