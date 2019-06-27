<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Garbage;

class GarbageController extends Controller
{
    public function show($name)
    {
        $garbages = Garbage::query()->where('name', 'like', "%$name%")->get();
    	return $garbages;
    }
}
