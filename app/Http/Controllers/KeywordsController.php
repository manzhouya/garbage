<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeywordsController extends Controller
{
    public function show($num = 10)
    {
      	$keywords = \DB::select("SELECT `name` FROM `keywords` ORDER BY `count` DESC LIMIT $num");
    	return $keywords;
    }
}
