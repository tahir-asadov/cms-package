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
        return view('tacms::dashboard.media.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreMediaRequest $request)
    {
        return view('tacms::dashboard.media.create');
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
                $media = new Media();
                $media->name = $name;
                $media->extension = $extension;
                $media->type = $type;
                $media->mime = $mime;
                $media->size = 'original';
                $media->path = $path;
                $media->user_id = auth()->user()->id;
                $media->save();
                if($type == 'image') {
                    $variants = Media::resize($path);
                    foreach($variants as $key => $variant) {
                        $resized_media = new Media();
                        $resized_media->name = $name;
                        $resized_media->extension = $extension;
                        $resized_media->type = $type;
                        $resized_media->mime = $mime;
                        $resized_media->size = $key;
                        $resized_media->parent = $media->id;
                        $resized_media->path = $variant;
                        $resized_media->user_id = auth()->user()->id;
                        $resized_media->save();
                    }
                }

                if(request()->ajax()){
                    return response()->json([
                        'message' => 'ok',
                    ]);
                }else {
                    return redirect()->route('dashboard.media.index')->with('success', 'Files uploaded!');
                }
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
