@extends('adminlte::page')

@section('title', 'Saving Wallet(User)')

@section('content_header')
    <h1 class="m-0 text-dark"> Get All Your Transactions</h1>

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card p-5">
                <table id="example" class="table table-sm table-striped w-100" >
                    <thead >
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th>Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allUserTransactions as $transaction)
                    <tr>
                        <td>{{$transaction->id}}</td>
                        <td>{{$transaction->name}}</td>
                        <td>{{$transaction->amount}}</td>
                        <td>{{$transaction->note}}</td>
                        <td>{{$transaction->category_id == 1? 'Income' : 'Expense'}}</td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
@stop

@section('js')

    <script type="text/javascript">

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            var table = $('#example').DataTable({
                order: [[0, 'asc']],
                pagingType: "full_numbers",
            });

        } );

    </script>
@endsection

