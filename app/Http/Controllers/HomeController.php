<?php

namespace App\Http\Controllers;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        $chart_options = [


            'chart_title' => 'Proyectos por usuario',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Project',
            'chart_color' =>'241, 91, 138','241, 91, 138',
        
            'relationship_name' => 'user', // represents function user() on Project model
            'group_by_field' => 'name', // users.name
            
            'filter_field' => 'deadline',
            'filter_days' => 30, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];
        $chart = new LaravelChart($chart_options);
    
        $chart_options = [
            'chart_title' => 'Tareas',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Task',
            'chart_color' =>'255, 159, 64','241, 91, 138',
        
            'relationship_name' => 'user', // represents function user() on Project model
            'group_by_field' => 'name', // users.name
            
            'filter_field' => 'deadline',
            'filter_days' => 30, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];
        $chart1 = new LaravelChart($chart_options);
        
        return view('home', compact('chart','chart1','users'));
        }
    }

