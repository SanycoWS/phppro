<?php

namespace App\Http\Controllers;

use App\Enums\Lang;
use App\Exceptions\BookStoreElseException;
use App\Exceptions\BookStoreException;
use App\Http\Requests\Book\BookIndexRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Resources\BookModelResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\ErrorResource;
use App\Models\Book;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\BookUpdateDTO;
use App\Services\Books\BooksService;
use App\Services\Books\BookStoreService;
use OpenApi\Attributes as OA;

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
        BookIndexRequest $request,
    ) {
        $data = $this->booksService->getAllData($request->get('lastId'));

        return BookResource::collection($data);
    }

    public function indexModel(
        BookIndexRequest $request
    ) {
        $data = $this->booksService->getAllDataModel(
            lastId: $request->get('lastId'),
            limit: 5,
        );
        /** @var Book $lastElement */
        $lastElement = $data->last();

        return BookModelResource::collection($data)
            ->additional([
                'lastId' => $lastElement->id
            ]);
    }

    #[OA\Get(
        path: '/bookIterator',
        tags: ['books'],
        parameters: [
            new OA\Parameter(
                name: 'lastId',
                in: 'query',
                required: true
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'show all books',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation errors',
                content: new OA\JsonContent(ref: '#/components/schemas/Errors')
            )
        ]
    )]
    public function indexIterator(
        BookIndexRequest $request
    ) {
        $data = $this->booksService->getAllDataIterator($request->get('lastId'));

        return BookResource::collection($data->getIterator()->getArrayCopy());
    }

    #[OA\Post(
        path: '/books',
        tags: ['books'],
        parameters: [
            new OA\Parameter(
                name: 'Authorization',
                in: 'header',
                required: true,
                schema: new OA\Schema(
                    description: 'Access token',
                    type: 'string',
                )
            ),
            new OA\Parameter(
                name: 'name',
                in: 'query',
                required: true,
                schema: new OA\Schema(
                    description: 'Rule unique for each user',
                    type: 'string',
                    maxLength: 20
                )
            ),
            new OA\Parameter(
                name: 'lang',
                in: 'query',
                required: true,
                schema: new OA\Schema(
                    enum: Lang::class
                )
            ),
            new OA\Parameter(
                name: 'year',
                in: 'query',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'show created book',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation errors',
                content: new OA\JsonContent(ref: '#/components/schemas/Errors')
            )
        ]
    )]
    /**
     * Store a newly created resource in storage.
     * @throws BookStoreException
     */
    public function store(
        BookStoreRequest $request,
        BookStoreService $bookStoreService
    ) {
        $validatedData = $request->validated();
        $dto = new BookStoreDTO(
            $validatedData['name'],
            $validatedData['year'],
            Lang::from($validatedData['lang']),
            now()
        );
        try {
            $bookIterator = $bookStoreService->handle($dto);

            return new BookResource($bookIterator);
        } catch (BookStoreException $bookStoreException) {
            return response(new ErrorResource($bookStoreException))->setStatusCode(422);
        } catch (BookStoreElseException $bookStoreElseException) {
            return response(new ErrorResource($bookStoreElseException))->setStatusCode(422);
        }
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
    public function update(BookUpdateRequest $request, string $id)
    {
        $this->booksService->update(new BookUpdateDTO(...$request->validated()));

        return new BookResource($this->booksService->getById($id));
    }

    #[OA\Delete(
        path: '/books',
        tags: ['books'],
        parameters: [
            new OA\Parameter(
                name: 'Authorization',
                in: 'header',
                required: true,
                schema: new OA\Schema(
                    description: 'Access token',
                    type: 'string',
                )
            ),
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: 'deleted book',
                content: null
            ),
        ]
    )]
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
