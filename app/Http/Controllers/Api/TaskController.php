<?php

namespace App\Http\Controllers\Api;

use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    function index (Request $req)
    {
        $tasks = Task::latest()->get();
        return $tasks;
    }

    function show (Request $req, $id)
    {
        $task= Task::find($id);
        $data = [
            "status" => 200,
            "success" => true,
            "task" => $task,
        ] ;
        return $data;
    }
    
    function create (Request $request)
    {
        dd($request->all());
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

    function update(Request $request, $id)    
    {
        $data = [];

        try {
            $data = $request->all();
            $task = Task::find($id);
            $task = $task->update($data);
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
    
    function delete($id)    
    {
        $data = [];
        try {
            $task = Task::find($id);
            $task->delete();
            $data = [
                "status" => 200,
                "success" => true,
            ];
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
