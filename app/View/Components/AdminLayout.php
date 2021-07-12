<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public $title;

    public $spinLogo;

    public $activeRoute = '';

    public function __construct($title, $activeRoute = '', $spinLogo = false)
    {
        $this->title = $title;
        $this->spinLogo = $spinLogo;
        $this->activeRoute = $activeRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.admin');
    }
}
