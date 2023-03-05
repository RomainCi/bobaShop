<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_post()
    {
        $res = $this->post('api/register', [
            "lastname" => "Doe",
            "firstname" =>"John",
            "birthdays" => "11/05/1989",
            "phone" => "+52 998 153 5154",
            "email" => "john@gmail.com",
            "password" => "azertyuiopP@1",
            "password_confirmation" => "azertyuiopP@1",
            "check"=> true,
        ]);
        $res->assertStatus(200);
    }
}
