<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmitsController extends Controller
{
    public function create(Request $request)
    {
        $time = date("Y-m-d H:i:s");
        $res = \DB::insert("INSERT INTO `submits` (`name`, `created_at`, `updated_at`) values ('$request->name', '$time', '$time')");

        if ($res) {
            return response()->json([
                'code' => 1
            ]);
        } else {
            return response()->json([
                'code' => 0
            ]);
        }
    }
}
