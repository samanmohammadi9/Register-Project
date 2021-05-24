<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $teachers=Teacher::all();
        return view('student.messages.index',compact('teachers'));
    }

    public function chat($teacher_id)
    {
        $received=Message::where('type','t_s')->where('sender_id',auth('student')->user()->id)->where('receiver_id',$teacher_id)->get()->toArray();
        $sent=Message::where('type','s_t')->where('receiver_id',auth('student')->user()->id)->where('sender_id',$teacher_id)->get()->toArray();
        //array($sent);
        $messages=[];
        foreach(array_merge($sent,$received) as $item){
            $messages[$item['id']]=$item;
        }
        ksort($messages);
        $teacher=Teacher::find($teacher_id);
        return view('student.messages.chat',compact('teacher','messages'));
    }

    public function send($teacher_id,Request $request)
    {
        Message::create([
            'type' => 's_t',
            'sender_id' => auth('student')->user()->id,
            'receiver_id' => $teacher_id,
            'text' => $request->message,
            'status' => 'unread'
        ]);
        return redirect()->back();
    }
}
