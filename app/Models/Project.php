<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','student_id','teacher_name','description','status','due_date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }
}
