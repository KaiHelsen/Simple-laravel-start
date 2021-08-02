<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_cache()
    {
        $key = 'test_key';
        //first assert if the key value does not already exist in the cache
        $this->assertFalse(Cache::has($key));

        $controller = new Controller();
        $controller->TestCaching($key);

        //now assert if the new value exists in the cache
        $this->assertTrue(Cache::has($key));
    }
}
