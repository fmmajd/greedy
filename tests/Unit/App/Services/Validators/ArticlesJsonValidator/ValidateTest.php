<?php

namespace Tests\Unit\App\Services\Validators\ArticlesJsonValidator;

use App\Services\Validators\ArticlesJsonValidator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ValidateTest extends TestCase
{
    private ArticlesJsonValidator $articlesValidator;

    private array $correctInput = [
        'articles' => [
            [
                'id' => 1,
                'name' => 'screw',
                'stock' => 1,
            ],
        ],
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->articlesValidator = app()->make(ArticlesJsonValidator::class);
    }

    public function test_articles_validator_should_reject_empty_array(): void
    {
        $this->expectException(ValidationException::class);
        $input = [];

        $this->articlesValidator->validate($input);
    }

    public function test_articles_validator_should_reject_non_array_articles(): void
    {
        $input = [
            'articles' => 1,
        ];

        try {
            $this->articlesValidator->validate($input);
            $this->fail('Validation exception did not occur.');
        } catch (ValidationException $exception) {
            $errors = $exception->errors();

            $this->assertCount(1, $errors);
            $this->assertArrayHasKey('articles', $errors);
            $this->assertCount(1, $errors['articles']);
            $this->assertEquals('The articles must be an array.', $errors['articles'][0]);
        }
    }

    public function test_articles_validator_should_reject_articles_without_id(): void
    {
        $input = $this->correctInput;
        unset($input['articles'][0]['id']);

        try {
            $this->articlesValidator->validate($input);
            $this->fail('Validation exception did not occur.');
        } catch (ValidationException $exception) {
            $errors = $exception->errors();

            $this->assertCount(1, $errors);
            $this->assertArrayHasKey('articles.0.id', $errors);
            $this->assertCount(1, $errors['articles.0.id']);
            $this->assertEquals('The articles.0.id field is required.', $errors['articles.0.id'][0]);
        }
    }

    public function test_articles_validator_should_reject_articles_without_name(): void
    {
        $input = $this->correctInput;
        unset($input['articles'][0]['name']);

        try {
            $this->articlesValidator->validate($input);
            $this->fail('Validation exception did not occur.');
        } catch (ValidationException $exception) {
            $errors = $exception->errors();

            $this->assertCount(1, $errors);
            $this->assertArrayHasKey('articles.0.name', $errors);
            $this->assertCount(1, $errors['articles.0.name']);
            $this->assertEquals('The articles.0.name field is required.', $errors['articles.0.name'][0]);
        }
    }

    public function test_articles_validator_should_reject_articles_without_stock(): void
    {
        $input = $this->correctInput;
        unset($input['articles'][0]['stock']);

        try {
            $this->articlesValidator->validate($input);
            $this->fail('Validation exception did not occur.');
        } catch (ValidationException $exception) {
            $errors = $exception->errors();

            $this->assertCount(1, $errors);
            $this->assertArrayHasKey('articles.0.stock', $errors);
            $this->assertCount(1, $errors['articles.0.stock']);
            $this->assertEquals('The articles.0.stock field is required.', $errors['articles.0.stock'][0]);
        }
    }

    public function test_articles_validator_should_accept_correct_input(): void
    {
        $input = $this->correctInput;

        $this->articlesValidator->validate($input);
        $this->assertTrue(true);
    }
}
