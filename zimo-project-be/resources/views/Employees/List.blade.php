@extends('layouts.default')
@section('title','Employee List')


@section('content')
        <div class="container">
            <h2>Employee list</h2>

            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="date" id="from_date" class="form-control" placeholder="From Date">
                </div>
                <div class="col-md-3">
                    <input type="date" id="to_date" class="form-control" placeholder="To Date">
                </div>
                <div class="col-md-3">
                    <button id="filter" class="btn btn-primary">Filter</button>
                    <button id="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>

            <table class="employee-listing table table-bordered table-striped table-hover">
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
<meta name="csrf-token" content="{{ csrf_token() }}">

<script type="text/javascript">
    $(function () {
        // Initialize DataTable
        var table = $('.employee-listing').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('employee-data') }}",
                data: function (d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'gender', name: 'gender'},
                {data: 'company_name', name: 'company_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
            ],
        });

        // Filter button click event
        $('#filter').click(function () {
            table.draw();
        });

        // Reset button click event
        $('#reset').click(function () {
            $('#from_date').val('');
            $('#to_date').val('');
            table.draw();
        });

        // Handle delete button click
        $('.employee-listing').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this employee?')) {
                $.ajax({
                    url: '{{ route('delete', '') }}/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if(response.success){
                            alert('Employee Deleted Successfully');
                            table.ajax.reload()
                        }else{
                            alert('Error in deleting Employee ')
                        }
                    },
                    error: function(response) {
                        alert('Error deleting employee.');
                    }



                });
            }
        });
    });
</script>
