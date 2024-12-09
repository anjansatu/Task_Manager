<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BaseController extends Controller
{
    public function responseSuccess($msg = null, $data = [], $code = 200)
    {
        $msg = is_null($msg) ? __("Operation Successful") : $msg;

        return response()->json([
            'status' => true,
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ], $code);
    }

    public function responseHtml($html)
    {
        return response()->json([
            'status' => true,
            'code' => 200,
            'html' => $html
        ], 200);
    }


    public function responseError($msg = null, $code = 500, $data = [])
    {
        $msg = is_null($msg) ? __("Operation Failed") : $msg;

        return response()->json([
            'status' => false,
            'code' => $code,
            'error' => $msg,
            'data' => $data
        ], 200);
    }

    public function responseException($ex)
    {
        if($ex instanceof ModelNotFoundException) {
            $msg = __("Requested Resource Not Found");
            $code = 404;
        } else if($ex instanceof ValidationException) {
            $msg = $ex->getMessage();
            $code = 422;
        } else if($ex instanceof CustomException) {
            $msg = $ex->getMessage();
            $code = 500;
        } else {
            \Log::error($ex->getMessage());
            $msg = __("Something Went Wrong");
            $code = 500;
        }

        return response()->json([
            'status' => false,
            'code' => $code,
            'error' => $msg,
        ], $code);
    }

    public function sessionSuccess($msg = null, $route = null, $input = [])
    {
        $msg = is_null($msg) ? __("Operation Successful") : $msg;

        if(!is_null($route)) {
            return redirect()->route($route)->with('success', $msg)->withInput($input);
        } else {
            return redirect()->back()->with('success', $msg)->withInput($input);
        }
    }

    public function sessionError($msg = null, $input = [], $route = null)
    {
        $msg = is_null($msg) ? __("Operation Failed") : $msg;

        if(!is_null($route)) {
            return redirect()->route($route)->with('error', $msg)->withInput($input);
        } else {
            return redirect()->back()->with('error', $msg)->withInput($input);
        }
    }

    public function sessionException($ex, $input = [], $route = null)
    {
        if($ex instanceof ModelNotFoundException) {
            $msg = __("Requested Resource Not Found");
        } elseif($ex instanceof ValidationException) {
            $msg = $ex->getMessage();
        } else if($ex instanceof CustomException) {
            $msg = $ex->getMessage();
        } else {
            \Log::error($ex->getMessage());
            $msg = __("Something Went Wrong");
        }

        if(!is_null($route)) {
            return redirect()->route($route)->with('error', $msg)->withInput($input);
        } else {
            return redirect()->back()->with('error', $msg)->withInput($input);
        }
    }
}

