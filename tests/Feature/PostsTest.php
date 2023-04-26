<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/api/posts');

    //     $response->assertStatus(200);
    //     $response->assertSee(_('No posts found'));
    // }


    public function test_create_post()
    {
        $user = User::create([
            'name' => 'hasan',
            'bio'  => 'sfsf',
            'image' => 'sfsf',
            'email' => 'hasan@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
        Post::create([
            'user_id' => $user->id,
            'text'    => 'text',
            'video'  => 'video path'
        ]);
        $response = $this->get('/api/posts');

        $response->assertStatus(200);
        $response->assertDontSee(_('No posts found'));
    }
}
