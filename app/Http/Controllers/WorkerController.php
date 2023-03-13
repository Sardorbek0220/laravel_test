<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Worker;
use Validator;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Worker::paginate(10), 200);
        // return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'passport'=>'required',
            'firstname'=>'required',
            'secondtname'=>'required',
            'lastname'=>'required',
            'position'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'company_id'=>'required',
        ]);
        $worker = Worker::create($request->all());
        return response()->json($worker, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Worker::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'passport'=>'required',
            'firstname'=>'required',
            'secondname'=>'required',
            'lastname'=>'required',
            'position'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'company_id'=>'required',
        ]);
        $worker = Worker::find($id);
        $worker->update($request->all());
        return response()->json($worker, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = Worker::find($id);
        $worker->delete();
        return response()->json(null, 204);
    }
}
