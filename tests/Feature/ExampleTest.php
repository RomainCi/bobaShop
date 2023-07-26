<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleTest extends TestCase

{
    use WithFaker;

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

//    public function test_register_post()
//    {
//        $res = $this->post('api/register', [
//            "lastname" => "Doe",
//            "firstname" =>"John",
//            "birthdays" => "11/05/1989",
//            "phone" => "+52 998 153 5154",
//            "email" => "john@gmail.com",
//            "password" => "azertyuiopP@1",
//            "password_confirmation" => "azertyuiopP@1",
//            "check"=> true,
//        ]);
//        $res->assertStatus(200);
//    }
    public function test_update_home()
    {
        $credial = [
            "email" => "john@gmail.com",
            "password" => "azertyuiopP@1"
        ];
        $this->get("sanctum/csrf-cookie");
        $connexion = $this->post('api/login', $credial);
        $res = $this->put('api/home/content=1', [
            "content" => "test"
        ]);
        $res->assertStatus(200);
    }

//    public function test_store_menus()
//    {
//        $menu = [
//            "name" => "allo",
//            "sides" => 4,
//            "price" => 12.45,
//            "size" => 500
//        ];
//        $response = $this->post('api/products/menus',
//            [
//                "name" => "allo",
//                "sides" => 4,
//                "price" => 12.45,
//                "size" => 500
//            ]
//        );
//        $response->assertStatus(200);
////        $this->assertCount(2, ProductsMenu::all());
//    }

//    public function test_check_email()
//    {
//        $id = 1;
//        //http://127.0.0.1:8000/confirmation/email/id={{$id??null}}&token={{$token??null}}"
//        $response = $this->get('http://127.0.0.1:8000/confirmation/email/id=1&token=2');
////        $response = $this->get('/');
//        $response->assertStatus(200);
//    }

    public function test_store_orders()
    {
        $user = User::find(1);
        $data = [];

        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                "teas" => [
                    "id" => 1
                ],
                "pearls" => [
                    "id" => 4
                ],
                "syrups" => [
                    "id" => 4
                ],
                "menus" => [
                    "id" => 1
                ],
                "sides" => null
            ];
        }
//        $data = [
//            [
//                "teas" => [
//                    "id" => 1
//                ],
//                "pearls" => [
//                    "id" => 4
//                ],
//                "syrups" => [
//                    "id" => 4
//                ],
//                "menus" => [
//                    "id" => 1
//                ],
//                "sides" => null
//
//            ],
//
//        ];
        $toto = [];
        $response = $this->actingAs($user, 'sanctum')->post('/api/orders', ['data' => $toto]);
        $response->assertStatus(422);
//        $response = $this->post('api/orders')
    }
}
