@extends('adminlte::page')

@section('title', 'Saving Wallet(User)')

@section('content_header')
    <h1 class="m-0 text-dark"> Admin Dashboard</h1>

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card p-5">
                <table id="example" class="table table-sm table-striped w-100" >
                    <thead >
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Birth Date</th>
                        <th>Total expenses</th>
                        <th>Total income</th>
                        <th>Wallet balance</th>
                        <th>Registered date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($getAllUsersInfo as $usersInfo)
                        <tr>
                            <td>{{$usersInfo->name}}</td>
                            <td>{{$usersInfo->email}}</td>
                            <td>{{$usersInfo->phone_number}}</td>
                            <td>{{$usersInfo->birth_date}}</td>
                            <td>{{$usersInfo->total_expenses}}</td>
                            <td>{{$usersInfo->total_income}}</td>
                            <td>{{$usersInfo->wallet_balance}}</td>
                            <td>{{$usersInfo->created_at}}</td>
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


