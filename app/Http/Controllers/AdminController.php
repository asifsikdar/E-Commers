<?php

namespace App\Http\Controllers;

use App\sale;
use App\Charts\userchart;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   function admin(){
       $today_users = User::whereDate('created_at', today())->count();
       $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
       $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

       $chart = new userchart;
       $chart->labels(['2 days ago', 'Yesterday', 'Today']);
       $chart->dataset('User Report', 'pie', [$users_2_days_ago, $yesterday_users, $today_users])->options([
           'color' =>['#f911a8','#5bf911','yellow']
       ]);
       return view('asif/post/dashboard',compact('chart'));
   }

}
