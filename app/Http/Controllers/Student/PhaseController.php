<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Phase;

class PhaseController extends Controller
{
    public function create($project_id)
    {
        $project=Project::find($project_id);
        return view('student.phases.new',compact('project'));
    }

    public function store($project_id,Request $request)
    {
        $fileName = time().'.'.$request->project_file->extension();
        $request->file('project_file')->move(public_path('uploads'), $fileName);
        Phase::create([
            'title' => $request->title,
            'project_id' => $project_id,
            'explaination' => $request->explaination,
            'file' => 'uploads/'.$fileName,
            'status' => 'pending'
        ]);
        return redirect('/student/projects/'.$project_id);
    }

    public function edit($project_id,$phase_id)
    {
        $project=Project::find($project_id);
        $phase=Phase::find($phase_id);
        return view('student.phases.new',compact('project','phase'));
    }

    public function update($project_id,$phase_id,Request $request)
    {
        $phase=Phase::find($phase_id);
        if($phase->status=='approved') {
            return redirect()->back()->withErrors(['این فاز توسط استاد تایید شده است و قابل ویرایش نمیباشد']);
        }
        else{
            Phase::where('id',$phase_id)->update([
                'title' => $request->title,
                'explaination' => $request->explaination
            ]);
            if(isset($request->project_file)){
                $fileName = time().'.'.$request->project_file->extension();
                $request->file('project_file')->move(public_path('uploads'), $fileName);
                Phase::where('id',$phase_id)->update([
                    'file' => 'uploads/'.$fileName
                ]);
            }
        }
        return redirect('student/projects/'.$project_id.'/phases/'.$phase_id)->withErrors('ویرایش شد');
    }

}
