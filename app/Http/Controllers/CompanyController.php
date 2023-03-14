<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_type_id == 1) {
            return response()->json(Company::paginate(10), 200);
        }else{
            return response()->json(Company::where('id', auth()->user()->company_id)->paginate(10), 200);
        }
        
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

        if (auth()->user()->user_type_id == 1) {
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'director'=>'required',
                'address'=>'required',
                'email'=>'required|email',
                'website'=>'required',
                'phone'=>'required',
            ]);

            $company = Company::create($request->all());
            return response()->json($company, 201);
        }else{
            return response()->json('not allowed', 200);
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->user_type_id == 1) {
            return response()->json(Company::paginate(10), 200);
        }else{
            if (auth()->user()->company_id == $id) {
                return response()->json(Company::find($id), 200);
            }else{
                return response()->json('not allowed', 200);
            }
        }
        
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

        if (auth()->user()->user_type_id == 1) {
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'director'=>'required',
                'address'=>'required',
                'email'=>'required|email',
                'website'=>'required',
                'phone'=>'required',
            ]);
            $company = Company::find($id);
            $company->update($request->all());
            return response()->json($company, 200);
        }else{
            if (auth()->user()->company_id == $id) {

                $validator = Validator::make($request->all(), [
                    'name'=>'required',
                    'director'=>'required',
                    'address'=>'required',
                    'email'=>'required|email',
                    'website'=>'required',
                    'phone'=>'required',
                ]);
                $company = Company::find($id);
                $company->update($request->all());
                return response()->json($company, 200);

            }else{

                return response()->json('not allowed', 200);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->user_type_id == 1) {
            $company = Company::find($id);
            $company->delete();
            return response()->json(null, 204);
        }else{
            if (auth()->user()->company_id == $id) {
                $company = Company::find($id);
                $company->delete();
                return response()->json(null, 204);
            }else{
                return response()->json('not allowed', 200);
            }
        }
        
    }
}
