<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $domains = $user->domains;

        return view('dashboard', compact('domains'));
    }

    public function saveDomain(Request $request): RedirectResponse
    {
        $request->validate([
            'domain' => 'required|string',
        ]);

        $inputDomain = trim($request->input('domain'));
        $inputDomain = preg_replace('/^(https?:\/\/)?(www\.)?/', '', $inputDomain);
        $inputDomain = explode('/', $inputDomain)[0];

        if (Domain::where('domain', $inputDomain)->exists()) {
            return redirect()->back()->with('error', 'Domain already exists.');
        }

        Domain::create([
            'user_id' => Auth::id(),
            'domain'  => $inputDomain,
        ]);

        return redirect()->back()->with('success', 'Domain created.');
    }

    public function editDomain(int $id): View
    {
        $domain = Domain::findOrFail($id);

        if ($domain->user_id !== Auth::id()) {
            abort(403);
        }

        return view('domains.edit', compact('domain'));
    }

    public function updateDomain(Request $request, $id): RedirectResponse
    {
        $domain = Domain::findOrFail($id);

        if ($domain->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'domain' => 'required|string',
        ]);

        $inputDomain = trim($request->input('domain'));
        $inputDomain = preg_replace('/^(https?:\/\/)?(www\.)?/', '', $inputDomain);
        $inputDomain = explode('/', $inputDomain)[0];

        if (Domain::where('domain', $inputDomain)->where('id', '!=', $domain->id)->exists()) {
            return redirect()->back()->with('error', 'Domain already exists.');
        }

        $domain->update(['domain' => $inputDomain]);

        return redirect()->route('dashboard')->with('success', 'Domain updated successfully.');
    }
}
