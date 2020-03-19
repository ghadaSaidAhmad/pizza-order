<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PizzaControllerTest extends TestCase
{

    /**
     * Tests shop index without params to see if it works
     *
     * @return void
     */
    public function testPizzaIndex()
    {
        $response = $this->json('GET', '/api/v1/pizzas');
        $response->assertStatus(201);
    
    }
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function can_create_pizza()
    {

        //given
            //USER is authenticated 
        //when
            //post request create pizza 
        //then
            // pizza object exist
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
