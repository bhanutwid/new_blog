<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PostControllerFeatureTest extends TestCase
{   
    use RefreshDatabase;
    public function testToFetchAllPosts()
    {
        Post::factory()->count(3)->create();
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}