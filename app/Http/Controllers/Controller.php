<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        //DONE: 1) Display Hello world? done in blade, easy adjustment
        //DONE: 2) store something in redis cache, and extract from cache
        //DONE: 3) create mySQL migration of basic user model (name, email, etc.)

        $this->TestCaching('test_key');
        echo("test");
        return view('welcome',);
    }

    public function TestCaching(string $key): void
    {
        $value = Cache::remember($key, 60, function(){
            return 'SomeResponse';});
    }
}
