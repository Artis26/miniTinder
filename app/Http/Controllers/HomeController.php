<?php

namespace App\Http\Controllers;

use App\Jobs\WithoutQueue;
use App\Jobs\WithQueue;
use App\Models\Filter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/user/user');
    }

    public function welcome(): view {
        $filter = Filter::where('user_id', auth()->id())->first();
        return view('welcome', [
            'filter' => $filter
        ]);
    }

    public function withoutQueue() {
        var_dump("Below should be: without queue");
        WithoutQueue::dispatch();
    }

    public function withQueue() {
        var_dump("WITH QUEUE");
        WithQueue::dispatch();
    }
}
