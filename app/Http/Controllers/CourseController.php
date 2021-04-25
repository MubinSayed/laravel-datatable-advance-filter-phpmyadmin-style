<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Array having field name as key and column name as value for filter
            $this->filterFieldArray = [
                'course_name' => 'name',
                'course_code' => 'code',
            ];
            DB::statement(DB::raw('set @rownum=0'));
            $course = Course::select([
                '*',
                DB::raw('@rownum  := @rownum  + 1 AS rownum'), /* increment rownum by 1, for each record */
            ]);
            return Datatables::of($course)
                ->filter(function ($query) {
                    foreach ($this->filterFieldArray as $field => $column) {

                        if (request($field . "_operator") == "=''" || request($field . "_operator") == "!=''") {
                            datatableFilterQuery($query, $column, request($field . '_operator'), request($field), request($field . '_from'), request($field . '_to'));
                        } else if (request()->has($field) && (!empty(request($field)) || !empty(request($field . '_from')))) {
                            datatableFilterQuery($query, $column, request($field . '_operator'), request($field), request($field . '_from'), request($field . '_to'));
                        }
                    }
                })

                ->toJson();
            // ->make(true);
        }

        return view('welcome');
    }
}
