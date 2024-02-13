<?php

namespace App\Http\Controllers;

use App\Models\student_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function students(){
        $student=student_info::all();
        if($student->count()>0){
            $data=[
                'status'=>'200',
                'students'=>$student
            ];
            return response()->json([$data],200);
        }
        else{
            $data=[
                'status'=>'404',
                'students'=>'No student found'
            ];
            return response()->json([$data],404);
        }
        
    }
    public function add(Request $request){
        $validated=Validator::make($request->all(),[
            'name'=>'required|unique:student_infos',
            'phone'=>'required|digits:10 |unique:student_infos',
            'reg_no'=>'required |unique:student_infos',
            'course'=>'required |unique:student_infos'
        ]);
        if($validated->fails()){
            $data=[
                'status'=>'422',
                'message'=>'something went wrong',
                'errors'=>$validated->messages()
            ];
            return response()->json($data,422);
        }
        else{
            $student=student_info::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'reg_no'=>$request->reg_no,
                'course'=>$request->course
            ]);
            if($student){
                $data=[
                    'status'=>'200',
                    'message'=>'Student added successfuly'
                ];
                return response()->json($data,200);
            }
        }
    }
    public function student($id){
        $student=student_info::find($id);
        if($student){
            $data=[
                'status'=>'200',
                'student'=>$student
            ];
            return response()->json($data,200);
        }
        else{
            $data=[
                'status'=>'404',
                'student'=>'No student found with that Id'
            ];
            return response()->json($data,404);
        }
    }
    public function edit($id){
        $student=student_info::find($id);
        if($student){
            $data=[
                'status'=>'200',
                'student'=>$student
            ];
            return response()->json($data,200);
        }
        else{
            $data=[
                'status'=>'404',
                'student'=>'No student found with that Id'
            ];
            return response()->json($data,404);
        }
    }
    public function update(Request $request,$id){
        $validated=Validator::make($request->all(),[
            'name'=>'required',
            'phone'=>'required|digits:10 ',
            'reg_no'=>'required',
            'course'=>'required'
        ]);
        if($validated->fails()){
            $data=[
                'status'=>'422',
                'errors'=>$validated->messages()
            ];
            return response()->json($data,422);
        }
        else{
            $student=student_info::find($id);
            if($student){
                $student->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'reg_no'=>$request->reg_no,
                'course'=>$request->course,
                ]);
                $data=[
                    'status'=>'200',
                    'message'=>'Student updated successfuly'
                ];
                return response()->json($data,200);
            }
            else{
                $data=[
                    'status'=>'404',
                    'message'=>'No student with that id'
                ];
                return response()->json($data,404);
            }
        }
    }
    public function delete($id){
        $student=student_info::find($id);
        if($student){
            $student->delete();
            $data=[
                'status'=>'200',
                'message'=>'Student deleted successfuly'
            ];
            return response()->json($data,200);
        }
        $data=[
            'status'=>'404',
            'message'=>'No student with that id'
        ];
        return response()->json($data,404);
    }
}
