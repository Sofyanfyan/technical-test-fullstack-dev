<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()) {
            $employee = Employee::with('position')->get();
            return datatables($employee)
                ->addIndexColumn()
                ->toJson();
        }
        return view('employee');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $position = Position::all();
        return view('employee.create')->with('position', $position);
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
         "position_id" => 'required|integer',
         "name"=> 'required|string',
         "nip"=> 'required|string',
         "alamat"=> 'required|string',
         "no_telp"=> 'required|string',
         "tahun_lahir" => 'required|date_format:Y',
         "agama"=> 'required|string',
         'path_image' => 'required|image|mimes:png,jpg'
      ]);

      if($validator->fails()){
         return $validator->errors();
         return redirect('/employee/create')->withErrors($validator)
                        ->withInput();;
      }


      $imageName = time().'_KTP_'.$request->name.'.'.$request->path_image->extension();  
      $request->path_image->move(public_path('images'), $imageName);

      Employee::create([
         "position_id" => $request->position_id,
         "name"=> $request->name,
         "NIP"=> $request->nip,
         "alamat"=> $request->alamat,
         "no_telp"=> $request->no_telp,
         "tahun_lahir"=> $request->tahun_lahir,
         "agama"=> $request->agama,
         "status" => true,
         'path_image' => $imageName
      ]);
      session()->flash('after_create');
      return redirect('/employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $data = Employee::with('position')->where('id', $employee->id)->first();

        return view('employee.detail')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = Employee::where('id', $request->id)->first();
        if (!$data) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        Employee::where('id', $request->id)->update([
         'status' => $employee->status == 1? 0 : 1,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {

        $employee = Employee::find($employee->id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        Employee::where('id', $employee->id)->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}