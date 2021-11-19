<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_comments_from_api()
    {
        $response = $this->get('/api/comments')->assertStatus(200);
    }

    public function test_store_comment()
    {
        $response = $this->postJson('/api/comments',[
            "name"          => "Ross",
            "message"       => "It's good!",
            "parent_id"     => 0
        ])->assertStatus(200);
    }
}
