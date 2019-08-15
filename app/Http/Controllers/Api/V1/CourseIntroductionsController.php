<?php

namespace App\Http\Controllers\Api\V1;

use App\CourseIntroduction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseIntroductionsRequest;
use App\Http\Requests\Admin\UpdateCourseIntroductionsRequest;

class CourseIntroductionsController extends Controller
{
    public function index()
    {
        return CourseIntroduction::all();
    }

    public function show($id)
    {
        return CourseIntroduction::findOrFail($id);
    }

    public function update(UpdateCourseIntroductionsRequest $request, $id)
    {
        $course_introduction = CourseIntroduction::findOrFail($id);
        $course_introduction->update($request->all());
        

        return $course_introduction;
    }

    public function store(StoreCourseIntroductionsRequest $request)
    {
        $course_introduction = CourseIntroduction::create($request->all());
        

        return $course_introduction;
    }

    public function destroy($id)
    {
        $course_introduction = CourseIntroduction::findOrFail($id);
        $course_introduction->delete();
        return '';
    }
}
