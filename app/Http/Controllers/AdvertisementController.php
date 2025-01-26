<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdvertisementController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $advertisements = Advertisement::with('user')->latest()->get();
        return view('advertisements.index', compact('advertisements'));
    }

    public function create()
    {
        return view('advertisements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:120',
            'description' => 'required|max:360',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $advertisement = new Advertisement($validated);
        $advertisement->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('advertisements', 'public');
            $advertisement->image_path = $path;
        }

        $advertisement->save();

        return redirect()->route('advertisements.index')->with('success', 'Ogłoszenie zostało dodane.');
    }

    public function edit(Advertisement $advertisement)
    {
        $this->authorize('update', $advertisement);
        return view('advertisements.edit', compact('advertisement'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $this->authorize('update', $advertisement);

        $validated = $request->validate([
            'title' => 'required|max:120',
            'description' => 'required|max:360',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($advertisement->image_path) {
                Storage::disk('public')->delete($advertisement->image_path);
            }
            $path = $request->file('image')->store('advertisements', 'public');
            $advertisement->image_path = $path;
        }

        $advertisement->update($validated);

        return redirect()->route('advertisements.index')->with('success', 'Ogłoszenie zostało zaktualizowane.');
    }

    public function destroy(Advertisement $advertisement)
    {
        $this->authorize('delete', $advertisement);

        if ($advertisement->image_path) {
            Storage::disk('public')->delete($advertisement->image_path);
        }

        $advertisement->delete();

        return redirect()->route('advertisements.index')->with('success', 'Ogłoszenie zostało usunięte.');
    }
}