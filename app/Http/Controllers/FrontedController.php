<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FAQ;
use App\Models\Portfolios;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontedController extends Controller
{
    public function getFrontedData()
    {
        $services = Service::all();
        $testimonials = Testimonial::all();
        $teams = Team::all();
        $portfolio = Portfolios::all();
        $about_us = About::all();
        $settings = Setting::first();
        $faqs = FAQ::all();
        return response()->json(['services' => $services, 'testimonials' => $testimonials, 'teams' => $teams,
            'portfolio' => $portfolio, 'about_us' => $about_us, 'settings' => $settings, 'faqs' => $faqs]);
    }
}
