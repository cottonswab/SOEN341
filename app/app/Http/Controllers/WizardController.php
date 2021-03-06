<?php

namespace App\Http\Controllers;

use \App\Http\Traits\ScheduleTraits;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Schedule;

class WizardController extends Controller
{

  use ScheduleTraits;

  public function __construct(){
    return 'hello';
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      return redirect( 'wizard/title' );
    }

    /**
     * Show the form for creating a title.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_title(Request $request)
    {
      return view( 'wizard.title');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_title(Request $request)
    {
        $this->validate($request, [
          'title' => 'bail|required'
        ]);

        $user = Auth::user();
        $user->title = $request->title;
        $user->save();
        return redirect('wizard/course');
    }

    /**
     * Show the form for creating a course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_course()
    {
      return view( 'wizard.course');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_course(Request $request)
    {
        $user = Auth::user();
        $this->addCourses(request('add_course_ids'));
        return redirect('wizard/schedule');
    }

    /**
     * Show the form for creating a course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_schedule()
    {
      return view( 'wizard.schedule');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_schedule(Request $request)
    {
        $user = Auth::user();
        $user->setup = true;
        $user->save();
        $this->schedule_store($request);
        return redirect('home');
    }

}
