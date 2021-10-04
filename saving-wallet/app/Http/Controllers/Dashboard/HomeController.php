<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
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
        $categories = Category::all();
        $userDetails = User::select('total_expenses','total_income','wallet_balance')->where('id',auth()->user()->id)->get();
        return view('saving_wallet.user',compact('categories','userDetails'));
    }

    public function adminIndex()
    {
        $getAllUsersInfo = User::select('*')->get();

        return view('saving_wallet.admin',compact('getAllUsersInfo'));
    }

    public function getAllUserTransactions()
    {
        $allUserTransactions = SubCategory::select('*')->where('user_id',auth()->user()->id)->get();

        return view('saving_wallet.get_user_transactions',compact('allUserTransactions'));
    }

}
