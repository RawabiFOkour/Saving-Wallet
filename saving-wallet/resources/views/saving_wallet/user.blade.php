@extends('adminlte::page')

@section('title', 'Saving Wallet(User)')

@section('content_header')
    <h1 class="m-0 text-dark">Add Your Transactions</h1>
    <br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif($message = Session::get('failed'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>

    @endif

    <div class="row">
        <div class="m-2 mr-5">
        <a href="{{route('user.all_transactions')}}">
            <button type="button" class="btn btn-primary btn-rounded"></i> Get All Your Transactions</button>
        </a>
        </div>
{{--        @dd($userDetails[0]['total_expenses'])--}}
        <div class="m-2 mr-5">
            <label>Total Income</label>
            <div class="bg-info p-2">{{$userDetails[0]['total_income']}}</div>
        </div>
        <div class="m-2 mr-5">
            <label>Total Expense</label>
            <div class="bg-info p-2">{{$userDetails[0]['total_expenses']}}</div>
        </div>
        <div class="m-2 mr-5">
            <label>Wallet Balance</label>
            <div class="bg-info p-2">{{$userDetails[0]['wallet_balance']}}</div>
        </div>


    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form id="formAddTransactions" method="post" action="{{route('subCategories.store')}}">
                    @csrf
                    <div class="card-body">
                        @foreach($categories as $category)
                            <div class="d-flex justify-content-between">
                                <h5 class="">{{$category->name}}</h5>
                                <div>
                                    <button type="button"
                                            onclick="@if($category->id == 1 ) addIncomeTransactions(); @else  addExpenseTransactions(); @endif"
                                            class="btn btn-info btn-rounded"><i class="fas fa-plus"></i>
                                        Add {{$category->name}}</button>
                                </div>
                            </div>
                            @if($category->id == 1 )
                                <div id="transactions_1">
                                </div>
                            @else
                                <div id="transactions_2">
                                </div>
                            @endif
                            <hr>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-around mb-5 mt-3">
                        <button type="submit" class="btn btn-info ">Add Your Transactions</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $(document).ready(function() {
        console.log('hh');
        var categoryIncomeTransactionsIndex = 100;

        function addIncomeTransactions() {
            console.log('ddddd');
            categoryIncomeTransactionsIndex++;
            var transactions =
                '<div class="row d-flex justify-content-start">' +
                '<div class="row">' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label class="control-label"><b>Transaction Name</b></label>' +
                '<input type="text" name="incomeTransactions[' + categoryIncomeTransactionsIndex + '][name]" id="name" class="form-control" placeholder="Enter Transaction Name">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label class="control-label"><b>Amount</b></label>' +
                '<input type="text" name="incomeTransactions[' + categoryIncomeTransactionsIndex + '][amount]" id="amount" class="form-control" placeholder="Enter Amount">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label class="control-label"><b>Note</b></label>' +
                '<input type="text" name="incomeTransactions[' + categoryIncomeTransactionsIndex + '][note]" id="note" class="form-control" placeholder="Enter Note">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2 cl-delete">' +
                '<label class="control-label"><b>Actions</b></label><br>' +
                '<a class="btn btn-danger btn-circle" title="Delete"><i class="fa fa-trash"></a>' +
                '</div>' +
                '</div>';
            $('#transactions_1').append(transactions);
        }

        function addExpenseTransactions() {
            console.log('ddddd');
            categoryIncomeTransactionsIndex++;
            var transactions =
                '<div class="row d-flex justify-content-start">' +
                '<div class="row">' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label class="control-label"><b>Transaction Name</b></label>' +
                '<input type="text" name="expenseTransactions[' + categoryIncomeTransactionsIndex + '][name]" id="name" class="form-control" placeholder="Enter Transaction Name">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label class="control-label"><b>Amount</b></label>' +
                '<input type="text" name="expenseTransactions[' + categoryIncomeTransactionsIndex + '][amount]" id="amount" class="form-control" placeholder="Enter Amount">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<label class="control-label"><b>Note</b></label>' +
                '<input type="text" name="expenseTransactions[' + categoryIncomeTransactionsIndex + '][note]" id="note" class="form-control" placeholder="Enter Note">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2 cl-delete">' +
                '<label class="control-label"><b>Actions</b></label><br>' +
                '<a class="btn btn-danger btn-circle" title="Delete"><i class="fa fa-trash"></a>' +
                '</div>' +
                '</div>';

            $('#transactions_2').append(transactions);
        }

        // });

        $(document).on('click', 'div .cl-delete', function () {
            var parent = $(this).parent(), parentId = parent.closest('div[id]').attr('id');
            parent.remove();
            $('#' + parentId + ' option[value="' + $(this).attr('data-id') + '"]').show();
        });

    </script>
@endsection

