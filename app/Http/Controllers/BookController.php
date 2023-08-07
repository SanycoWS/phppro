<?php

namespace App\Http\Controllers;

use App\Enums\Lang;
use App\Http\Requests\Book\BookIndexRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Resources\BookModelResource;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\Iterators\BookIterator;
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
    public function index(
        BookIndexRequest $request
    ) {
        $data = $this->booksService->getAllData($request->get('lastId'));
        /** @var BookIterator $lastElement */
        $lastElement = $data->last();

        return BookResource::collection($data)
            ->additional([
                'lastId' => $lastElement->getId()
            ]);
    }

    public function indexModel(
        BookIndexRequest $request
    ) {
        $data = $this->booksService->getAllDataModel($request->get('lastId'));
        /** @var Book $lastElement */
        $lastElement = $data->last();

        return BookModelResource::collection($data)
            ->additional([
                'lastId' => $lastElement->id
            ]);
    }

    public function indexIterator(
        BookIndexRequest $request
    ) {
        $data = $this->booksService->getAllDataIterator($request->get('lastId'));

        return BookResource::collection($data->getIterator()->getArrayCopy());
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
            Lang::from($validatedData['lang']),
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
