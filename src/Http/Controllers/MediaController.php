<?php

namespace Tahir\CMS\Http\Controllers;

use Tahir\CMS\Models\Media;
use Tahir\CMS\Http\Controllers\PrivateController;
use Tahir\CMS\Http\Requests\StoreMediaRequest;
use Tahir\CMS\Http\Requests\UpdateMediaRequest;

class MediaController extends PrivateController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tacms::private.media.index');
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
    public function store(StoreMediaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        //
    }
}
