<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use App\Notifications\WelcomeEmail;

class EmployeeController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $company_id = $id;

        return view('employee.create-employee')->with('company_id', $company_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->input('company_id');

        $data = $request->validate([
           
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'company_id' => 'exists:companies,id',
            'image' => 'required:mimes:jpg,png,jpeg',
            'password' => [
                'required',
               Password::min(8)->mixedCase()->numbers()->symbols()
           ]

        ]);
        $newImageName = time() . '.' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        
        $employee = Employee::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' =>bcrypt($data['password']),
            'image' => $newImageName,
            'company_id' => $data['company_id']
        ]);

        $employee->notify(new WelcomeEmail());

       
        
        return redirect('/companies/'.$id);

        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        return view('employee.edit-employee')->with('employee', $employee);
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
        $company_id = $request->input('company_id');

        $employee = Employee::find($id);
        $data = $request->validate([
           
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'company_id' => 'exists:companies,id',
            'image' => 'required:mimes:jpg,png,jpeg',
            'password' => [
                'required',
               Password::min(8)->mixedCase()->numbers()->symbols()
           ]

        ]);
        $newImageName = time() . '.' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        

        $employee->update($data);

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
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->back();
    }
}
