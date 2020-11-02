@extends('layout')

@section('content')
    <h1 style="text-align: center">Units</h1>
    @if(Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="color:white">&times;</span>
            </button>
        </div>
    @endif
    <div class="form-group">
        <button type="button" class=" create-modal btn btn-primary " data-toggle="modal" data-target="#addUnitModal" data-whatever="@getbootstrap"
                data-url="{{ route('add.unit') }}"

                id="addDepartmentBtn"
        ><i class="fas fa-plus"></i> Add New Unit</button>
    </div>


    {{--    My Table--}}
    <table class="table table-hover" id="myTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">DEPARTMENT</th>
            <th scope="col">CREATED AT</th>
            <th scope="col">ACTION</th>
        </tr>
        </thead>
        <tbody>
        @foreach($units as $unit)
            <tr>
                <th scope="row">{{$unit->id}}</th>
                <td scope="row ">{{$unit->name}}</td>
                <td scope="row ">{{$unit->department->department_name}}</td>
                <td scope="row">{{$unit->created_at}}</td>
                <td>
                    @can('delete-users')
                        <a href="/deleteUnit/{{$unit->id}}">
                            <i class='fas fa-trash' style="color: red"></i></a>
                    @endcan
                    @can('edit-users')
                        <button type="button" class="create-modal btn btn-outline-primary btn-sm edit" id="{{$unit->id}}"
                                data-toggle="modal" data-target="#editModal" data-whatever="@getbootstrap"><i
                                class='fas fa-edit'></i>Edit
                        </button>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
<!-- The Modal For Preview on Details-->

<div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="unitDepartmentbel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUnitModalLabel">Unit</h5>
                <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="submitForm">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="unitName" class="col-form-label">Name</label>

                        <input class="form-control" type="text" name="unitName" id="unitName" placeholder="Unit name.." required>
                    </div>
                    <div class="form-group">
                        <label for="department" class="col-form-label">Department</label>
                        <select class="form-control"  id="departmentName" name="departmentName" required>
                            <option required>__Select Department__</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"

                    ><i class="fa fa-hand-o-right"aria-hidden="true"></i>Add Unit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('script')
    <script type="text/javascript">
        //Data table
        $(document).ready(function () {

            var formAction = '';
            $('#myTable').DataTable();

            $('.js-assign').on('click', function () {
                var url = $(this).data('url');
                formAction = url;
            });

            $('#submitForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: formAction,
                    method: 'post',
                    data: $(this).serialize(),
                }).done(function () {
                    location.reload();
                }).fail(function () {
                    alert('Errors');
                });
            });
        });
    </script>

@stop
