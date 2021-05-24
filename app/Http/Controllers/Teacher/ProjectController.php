<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //

    public function new_projects()
    {
        $projects=Project::where('teacher_name',auth('teacher')->user()->fullName)->where('status','pending')->get();
        return view('teacher.projects.list',compact('projects'));
    }

    public function projects()
    {
        $projects=Project::where('teacher_name',auth('teacher')->user()->fullName)->get();
        return view('teacher.projects.list',compact('projects'));
    }

    public function show($id)
    {
        $project=Project::find($id);
        $student=$project->student;
        $phases=$project->phases;
        return view('teacher.projects.show',compact('project','student','phases'));
    }

    public function approve($id)
    {
        Project::where('id',$id)->update([
            'status' => 'approved'
        ]);
        return redirect('/teacher/newprojects');
    }
}
