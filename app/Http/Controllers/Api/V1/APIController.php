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

        $query_src = ' FROM applications';
        $col_index = 0;
        foreach ($input as $col => $value) {
            if ($col_index == 0) {
                $query_src .= ' WHERE';
            } else {
                $query_src .= ' AND';
            }
            $query_src .= ' `'.$col.'` LIKE "%'.$value.'%"';
            $col_index ++;
        }

        $filters = array();
        foreach ($output as $col) {
            $query = 'SELECT distinct `'.$col.'`'.$query_src;
            if ($col == 'Year') {
                $query .= ' ORDER BY `'.$col.'` desc';
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

    public function fetchApplications(Request $request) {
        $filters = $request->filters;
        $limit = $request->limit;
        $sort = $request->sort;

        $query_src = ' FROM applications';
        $col_index = 0;
        foreach ($filters as $col => $value) {
            if ($col_index == 0) {
                $query_src .= ' WHERE';
            } else {
                $query_src .= ' AND';
            }
            $query_src .= ' `'.$col.'` LIKE "%'.$value.'%"';
            $col_index ++;
        }
        $query_limit = '';
        if (isset($limit)) {
            $query_limit = ' LIMIT '.$limit['offset'].', '.$limit['count'];
        }
        $query_sort = '';
        if (isset($sort) && $sort['sort_by'] != null && $sort['sort_dir'] != null) {
            $query_sort = ' ORDER BY `'.$sort['sort_by'].'` '.$sort['sort_dir'];
        }

        $query = 'SELECT COUNT(*) '.$query_src;
        $result = DB::select($query);
        $length = json_decode(json_encode($result[0]), true)['COUNT(*)'];

        $query = 'SELECT * '.$query_src.$query_sort.$query_limit;
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => $length,
            'query' => $query,
        ));
    }

    public function fetchParts(Request $request) {
        $partNumber = $request->partNumber;
        $limit = $request->limit;

        $query_src = ' FROM parts';
        $query_src .= ' WHERE Part_Number LIKE "%'.$partNumber.'%"';
        $query_limit = ' LIMIT '.$limit['offset'].', '.$limit['count'];

        $query = 'SELECT COUNT(*) '.$query_src;
        $result = DB::select($query);
        $length = json_decode(json_encode($result[0]), true)['COUNT(*)'];

        $query = 'SELECT * '.$query_src.$query_limit;
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => $length,
            'query' => $query,
        ));
    }
    public function fetchInterchanges(Request $request) {
        $xRef = $request->xRef;
        $limit = $request->limit;

        $query_src = ' FROM interchanges LEFT JOIN parts ON(interchanges.Part_Target_ID = parts.Part_ID)';
        $query_src .= ' WHERE Interchange_Part_Number LIKE "%'.$xRef.'%"';
        $query_limit = ' LIMIT '.$limit['offset'].', '.$limit['count'];

        $query = 'SELECT COUNT(*) '.$query_src;
        $result = DB::select($query);
        $length = json_decode(json_encode($result[0]), true)['COUNT(*)'];

        $query = 'SELECT interchanges.*, parts.Part_Number '.$query_src.$query_limit;
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => $length,
            'query' => $query,
        ));
    }
}
