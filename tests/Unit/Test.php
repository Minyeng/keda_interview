<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    
    public function testLoginSuccess()
    {
        $formData = [
            'email' => 'staff@gmail.com',
            'password' => 'dummydummy'
        ];
        $this->json('post', 'api/auth/login', $formData)
        ->assertStatus(200)
        ->assertJsonStructure(['success']);
    }

    public function testLoginFailed()
    {
        $formData = [
            'email' => 'staff@gmail.com',
            'password' => '123456'
        ];
        $this->json('post', 'api/auth/login', $formData)
        ->assertStatus(200)
        ->assertJsonStructure(['error']);
    }

    public function testLogout()
    {
        $this->json('get', 'api/auth/logout')
        ->assertStatus(200);
    }

    // public function testDeletedUserSuccess()
    // {
    //     $this->json('delete', 'api/auth/deleted/1')
    //     ->assertStatus(200)
    //     ->assertJsonStructure(['success']);
    // }

    // public function testDeletedUserFailed()
    // {
    //     $this->json('delete', 'api/auth/delete/1000')
    //     ->assertStatus(200)
    //     ->assertJsonStructure(['failed']);
    // }

    // public function testDeletedAll()
    // {
    //     $this->json('delete', 'api/auth/delete-all')
    //     ->assertStatus(200);
    // }

}
