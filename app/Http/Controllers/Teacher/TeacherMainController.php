<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherMainController extends Controller
{
    public function main(){
        return view('teacher.teacher');
    }
}
