<?php

namespace App\Services\Books;

use App\Repositories\Categories\CategoryRepository;
use App\Services\Rabbit\Messages\CategoryCreateMessageDTO;

class BookStoreByMessageService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {
    }

    public function handle(CategoryCreateMessageDTO $messageDTO)
    {
        $this->categoryRepository->create($messageDTO);
    }
}
