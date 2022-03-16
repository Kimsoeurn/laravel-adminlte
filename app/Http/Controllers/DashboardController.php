<?php

namespace App\Http\Controllers;

class DashboardController
{
    protected $breadcrumb;

    public function __invoke()
    {
        $this->breadcrumb = [
            __('Home') => false,
        ];

        return view('dashboard', [
            'title' => __('Dashboard'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => route('dashboard'),
        ]);
    }
}
