<?php

namespace App\Http\Controllers;

use App\Entities\Task;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Task $tasks)
    {   
        $this->middleware('auth');
        config(['site.menu' => 'dashboard']);
        $this->tasks = $tasks;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $dn = \Carbon\Carbon::now();
        $tasks = $this->tasks->where('user_id', auth()->user()->id )->where('status', 1)->whereBetween('date', [$dn->subHour()->format('Y-m-d H:i:s'), $dn->addHour()->format('Y-m-d H:i:s')])->get();
        return view('dashboard.main', compact('tasks'));
    }
}
