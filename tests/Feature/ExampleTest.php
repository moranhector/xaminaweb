<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_existe_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_existe_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }    


    public function test_existe_mi_usuario()
    {
        // Make call to application...
     
        $this->assertDatabaseHas('users', [
            'email' => 'cano@mail'
        ]);
    }




}
