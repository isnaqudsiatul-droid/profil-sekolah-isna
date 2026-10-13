<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UjikomController extends Controller
{
    public function index()
    {
        $title = 'Simulasi Ujikom';

        return view('public.ujikom', compact('title'));
    }

    public function hitung(Request $request)
    {
        $request->validate([
            'nilai_1' => 'required|numeric|min:0|max:100',
            'nilai_2' => 'required|numeric|min:0|max:100',
            'nilai_3' => 'required|numeric|min:0|max:100',
        ], [
            'required' => 'Kolom nilai wajib diisi.',
            'numeric' => 'Nilai harus berupa angka.',
            'min' => 'Nilai minimal adalah 0.',
            'max' => 'Nilai maksimal adalah 100.',
        ]);

        $n1 = $request->nilai_1;
        $n2 = $request->nilai_2;
        $n3 = $request->nilai_3;

        $rataRata = ($n1 + $n2 + $n3) / 3;

        $status = $rataRata > 75 ? 'Lulus' : 'Tidak Lulus';

        return back()->with([
            'ujikom_success' => true,
            'rata_rata' => round($rataRata, 2),
            'status' => $status,
        ])->withInput();
    }
}