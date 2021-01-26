
<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />

<div class="container">
    {!! Session::has('success') ? '<div class="alert alert-success alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'. Session::get("success") .'</div>' : '' !!}
    {!! Session::has('error') ? '<div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'. Session::get("error") .'</div>' : '' !!}
    <div style="margin-top: 10px; margin-bottom: 10px; text-align: right">
        <a  class="btn btn-primary" href="{{url('/rights/permissions/add')}}">Create Permission</a>
    </div>
    <table id="table_desk" class="table table-stripped" style="width: 100%">
        <thead>
        <tr>
            <th>Permission</th>
            @foreach($roles as $role)
                <th>{{ $role->name }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<script src="{{ asset("assets/scripts/jquery.min.js") }}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>


<script>


    table_desk = $('#table_desk').DataTable({
        iDisplayLength: 50,
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url:  '{{url("/rights/user-permissions-list/".$user_id)}}',
            method:'get',
            data: function (d) {
                d._token = $('input[name="_token"]').val();
            }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'role', name: 'role'},
            {data: 'role', name: 'role'},
            {data: 'role', name: 'role'},
            {data: 'role', name: 'role'},
            {data: 'role', name: 'role'},
        ],
        "aaSorting": []
    });
</script>
