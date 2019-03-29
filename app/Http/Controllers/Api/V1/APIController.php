<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function fetchFilters(Request $request) {
        $input = $request->input;
        $output = $request->output;

        $query_src = ' from applications';
        $col_index = 0;
        foreach ($input as $col => $value) {
            if ($col_index == 0) {
                $query_src .= ' where';
            } else {
                $query_src .= ' and';
            }
            $query_src .= ' `'.$col.'` like "%'.$value.'%"';
            $col_index ++;
        }

        $filters = array();
        foreach ($output as $col) {
            $query = 'select distinct `'.$col.'`'.$query_src;
            if ($col == 'Year') {
                $query .= ' order by `'.$col.'` desc';
            }
            $result = DB::select($query);
            $result = json_decode(json_encode($result), true);

            $filters[$col] = array();
            foreach ($result as $res) {
                array_push($filters[$col], $res[$col]);
            }
        }

        return response()->json($filters);
    }
}
