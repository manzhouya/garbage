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
        $garbages = \DB::select("SELECT `garbages`.`name` AS `name`, `categories`.`name` AS `category`, `categories`.`style` AS `category_style` FROM `garbages` JOIN `categories` ON `garbages`.`category_id` = `categories`.`id` WHERE `garbages`.`name` LIKE '%$name%'");
    	
      	if($garbages){
          $k = \DB::select("SELECT `id` FROM `keywords` WHERE `name` = '$name'");
          if($k){
              \DB::update("UPDATE `keywords` SET `count` = count + 1 WHERE `name` = '$name'");
          }else{
              \DB::insert("INSERT INTO `keywords` (`name`, `count`) values ('$name', 1)");
          }
          //if(\DB::select("SELECT `id` FROM `keywords` WHERE `name` LIKE '%$name'")){
          //  \DB::delete("DELETE FROM `keywords` WHERE `name` = '$name'");
          //}
        }
      	return $garbages;
    }
}
