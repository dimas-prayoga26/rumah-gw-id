<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimulasiRequest;
use App\Models\RABRecommend;
use Illuminate\Support\Facades\Session;

class RecommendController
{
    public function getRecommend(SimulasiRequest $request)
    {
        $input = $request->all();

        $result = $this->get_recommend($input);

        Session::put('recomend', $result);

        $rabController = new RABController();

        $rab = $rabController->get_rab([
            'luas' => $result['luas_1'],
            'luas2' => $result['luas_2'] ?? 0,
            'luasTotal' => $result['luas_1'] + ($result['luas_2'] ?? 0),
            'lantai' => $input['lantai'],
            'konsep' => 1,
            'carpot' => $input['carpot'] ?? 0,
        ]);

        Session::put('rab', $rab);

        return response()->json($result);
    }

    public function get_recommend(array $data)
    {
        $luas = (int) ($data['luas'] ?? 0);
        $lantai = (int) ($data['lantai'] ?? 1);
        $lantai1 = false;
        $lantai2 = false;

        if ($lantai === 1) {
            $lantai1 = true;
        } else {
            $lantai2 = true;
        }

        $recomend = RABRecommend::recommend($luas);

        if ($recomend && count($recomend) > 0) {
            $luas_bangunan = $lantai > 1 ? ($luas - $recomend[0]->tangga) : $luas;
            $sisa = $luas - (float) $recomend[0]->luas_optimal;
            $jml_wc = $sisa > ($recomend[0]->k_mandi * 2) ? 3 : ($sisa > $recomend[0]->k_mandi ? 2 : 1);
            $sisa_tambah_wc = $sisa - $jml_wc * $recomend[0]->k_mandi;
            $luas_tambahan = $sisa_tambah_wc / 7;

            $lantai1 = [
                [
                    'luas' => $recomend[0]->teras + $luas_tambahan,
                    'jml' => 1,
                    'nama' => 'Teras',
                    'img' => asset('assets/img/ruang_img/teras.jpg')
                ],
                [
                    'luas' => $recomend[0]->r_tamu + $luas_tambahan,
                    'jml' => 1,
                    'nama' => 'Ruang Tamu',
                    'img' => asset('assets/img/ruang_img/ruang_tamu.jpg')
                ],
                [
                    'luas' => $recomend[0]->r_keluarga + $luas_tambahan,
                    'jml' => 1,
                    'nama' => 'Ruang Keluarga dan Ruang Makan',
                    'img' => asset('assets/img/ruang_img/ruang_makan.jpg')
                ],
                [
                    'luas' => $recomend[0]->k_tidur_utama + $luas_tambahan,
                    'jml' => 1,
                    'nama' => 'Kamar Tidur Utama',
                    'img' => asset('assets/img/ruang_img/kamar_tidur.jpg')
                ],
                [
                    'luas' => $recomend[0]->k_tidur + $luas_tambahan,
                    'jml' => 1,
                    'nama' => 'Kamar Tidur',
                    'img' => asset('assets/img/ruang_img/kamar_tidur_anak.jpg')
                ],
                [
                    'luas' => $recomend[0]->dapur + $luas_tambahan,
                    'jml' => 1,
                    'nama' => 'Dapur',
                    'img' => asset('assets/img/ruang_img/dapur.png')
                ],
                [
                    'luas' => $recomend[0]->k_mandi,
                    'jml' => $jml_wc,
                    'nama' => 'Kamar Mandi / WC',
                    'img' => asset('assets/img/ruang_img/kamar_mandi.jpg')
                ],
            ];

            if ((int) $recomend[0]->type > 0) {
                $lantai1[] = [
                    'luas' => $recomend[0]->r_cuci + $luas_tambahan,
                    'jml' => 1,
                    'nama' => 'Ruang Cuci Jemuran',
                    'img' => asset('assets/img/ruang_img/ruang_cuci.jpg')
                ];
            }

            if ($lantai > 1) {
                $luas_lantai2 = 0.8 * $luas_bangunan;
                $luas_semua_ruang = $recomend[0]->balkon + $lantai1[2]['luas'] + $lantai1[3]['luas'] + ($lantai1[7]['luas'] ?? 0);
                $sisa_ruang = $luas_lantai2 - $luas_semua_ruang;
                $luas_penambahan = $sisa_ruang / 4;
                $jml_k_tidur = $luas_penambahan > $lantai1[2]['luas'] * 2 ? 2 : 1;

                $lantai2 = [
                    [
                        'luas' => $recomend[0]->balkon + $luas_penambahan,
                        'jml' => 1,
                        'nama' => 'Balkon',
                        'img' => asset('assets/img/ruang_img/balkon.jpg')
                    ],
                    [
                        'luas' => $lantai1[2]['luas'] + $luas_penambahan,
                        'jml' => 1,
                        'nama' => 'Ruang Keluarga dan Ruang Makan',
                        'img' => asset('assets/img/ruang_img/ruang_makan.jpg')
                    ],
                    [
                        'luas' => $lantai1[3]['luas'] + $luas_penambahan,
                        'jml' => $jml_k_tidur,
                        'nama' => 'Kamar Tidur',
                        'img' => asset('assets/img/ruang_img/kamar_tidur_anak.jpg')
                    ],
                    [
                        'luas' => $lantai1[7]['luas'] + $luas_penambahan,
                        'jml' => 1,
                        'nama' => 'Ruang Cuci Jemuran',
                        'img' => asset('assets/img/ruang_img/ruang_cuci.jpg')
                    ],
                ];
            }
        }

        $res = [
            'type' => count($recomend) > 0 ? $recomend[0]->type : -1,
            'luas_1' => $luas,
            'luas_2' => $lantai > 1 ? ($luas * 0.8) : 0,
            'ruang_1' => $lantai1,
            'ruang_2' => $lantai > 1 ? ($lantai2 ?? []) : [],
        ];

        Session::put('recomend', $res);

        return $res;
    }
}
