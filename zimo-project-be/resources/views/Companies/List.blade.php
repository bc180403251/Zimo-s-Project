@extends('layouts.default')
@section('title','Employee List')

@section('content')
    <div class="container">

        <h2>Company list</h2>
        <table class="company-listing  table  table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js" defer></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">


<script type="text/javascript">

    $(function () {
        setTimeout(function () {
            var table = $('.company-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url :"{{ url('company-data') }}",
                },

                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'logo', name: 'logo'},
                    {data: 'action', name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',},

                ],

            });
        }, 2000);
    });
</script>





