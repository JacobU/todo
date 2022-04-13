<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Http\Controllers\TodoController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;
    public $todo_string  = '/todo';

    public function test_routes()
    {
        //Should succeed
        $response = $this->get('/');
        $response->assertStatus(200);

        $response_todos = $this->get('/todos');
        $response_todos->assertStatus(200);

        //Should fail
        $response_single = $this->get('/todo/100');
        $response_single->assertStatus(404);

        $response_delete = $this->delete('/todo/100');
        $response_delete->assertStatus(404);
    }

    public function test_post() {
        $response_post = $this->postJson('/todo', [
                'name' => 'test_name',
                'description' => 'test_description',
                'due_date' => '2022/01/01',
                'is_complete' => 'false',
        ]);
        $response_post->assertStatus(201);
        
        $response_bad_post = $this->postJson('/todo', [
            'name' => 'test_name',
            'description' => 'test_description',
            'due_date' => 'wrongformatdate',
            'is_complete' => 'true',
        ]);
        $response_bad_post->assertStatus(500); 
    }

    public function test_patch() {
        //Fail because there isnt an id 100 todo
        $response_patch_fail = $this->patchJson('/todo/100', [
            'name' => 'test_name',
            'description' => 'test_description',
            'due_date' => '2022/01/01',
            'is_complete' => 'false',
        ]);
        $response_patch_fail->assertStatus(404);
        //Now should succeed as we have at least one item in DB
        $this->postJson('/todo', [
            'name' => 'first_name',
            'description' => 'test_description',
            'due_date' => '2022/01/01',
            'is_complete' => 'true',
        ]);

        $last_todo = Todo::max('id');
        $url =  '/todo'.'/'.$last_todo;
        $response_patch_success = $this->patchJson($url, [
            'name' => 'test_name',
            'description' => 'test_description',
            'due_date' => '2022/01/01',
            'is_complete' => 'false',
        ]);
        $response_patch_success->assertStatus(201);
    }

    public function test_delete() {
        $this->postJson('/todo', [
            'name' => 'make sure there is data',
            'description' => 'test_description',
            'due_date' => '2022/01/01',
            'is_complete' => 'false',
        ]);
        $last_todo = Todo::max('id');
        $url =  '/todo'.'/'.$last_todo;
        $response_delete = $this->deleteJson($url);
        $response_delete->assertStatus(200);
    }   
}
