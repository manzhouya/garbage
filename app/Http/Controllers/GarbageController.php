<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GarbageController extends Controller
{
    public function show($name=null)
    {
      	$name = trim($name);
      	if(!$name){
        	return [];
        }
        $garbages = \DB::select("SELECT `garbages`.`name` AS `name`, `categories`.`name` AS `category` FROM `garbages` JOIN `categories` ON `garbages`.`category_id` = `categories`.`id` WHERE `garbages`.`name` LIKE '%$name%'");
    	return $garbages;
    }
}
