<?php

namespace App\Http\Controllers;

use App\Company;
use App\DataTables\CompanyDataTable;
use App\DataTables\EmployeeDataTable;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Laravel\Ui\Presets\React;
use DataTables;

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
    public function index(Request $request, CompanyDataTable $dataTable)
    {
        $user = $request->user();
        if ($request->ajax()) {
            $data = Company::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
         
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return $dataTable->render('company.company');
        //
        //$companies = Company::where('user_id', $user->id)->latest()->get();
        //return view('company.company')->with('companies', $companies);
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
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'image' => 'required:mimes:jpg,png,jpeg',
            'user_id' => 'exists:users,id',

        ]);
        

        $newImageName = time() . '.' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        
        Company::create([
            'name' => $data['name'],
            'address' => $data['address'],
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
    public function show($id, EmployeeDataTable $dataTable)
    {
        $company = Company::find($id);

        /* $employees = DB::table('employees')
                    ->where('company_id', '=', $id)->get();

        return view('company.company-details', compact('company', 'employees')); */
        return $dataTable->render('company.company-details');
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'image' => 'required:mimes:jpg,png,jpeg',
            'user_id' => 'exists:users,id',

        ]);
        

        $newImageName = time() . '.' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        

        $company->update($data);

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
