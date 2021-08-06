<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodosRequest;
use Illuminate\Http\Request;
use App\Models\Todos;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todos::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\TodosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodosRequest $request)
    {
       $validated = $request->validated();

        return Todos::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todos::find($id);

        if($todo)
            return $todo;
        else
            return json_encode(["error" => "Todo doesn't exist"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\TodosRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodosRequest $request, $id)
    {
        $todo = Todos::find($id);

        if($todo)
            return $todo->update($request->all());
        else
            return json_encode(["error" => "Todo doesn't exist"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Todos::destroy($id);
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  str  $description
     * @return \Illuminate\Http\Response
     */
    public function search($description)
    {
        return Todos::where('description', 'LIKE', '%'.$description.'%')->get();
    }
}
