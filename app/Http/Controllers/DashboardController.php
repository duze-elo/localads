<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('advertisements'));
    }
}
?>