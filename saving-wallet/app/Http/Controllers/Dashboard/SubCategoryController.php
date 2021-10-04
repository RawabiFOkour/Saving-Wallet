<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $user= auth()->user()->id;
        $incomeTransactions = $request->incomeTransactions;
        $expenseTransactions = $request->expenseTransactions;

        $incomeTransactionsArray =  array_map(function ($incomeTransaction ) use ($user) {
            $incomeTransaction['category_id']=1;
            $incomeTransaction['user_id']= $user;
            return $incomeTransaction ;
        }, $incomeTransactions ?? []);

        $expenseTransactionArray =  array_map(function ($expenseTransaction) use ($user) {
            $expenseTransaction['category_id']=2;
            $expenseTransaction['user_id']= $user;
            return $expenseTransaction;
        },  $expenseTransactions ?? []);

       $totalIncomes = collect($incomeTransactions)->sum('amount');
       $totalExpenses = collect($expenseTransactions)->sum('amount');

        $mergedArray = array_merge( $incomeTransactionsArray ,$expenseTransactionArray);

        $totalIncomesDB= User::where('id',$user)->select('total_income')->get()[0]['total_income'] + $totalIncomes;
        $totalExpensesDB = User::where('id',$user)->select('total_expenses')->get()[0]['total_expenses'] + $totalExpenses;
        $wallet_query = User::where('id',$user)->select('wallet_balance')->get()[0]['wallet_balance'];

        $walletDB = $wallet_query ;

        $wallet = abs($totalIncomesDB - $totalExpensesDB);

        ($totalExpenses > $walletDB  &&  $totalExpensesDB >= $totalIncomesDB ) ?  null : SubCategory::insert($mergedArray) ;

       if( ($totalExpenses > $walletDB  && $totalExpensesDB >= $totalIncomesDB )) {

           User::where('id',$user)->update([
               'total_income' => $totalIncomesDB,
           ]);

        } else {

           User::where('id', $user)->update([
               'total_income' => $totalIncomesDB,
               'total_expenses' => $totalExpensesDB,
               'wallet_balance' => $wallet,
           ]);

       }

        if( ($totalExpenses > $walletDB  &&  $totalExpensesDB >= $totalIncomesDB )) {

            return redirect()->route('user')->with('failed','Can\'t Add Expenses');

        } else{

           return redirect()->route('user')
                ->with('success','Your Transactions Added Successfully');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'=> ['string', 'max:5'],
            'amount'=> ['integer'],
            'note'=> ['string', 'max:30'],
        ]);
    }
}
