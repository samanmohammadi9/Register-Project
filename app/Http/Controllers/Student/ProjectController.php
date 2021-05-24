<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects=Project::where('student_id',1)->get();
        return view('student.projects.list',compact('projects'));
    }

    public function create()
    {
        $teachers=Teacher::all();
        return view('student.projects.new',compact('teachers'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'teacher_name' => 'required',
            'description' => 'required',
            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required'
        ]);



        Project::create([
            'title' => $request->title,
            'teacher_name' => $request->teacher=='0'?$request->teacher_name:$request->teacher,
            'student_id' => 1,
            'description' => $request->description,
            'due_date' => $request->year.'/'.$request->month.'/'.$request->day,
            'status' => 'pending'
        ]);

        return redirect('/student/projects');
    }

    public function update_project($id,Request $request)
    {
        $project=Project::find($id);
        if($project->status=='approved'){
            return redirect()->back()->withErrors(['پروژه تایید شده توسط استاد قابل ویرایش نیست']);
        }
        $this->validate($request,[
            'title' => 'required',
            'teacher_name' => 'required',
            'description' => 'required',
            'day' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required'
        ]);

        Project::where('id',$id)->update([
            'title' => $request->title,
            'teacher_name' => $request->teacher=='0'?$request->teacher_name:$request->teacher,
            'student_id' => 1,
            'description' => $request->description,
            'due_date' => $request->year.'/'.$request->month.'/'.$request->day
        ]);

        return redirect('/student/projects/'.$id)->withErrors('ویرایش شد');
    }

    public function manage_project($id)
    {
        $teachers=Teacher::all();
        $project=Project::find($id);
        $phases=$project->phases;
        return view('student.projects.show',compact('project','phases','teachers'));
    }
}
