<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->get();
        
        return view('company.company')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create-company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required:mimes:jpg,png,jpeg',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'location' => 'required|string',
            'phone' => 'required|string',
            'user_id' => 'exists:users,id',

        ]);
        

        $newImageName = time() . '.' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        
        Company::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'location' => $data['location'],
            'image' => $newImageName,
            'user_id' => $data['user_id']

        ]);

        return redirect('/companies');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        $employees = DB::table('employees')
                    ->where('company_id', '=', $id)->get();

        return view('company.company-details', compact('company', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit-company')->with('company', $company);
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
        $company = Company::find($id);
        $company->update($request->all());

        return redirect('/companies/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();

        return redirect('/companies');
    }
}
