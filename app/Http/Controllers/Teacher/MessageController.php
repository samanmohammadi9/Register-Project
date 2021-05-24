<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $students=Student::all();
        return view('teacher.messages.index',compact('students'));
    }

    public function chat($student_id)
    {
        $sent=Message::where('type','t_s')->where('sender_id',auth('teacher')->user()->id)->where('receiver_id',$student_id)->get()->toArray();
        $received=Message::where('type','s_t')->where('receiver_id',auth('teacher')->user()->id)->where('sender_id',$student_id)->get()->toArray();
        //array($sent);
        $messages=[];
        foreach(array_merge($sent,$received) as $item){
            $messages[$item['id']]=$item;
        }
        ksort($messages);
        $student=Student::find($student_id);
        return view('teacher.messages.chat',compact('student','messages'));
    }

    public function send($student_id,Request $request)
    {
        Message::create([
            'type' => 't_s',
            'sender_id' => auth('teacher')->user()->id,
            'receiver_id' => $student_id,
            'text' => $request->message,
            'status' => 'unread'
        ]);
        return redirect()->back();
    }
}
