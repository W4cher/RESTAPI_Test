<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use App\tasks;

class tasksController extends Controller
{
    function list()
    {
        return tasks::all();
    }

    function add (Request $req)
    {
        $device = new tasks;
        $device ->title=$req->title;
        $device ->description=$req->description;
        $result = $device -> Save();

        if($result)
        {
            return ["result" => "Data has been saved"];
        }
        else
        {
            return ["result" => "falha na operação"];
        }
       
    }

    function update(Request $req)    
    {
        $device = tasks::find($req ->id);
        $device ->title=$req->title;
        $device ->description=$req->description;
        $result = $device -> Save();

        if($result)
        {
            return ["result" => "update has been saved"];
        }
        else
        {
            return ["result" => "falha actualizar dados"];
        }
       
    }
    
    function delete($id)    
    {
        $device = tasks::find($id);
        $result = $device ->delete();

        if($result)
        {
            return ["result" => "record has been delete"];
        }
        else
        {
            return ["result" => "delete operation is failed"];
        }
    }
}
