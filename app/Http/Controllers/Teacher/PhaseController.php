<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use App\Models\Project;
use Illuminate\Http\Request;

class PhaseController extends Controller
{
    public function approve($project_id,$phase_id)
    {
        $project=Project::find($project_id);
        if($project->teacher_name != auth('teacher')->user()->fullName){
            return redirect('/teacher/projects');
        }
        Phase::where('id',$phase_id)->update([
            'status' => 'approved'
        ]);
        return redirect('/teacher/projects/'.$project_id);
    }
}
