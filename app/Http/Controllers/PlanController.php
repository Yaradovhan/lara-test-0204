<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index(): View
    {
        $plans = Plan::all();

        return view('plans.index', compact('plans'));
    }

    public function buyPlan(Plan $plan): RedirectResponse
    {
        $user = Auth::user();
        $user->plan_id = $plan->id;
        $user->save();

        return redirect()->route('plans')->with('success', 'Your plan has been updated.');
    }
}
