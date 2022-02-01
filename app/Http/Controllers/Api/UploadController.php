<?php

namespace App\Http\Controllers\Api;

use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;

class UploadController extends Controller
{
    function index (Request $req)
    {
        $tasks = Task::latest()->get();
        return $tasks;
    }
    
    function create (Request $request)
    {
        $data = [];
        try {
            $data = $request->all();
            $task = Task::create($data);
            $data = [
                "status" => 200,
                "success" => true,
                "task" => $task,
            ] ;
        } catch (\Exception $ex) {
            $data = [
                "status" => 500,
                "success" => false,
                "error" => $ex,
            ] ;
        }

        return response()->json($data);
    }
}
