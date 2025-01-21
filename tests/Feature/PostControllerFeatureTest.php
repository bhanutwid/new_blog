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
    public function test_it_creates_a_new_post()
    {
    $data = [
        'title' => 'Sample Title',
        'content' => 'Sample Content',
    ];
    $response = $this->postJson('/api/posts', $data);

    $response->assertStatus(201); 
    $response->assertJsonFragment($data); 
    $this->assertDatabaseHas('posts', $data); 
    }

    public function test_it_returns_validation_errors_when_fields_are_missing()
    {
    $response = $this->postJson('/api/posts', []);
    $response->assertStatus(422); 
    $response->assertJsonValidationErrors(['title', 'content']); 
    }
}