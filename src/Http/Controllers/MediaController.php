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
    public function create(StoreMediaRequest $request)
    {
        return view('tacms::private.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request)
    {
        $mimes = config('tacms.media_extensions');

        $reversed_extensions = [];
        foreach($mimes as $key => $extensions) {
            foreach($extensions as $extension) {
                $reversed_extensions[$extension] = $key;
            }
        }
        if ($request->hasfile('files')) {
            foreach($request->file('files') as $file) {

                $path = $file->store('media');
                $name = $file->getClientOriginalName();
                $extension = strtolower($file->getClientOriginalExtension());
                $mime = $file->getClientMimeType();
                $type = $reversed_extensions[$extension];
                dd($path);
            }
        }
        return redirect()->route('media.create')->with('error', 'Error occured!');
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
