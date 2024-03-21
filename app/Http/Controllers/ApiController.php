<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiParameter;
use App\Http\Responses\ApiResponse;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function syncData(Request $request)
    {
        $isStoreProcedure = $request['isStoreProcedure'];
        $sqlQuery = $request['sqlQuery'];
        $parameters = $request['parameters'];

        $response = new ApiResponse(true, 'success');

        try {
            if ($isStoreProcedure) {
                // $parmas = implode(',', $apiParam->parameters);
                // $data = DB::select('call getRecipeByCategory();', array($apiParam->parameters[0]));
                // $data = DB::select('CALL ' . $apiParam->sqlQuery . '(' . $parmas . ');');
                $result = DB::select("CALL $sqlQuery(?)", $parameters);
                $response->data = $result;
                $response->total = count($result);
            } else {
                // $data = DB::select($apiParam->sqlQuery);
                // $response->data = $data;
                // $response->total = count($data);
                $response = new ApiResponse(false, 'Not Implemented! Use StoreProcedure.');
                return response()->json($response, 501);
            }
        } catch (\Exception $e) {
            $response = new ApiResponse(false, $e->getMessage());
        }

        return response()->json($response);
    }
}
