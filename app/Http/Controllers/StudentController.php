<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

    class StudentController extends Controller
{
    public function index(){
        return view('student.student');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'course' => 'required|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
           return response()->json([
            'status' => 400,
            'errors' => $validator->messages(),
           ]);
        }else{
            $student = new Student;
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->course = $request->input('course');
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('upload/students/',$filename);
                    $student->image = $filename;
                }
                $student->save();
                return response()->json([
                    'status' => 200,
                    'success' => 'Student created successfully',
                ]);
        }
        return view('student.student');
    }

    public function fetchStudent(){
        $students = Student::all();
        return response()->json([
            'students' => $students,
            'status' => 200.
        ]);
    }

    public function editStudent($id){
        $getStudentById = Student::find($id);
        if($getStudentById){
            return response()->json([
                'status' => 200,
                'data'=> $getStudentById,
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'error' => 'Student not found'
            ]);
        }
    }

    public function updateStudent(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'edit_name' => 'required|max:255',
            'edit_email' => 'required|max:255',
            'edit_phone' => 'required|max:255',
            'edit_course' => 'required|max:255',
        ]);

        if ($validator->fails()) {
           return response()->json([
            'status' => 400,
            'errors' => $validator->messages(),
           ]);
        }else{
            $student = Student::find($id);
            if($student){
                $student->name = $request->input('edit_name');
                $student->email = $request->input('edit_email');
                $student->phone = $request->input('edit_phone');
                $student->course = $request->input('edit_course');
            if($request->hasFile('edit_image')){
                if($student->image){
                    $oldImage = 'upload/students/'.$student->image;
                    if(File::exists($oldImage)){
                        File::delete($oldImage);
                    }
                }
                $file = $request->file('edit_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('upload/students/',$filename);
                $student->image=$filename;
            }
            $student->save();
            return response()->json([
                'status' => 200,
                'success' => 'Student updated successfully',
               ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'notFound' => 'Student Not Found',
                   ]);
            }

        }
        return view('student.student');
    }

    public function deleteStudent($id){
        $student = Student::find($id);
        if($student){
            if($student->image){
                $oldImage = 'upload/students/'.$student->image;
                if(File::exists($oldImage)){
                    File::delete($oldImage);
                }
            }
            $student->delete();
            return response()->json([
                'status' => 200,
                'success' => 'Deleted Successfully'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'notFound' => 'Incorrect Credentials. . . . .'
            ]);
        }

    }
}
