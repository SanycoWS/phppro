<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\PhotoStoreRequest;
use App\Http\Resources\PhotoResource;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PhotoResource::collection([
            (object)[
                'name' => 'test2',
                'size' => '13343',
                'status' => '13343',
            ],
            (object)[
                'name' => 'test2',
                'size' => '13343',
                'status' => '13343',
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PhotoStoreRequest $request)
    {
        $validatedData = $request->validated();

        return new PhotoResource(
            (object)[
                'name' => 'test',
                'size' => '13343',
                'status' => '13343',
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
