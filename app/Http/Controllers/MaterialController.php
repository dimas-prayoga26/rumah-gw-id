<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Models\RABMaterial;
use Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $material = Cache::remember('materials', 60 * 60 * 24, function () {
            return RABMaterial::all();
        });
        return view('admin.material', compact('material'));
    }

    public function update(MaterialRequest $request, $material)
    {
        $validated = $request->validated();

        $data = RABMaterial::findOrFail($material);
        $data->update($validated);

        Cache::forget('materials');

        return response()->json(['success' => true]);
    }
}
