<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    protected function api_ok()
    {
        return '';
    }

    protected function api_fail($jsonMsg = null, $code = 200)
    {
        if (is_null($jsonMsg)) {
            return response('', $code);
        } else {
            return response()->json($jsonMsg, $code);
        }
    }
}
