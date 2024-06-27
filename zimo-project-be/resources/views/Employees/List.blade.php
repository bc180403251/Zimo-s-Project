@extends('layouts.default')
@section('title','Employee List')

@section('content')
    <div class="container">

        <h2>Employee list</h2>
        <table class="employee-listing  table  table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>First name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Company</th>
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
            var table = $('.employee-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url :"{{ url('employee-data') }}",
                },

                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'gender', name: 'gender'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'action', name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',},

                ],

            });
        }, 2000);
    });

{{--//     handle delete button--}}
{{--    $('.employee-listing').on('click', '.delete-btn', function (e){--}}
{{--        e.preventDefault();--}}
{{--        var employeId=$(this).data('id');--}}
{{--        var deleteUrl = "{{ url('employees/delete') }}" + '/' + employeId;--}}

{{--        if(confirm('Are you sure you want to delete this employee')){--}}
{{--            $.ajax({--}}
{{--                url:deleteUrl,--}}
{{--                type: 'DELETE';--}}
{{--            })--}}
{{--        }--}}

{{--    })--}}
</script>





