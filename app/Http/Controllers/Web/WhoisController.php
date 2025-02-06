<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;


class WhoisController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('whois');
    }
}
