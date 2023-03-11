<?php

namespace App\Http\Controllers;

use App\Models\Portfolios;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $services = Service::all();
        $servicesMonth=Service::whereMonth('created_at',Carbon::now()->month)->count();
        $totalService = $services->count();
        $testimonials = Testimonial::all();
        $testimonialMonth=Testimonial::whereMonth('created_at',Carbon::now()->month)->count();
        $totalTestimonial = $testimonials->count();
        $teams = Team::all();
        $teamMonth=Team::whereMonth('created_at',Carbon::now()->month)->count();
        $totalTeam = $teams->count();
        $portfolios=Portfolios::all();
        $portfolioMonth=Portfolios::whereMonth('created_at',Carbon::now()->month)->count();
        $totalPortfolio=$portfolios->count();
        return response()->json(['totalService'=>$totalService,'totalTestimonial'=>$totalTestimonial,
            'totalTeam'=>$totalTeam,'totalPortfolio'=>$totalPortfolio,'servicesMonth'=>$servicesMonth,
            'testimonialMonth'=>$testimonialMonth,'teamMonth'=>$teamMonth,'portfolioMonth'=>$portfolioMonth]);
    }
}
