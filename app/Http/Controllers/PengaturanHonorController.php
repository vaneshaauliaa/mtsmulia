<?php

namespace App\Http\Controllers;

use App\Models\pengaturan_honor;
use App\Http\Requests\Storepengaturan_honorRequest;
use App\Http\Requests\Updatepengaturan_honorRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class PengaturanHonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $pengaturan_honor = pengaturan_honor::all();
        return view('pengaturan_honor.index', compact('pengaturan_honor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pengaturan_honor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storepengaturan_honorRequest $request)
{
    pengaturan_honor::create($request->validated());

    return redirect()->route('pengaturan_honor.index')
        ->with('success', 'Pengaturan honor berhasil ditambahkan.');
}
    /**
     * Display the specified resource.
     */
    public function show(pengaturan_honor $pengaturan_honor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengaturan_honor $pengaturan_honor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatepengaturan_honorRequest $request, pengaturan_honor $pengaturan_honor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengaturan_honor $pengaturan_honor)
    {
        //
    }
}
