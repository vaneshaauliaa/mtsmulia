<?php

namespace App\Http\Controllers;

use App\Models\membina;
use App\Http\Requests\StoremembinaRequest;
use App\Http\Requests\UpdatemembinaRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MembinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremembinaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(membina $membina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(membina $membina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemembinaRequest $request, membina $membina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(membina $membina)
    {
        //
    }
}
