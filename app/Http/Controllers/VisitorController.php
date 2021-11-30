<?php

namespace App\Http\Controllers;

use App\Helpers\VisitorHelper;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $userInfo = $request->input('user_info');
        VisitorHelper::storeVisitor($userInfo);
        return response()->json(['message' => 'Successfully Created',200]);
    }

}
