<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Adoption;
use App\Models\Donation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredCats = Cat::where('status', 'Available')->inRandomOrder()->take(3)->get();

        $impact = [
            'adopted' => Adoption::where('status', 'Approved')->count() + 120, // +120 legacy count
            'raised' => Donation::sum('amount') + 5000,
            'rescued' => Cat::count(),
        ];

        return view('home', compact('featuredCats', 'impact'));
    }
}
