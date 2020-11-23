@extends('layout')

@section('content')
    <h1 style="text-align: center">User Management Panel</h1>
    @if(Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::get('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('danger')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{--Table--}}
    <table class="table table-hover" id="myTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Names</th>
            <th scope="col">Email</th>
            <th scope="col">Roles</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            {{--dd($item->roles()->pluck('name')->toArray())--}}
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->names}}</td>
                <td>{{$item->email}}</td>
                <td>{{implode(',',$item->roles()->get()->pluck('name')->toArray()) }}</td>
                <td>
                    @can('delete-users')
                    <a href="/deleteUser/{{$item->id}}">
                        <i class='fas fa-trash' style="color: red"></i></a>
                    @endcan
                    @can('edit-users')
                    <button type="button" class="create-modal btn btn-outline-primary btn-sm edit" id="{{$item->id}}" data-unit="{{$item->unit_id}}" data-roles="{{json_encode($item->roles->pluck('id')->toArray())}}"
                            data-toggle="modal" data-target="#editModal" data-whatever="@getbootstrap"><i
                            class='fas fa-edit'></i>Edit
                    </button>
                        @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
<!-- The Modal For Edit a staff-->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit a staff </h5>
                <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>

            <form action="" method="post" id="editForm">
                {{csrf_field()}}

                <div class="modal-body">
                    <div class="form-group">
                        <label for="names" class="col-form-label">Names</label>
                        <input type="text" class="form-control" id="names" name="names" placeholder="Enter Your names"
                               value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="col-form-label">Unit</label>
                        <select class="form-control" name="unit" id="unit">
                            <option value="">--Select Unit--</option>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}"> {{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('names')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="email" class="col-form-label"> Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }} </div>
                    @enderror
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{$role->id}}">
                            <label for="roles" class="col-form-label">{{$role->name}}</label>

                        </div>
                    @endforeach


                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i>Update
                        Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Preview Scripts -->

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#myTable').DataTable();
            //Editing Record
            table.on('click', '.edit', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                var userRoles = $(this).data('roles');

//                 console.log(roles)
                $('#names').val(data[1]);
                $('#unit').val(data[2]);
                $('#email').val(data[2]);
                $('#unit').val($(this).data('unit'));
                let roles = $('input[name="roles[]"]');

                $.each(roles, function (index, element) {
                    var value = $(element).val();
                    let length = userRoles.length;
                    for (let i = 0; i < length; i++) {
                        let role = userRoles[i];
                        if (value == role) {
                            // console.log('match')
                            $(element).prop("checked", true);
                        }
                    }
                });

                $('#editForm').attr('action', '/users/' + data[0] + '/update');
                $('#editModal').modal('show');
            })
        });
    </script>

@stop
