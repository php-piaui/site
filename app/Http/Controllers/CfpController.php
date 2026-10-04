<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cfp;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CfpController extends Controller
{
    public function show(Request $request): View
    {
        return view('cfp.show', [
            'cfp'            => Cfp::open()->with('event')->first(),
            'explainAccount' => $request->boolean('conta') && $request->user() === null,
        ]);
    }
}
