<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;


class DatabaseUnitTest extends TestCase
{   
    use RefreshDatabase;
    public function test_to_check_database_connection()
    {
        $this->assertTrue(DB::connection()->getDatabaseName() !== null, 'Database connection failed.');
    }
    public function test_post_model_working_or_not()
    {
        $post = Post::create([
            'title' => 'Test Post',
            'content' => 'This is test content.',
        ]);
        $this->assertEquals('Test Post', $post->title);
        $this->assertEquals('This is test content.', $post->content);
    }
    public function test_can_retrieve_posts_from_database()
    {
        $post = Post::create([
            'title' => 'Post in DB',
            'content' => 'Get content from DB',
        ]);
        $retrievedPost = Post::find($post->id);
        $this->assertNotNull($retrievedPost);
        $this->assertEquals($post->title, $retrievedPost->title);
        $this->assertEquals($post->content, $retrievedPost->content);
    }
    public function test_set_get_redis_value()
    {
        Redis::set('test_key', 'test_value');
        $value = Redis::get('test_key');
        $this->assertEquals('test_value', $value);
    }
}
