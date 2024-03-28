<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class UpdateController extends Controller
{
    
    public function put(Request $request, $id){
      
      try {
         DB::beginTransaction();
         $validator = Validator::make($request->all(), [
            "position_id" => 'required|integer',
            "name"=> 'required|string',
            "nip"=> 'required|string',
            "alamat"=> 'required|string',
            "no_telp"=> 'required|string',
            "tahun_lahir" => 'required|date_format:Y',
            "agama"=> 'required|string',
            'path_image' => 'nullable|image|mimes:png,jpg'
         ]);
         
         if($validator->fails()){
            DB::rollBack();
            return $validator->errors();
            return redirect('/employee/'.$id.'/edit')->withErrors($validator)
            ->withInput();;
         }
         
         $arrUpdate = [
            "position_id" => $request->position_id,
            "name"=> $request->name,
            "NIP"=> $request->nip,
            "alamat"=> $request->alamat,
            "no_telp"=> $request->no_telp,
            "tahun_lahir"=> $request->tahun_lahir,
            "agama"=> $request->agama,
         ];
         
         if($request->path_image){
            $imageName = time().'_KTP_'.$request->name.'.'.$request->path_image->extension();  
            $request->path_image->move(public_path('images'), $imageName);
            $arrUpdate["path_image"] = $imageName;
         } 
             
         Employee::where('id', $id)->update($arrUpdate);
         DB::commit();
         return redirect('/employee');
      } catch (Exception $err) {
         DB::rollBack();
         return dd($err);
      }
      
    }
}