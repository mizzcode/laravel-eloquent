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
}
