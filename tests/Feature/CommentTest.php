<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testCreateComment() {
        $comment = new Comment;
        $comment->email = "mizz@gmail.com";
        $comment->title = "Hello World";
        $comment->message = "Hello World";
        $comment->save();

        self::assertNotNull($comment->id);

        Log::info(json_encode($comment));
    }

    public function testAttributesDefaultValue() {
        // kita tidak set untuk title dan message
        // nanti akan di handle oleh attributes di model untuk memberikan default value nya
        $comment = new Comment;
        $comment->email = "mizz@gmail.com";
        $comment->save();

        self::assertNotNull($comment->id);

        Log::info(json_encode($comment));
    }
}
