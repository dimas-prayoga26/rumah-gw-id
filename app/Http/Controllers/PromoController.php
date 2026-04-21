<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Http\Requests\PromoRequest;
use App\Http\Requests\UpdatePromoRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PromoController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */

    private function checkOverlapPromo($mitraId, $startDate, $endDate, $excludePromoId = null)
    {
        $query = Promo::where('mitra_id', $mitraId)
            ->where(function ($q) use ($startDate, $endDate) {
                $q->whereBetween('tanggal_mulai', [$startDate, $endDate])
                ->orWhereBetween('tanggal_selesai', [$startDate, $endDate])
                ->orWhere(function ($q2) use ($startDate, $endDate) {
                    $q2->where('tanggal_mulai', '<=', $startDate)
                        ->where('tanggal_selesai', '>=', $endDate);
                });
            });

        if ($excludePromoId) {
            $query->where('id', '<>', $excludePromoId);
        }

        return $query->exists();
    }

    public function index()
    {
        $promo = Promo::sort()->get();
        return view('mitra.promo', compact('promo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromoRequest $request)
    {
        $this->authorize('create', Promo::class);
        $request->validated();

        $mitraId = auth()->user()->id;
        $startDate = $request->input('tanggal_mulai');
        $endDate = $request->input('tanggal_selesai');

        if ($this->checkOverlapPromo($mitraId, $startDate, $endDate)) {
            return response()->json([
                'success' => false,
                'message' => 'Promo dengan rentang tanggal tersebut sudah ada.',
            ], 422);
        }

        $promo = new Promo();
        $promo->mitra_id = auth()->user()->id;
        $promo->judul = $request->input('judul');
        $promo->diskon = $request->input('diskon');
        $promo->harga_akhir = auth()->user()->mitra->harga * (1 - $request->input('diskon') / 100);
        $promo->tanggal_mulai = $request->input('tanggal_mulai');
        $promo->tanggal_selesai = $request->input('tanggal_selesai');
        $promo->save();

        return response()->json([
            'success' => true,
            'message' => 'Promo berhasil dibuat',
        ]);
    }
    public function update(PromoRequest $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $this->authorize('update', $promo);
        $request->validated();

        $mitraId = auth()->user()->id;
        $startDate = $request->input('tanggal_mulai');
        $endDate = $request->input('tanggal_selesai');

        if ($this->checkOverlapPromo($mitraId, $startDate, $endDate, $id)) {
            return response()->json([
                'success' => false,
                'message' => 'Promo dengan rentang tanggal tersebut sudah ada.',
            ], 422);
        }

        $promo->judul = $request->input('judul');
        $promo->diskon = $request->input('diskon');
        $promo->harga_akhir = auth()->user()->mitra->harga * (1 - $request->input('diskon') / 100);
        $promo->tanggal_mulai = $request->input('tanggal_mulai');
        $promo->tanggal_selesai = $request->input('tanggal_selesai');
        $promo->update();

        return response()->json([
            'success' => true,
            'message' => 'Promo berhasil diperbarui',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        $this->authorize('delete', $promo);
        $promo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Promo berhasil dihapus',
        ]);
    }
}
