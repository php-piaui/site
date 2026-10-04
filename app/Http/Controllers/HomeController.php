<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cfp;
use App\Models\Event;
use App\Support\SiteContent;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'event'      => Event::published()->upcoming()->with('cfp')->first(),
            'cfp'        => Cfp::open()->with('event')->first(),
            'supporters' => SiteContent::supporters(),
        ]);
    }
}
