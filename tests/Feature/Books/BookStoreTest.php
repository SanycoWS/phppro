<?php

namespace Books;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookStoreTest extends TestCase
{

    public function testSuccessfulCreate(): void
    {
        $data = [
            'name' => 'testName',
            'lang' => 'ua',
            'year' => 2000,
        ];
        $response = $this->postJson('/api/book', $data);
        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('data.name', 'Testname')
                ->where('data.year', $data['year'])
            )
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'year',
                    'category' => [
                        'id',
                        'name',
                    ],
                    'createdAt'
                ]
            ]);
        $this->assertDatabaseHas('books', [
            'name' => 'Testname',
        ]);
    }

    /**
     * @dataProvider dataFailedCreate
     * @param array $data
     * @param string $errorMessage
     * @param string $field
     * @return void
     */
    public function testFailedCreate(array $data, string $errorMessage, string $field): void
    {
        $response = $this->postJson('/api/book', $data);
        $content = $response->getContent();
        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('errors.' . $field . '.0', $errorMessage)
                ->etc()
            )
            ->assertJsonStructure([
                'message',
                'errors' => [
                    $field
                ]
            ]);
    }

    public static function dataFailedCreate(): array
    {
        return [
            'max name length' => [
                [
                    'name' => '123456789012345678901',
                    'lang' => '1',
                    'year' => 1,
                ],
                [
                    'name' => 'The name field must not be greater than 20 characters.',
                ]
            ],
            'name is required' => [
                [
                ],
                [
                    'name' => 'The name field is required.',
                    'year' => 'The year field is required.',
                    'lang' => 'The lang field is required.',
                ]
            ],
            'lang is required' => [
                [
                    'name' => 'ua',
                    'year' => 1999,
                ],
                'The lang field is required.',
                'lang'
            ],
            'year is required' => [
                [
                    'name' => 'name',
                    'lang' => 'ua',
                ],
                'The year field is required.',
                'year'
            ],
            'max year value' => [
                [
                    'name' => 'name',
                    'lang' => 'ua',
                    'year' => 10000,
                ],
                'The year field must not be greater than 9999.',
                'year'
            ],
            'min year value' => [
                [
                    'name' => 'name',
                    'lang' => 'ua',
                    'year' => 1998,
                ],
                'The year field must be at least 1999.',
                'year'
            ],
            'lang value' => [
                [
                    'name' => 'name',
                    'lang' => 'ua2',
                    'year' => 1999,
                ],
                'The selected lang is invalid.',
                'lang'
            ],
        ];
    }
}
