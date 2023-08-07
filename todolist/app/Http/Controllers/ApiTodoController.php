<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class ApiTodoController extends Controller
{
    public function getList(Request $request){

        //dd($request->input('search'));
        $data = Todo::all();
         if ($request->has('search')) {
            $data = Todo::where('content', 'like', '%' . $request->input('search') . '%')->get();
            return response()->json($data);
        }
  
        return response()->json($data);
    }

    public function postList(Request $request){
        Todo::create($request->all());

        return response()->json(['status' => true, 'message' => 'Data sukses di buat!']);
    }

    public function updateList(Request $request, $id){
        $data = Todo::find($id);
        $data->update($request->all());

        return response()->json(['status' => true, 'message' => 'Data sukses di update']);
    }
    public function deleteList($id){
        $data = Todo::find($id);
        $data->delete($id);

        return response()->json(['status' => true, 'message' => 'Data sukses hapus']);
    }
    public function showList($id){
        $data = Todo::find($id);

        return response()->json($data);
    }
}