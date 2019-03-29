<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    public function fetchFilters(Request $request) {
        $data = [
            'Chevrolet',
            'Honda',
            'Isuzu'
        ];
        return response()->json($data);
    }
}
