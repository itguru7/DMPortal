<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function fetchSubdomainID(Request $request) {
        $vendor = $request->Vendor;

        $query = 'SELECT SubdomainID FROM subdomains WHERE Vendor LIKE "%'.$vendor.'%" LIMIT 1';

        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        if (sizeof($data) == 1) {
            $data = $data[0]['SubdomainID'];
        } else {
            $data = 0;
        }

        return response()->json(array(
            'data' => $data,
            'query' => $query,
        ));
    }

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
            if ($col == 'Subdomain_ID') {
                $query_src .= ' `'.$col.'` = '.$value;
            } else {
                $query_src .= ' `'.$col.'` LIKE "%'.$value.'%"';
            }
            $col_index ++;
        }

        $filters = array();
        foreach ($output as $col) {
            $query = 'SELECT distinct `'.$col.'`'.$query_src;
            if ($col == 'Year') {
                $query .= ' ORDER BY `'.$col.'` desc';
            } else {
                $query .= ' ORDER BY `'.$col.'` asc';
            }
            $result = DB::select($query);
            $result = json_decode(json_encode($result), true);

            $filters[$col] = array();
            foreach ($result as $res) {
                array_push($filters[$col], $res[$col]);
            }
        }

        return response()->json(array(
            'data' => $filters,
            'query' => $query,
        ));
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
            if ($col == 'Subdomain_ID') {
                $query_src .= ' `'.$col.'` = '.$value;
            } else {
                $query_src .= ' `'.$col.'` LIKE "%'.$value.'%"';
            }
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

        $query = 'SELECT COUNT(*)'.$query_src;
        $result = DB::select($query);
        $length = json_decode(json_encode($result[0]), true)['COUNT(*)'];

        $query = 'SELECT *'.$query_src.$query_sort.$query_limit;
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => $length,
            'query' => $query,
        ));
    }

    public function fetchParts(Request $request) {
        $subdomainID = $request->Subdomain_ID;
        $partNumber = $request->partNumber;
        $limit = $request->limit;

        $query_src = ' FROM parts WHERE Subdomain_ID = '.$subdomainID.' and Part_Number LIKE "'.$partNumber.'%"';
        $query_limit = ' LIMIT '.$limit['offset'].', '.$limit['count'];

        $query = 'SELECT COUNT(*)'.$query_src;
        $result = DB::select($query);
        $length = json_decode(json_encode($result[0]), true)['COUNT(*)'];

        $query = 'SELECT *'.$query_src.$query_limit;
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => $length,
            'query' => $query,
        ));
    }
    public function fetchInterchanges(Request $request) {
        $subdomainID = $request->Subdomain_ID;
        $xRef = $request->xRef;
        $limit = $request->limit;

        $query_src = ' FROM interchanges WHERE Subdomain_ID = '.$subdomainID.' and Interchange_Part_Number LIKE "'.$xRef.'%"';
        $query_limit = ' LIMIT '.$limit['offset'].', '.$limit['count'];

        $query = 'SELECT COUNT(*)'.$query_src;
        $result = DB::select($query);
        $length = json_decode(json_encode($result[0]), true)['COUNT(*)'];

        $query = 'SELECT *'.$query_src.$query_limit;
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => $length,
            'query' => $query,
        ));
    }
    public function fetchAssets(Request $request) {
        $partID = $request->Part_ID;

        $query_src = ' FROM assets WHERE Part_Target_ID = '.$partID;

        $query = 'SELECT *'.$query_src.' ORDER BY Asset_Order asc';
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => sizeof($data),
            'query' => $query,
        ));
    }
    public function fetchInformation(Request $request) {
        $partID = $request->Part_ID;

        $query_src = ' FROM information WHERE Part_Target_ID = '.$partID;

        $query = 'SELECT *'.$query_src.' ORDER BY Information_Order asc';
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => sizeof($data),
            'query' => $query,
        ));
    }
    public function fetchAttributes(Request $request) {
        $partID = $request->Part_ID;

        $query_src = ' FROM attributes WHERE Part_Target_ID = '.$partID;

        $query = 'SELECT *'.$query_src.' ORDER BY Attribute_Order asc';
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => sizeof($data),
            'query' => $query,
        ));
    }
    public function fetchBuyerGuide(Request $request) {
        $partID = $request->Part_ID;
        $limit = $request->limit;

        $query_src = ' FROM buyers_guide WHERE Part_Target_ID = '.$partID;
        $query_limit = ' LIMIT '.$limit['offset'].', '.$limit['count'];

        $query = 'SELECT COUNT(*)'.$query_src;
        $result = DB::select($query);
        $length = json_decode(json_encode($result[0]), true)['COUNT(*)'];

        $query = 'SELECT *'.$query_src.' ORDER BY Buyers_Guide_Order asc'.$query_limit;
        $result = DB::select($query);
        $data = json_decode(json_encode($result), true);

        return response()->json(array(
            'data' => $data,
            'length' => $length,
            'query' => $query,
        ));
    }
}
