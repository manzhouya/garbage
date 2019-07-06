<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GarbageController extends Controller
{
    public function show($name = null)
    {
        $name = trim($name);
        if (!$name) {
            return [];
        }
        $garbages = \DB::select("SELECT `garbages`.`name` AS `name`, `categories`.`name` AS `category`, `categories`.`style` AS `category_style` FROM `garbages` JOIN `categories` ON `garbages`.`category_id` = `categories`.`id` WHERE `garbages`.`name` LIKE '%$name%'");

        if ($garbages) {
            $time = date("Y-m-d H:i:s");
            $k = \DB::select("SELECT `id` FROM `keywords` WHERE `name` = '$name'");
            if ($k) {
                \DB::update("UPDATE `keywords` SET `count` = count + 1 WHERE `name` = '$name'");
            } else {
                \DB::insert("INSERT INTO `keywords` (`name`, `count`, `created_at`, `updated_at`) values ('$name', 1, '$time', '$time')");
            }
        }

        return $garbages;
    }

    public function index()
    {
//        $garbages = json_decode(Redis::get('garbages'));
//        if (!$garbages) {
//            $garbages = \DB::select("SELECT * FROM `garbages`");
//            Redis::set('garbages', json_encode($garbages));
//        }

        $garbages = Cache::remember('garbages', 24 * 60 * 60 * 7, function () {
            return \DB::select("SELECT * FROM `garbages`");
        });

        return $garbages;
    }
}
