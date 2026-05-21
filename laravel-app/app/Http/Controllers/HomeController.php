<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Adoption;
use App\Models\Donation;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredCats = Cat::where('status', 'Available')->inRandomOrder()->take(3)->get();

        $impact = [
            'rescued'    => Cat::count(),
            'donations'  => Donation::count(),
            'raised'     => Donation::sum('amount'),
            'campaigns'  => Event::where('status', 'active')->count(),
        ];

        return view('home', compact('featuredCats', 'impact'));
    }
}
