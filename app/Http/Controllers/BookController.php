<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\PhotoResource;
use App\Repositories\Books\BookStoreDTO;
use App\Services\Books\BooksService;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct(
        protected BooksService $booksService
    ) {
    }

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
    public function store(
        BookStoreRequest $request,
    ) {
        $validatedData = $request->validated();
        $dto = new BookStoreDTO(
            $validatedData['name'],
            $validatedData['year'],
            now()
        );
        $bookIterator = $this->booksService->store($dto);

        return new BookResource($bookIterator);
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