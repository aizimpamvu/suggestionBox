@extends('layout')

@section('content')
    <h1 style="text-align: center">Suggestion Panel</h1>
    @if(Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="color:white">&times;</span>
            </button>
        </div>
    @endif

    {{--My Table--}}
    <table class="table table-hover" id="myTable">
        <thead>
        <tr>
            <th scope="col">#</th>
{{--            <th scope="col">Names</th>--}}
{{--            <th scope="col">Email</th>--}}
{{--            <th scope="col">Phone Number</th>--}}
            <th scope="col">Suggestion Details</th>
            <th scope="col">Assigned</th>
            <th scope="col">Received at</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
{{--                <td>{{$item->names}}</td>--}}
{{--                <td>{{$item->email}}</td>--}}
{{--                <td>{{$item->telephone}}</td>--}}
                <td>{{$item->suggestion_details}}</td>
                <td><span class="badge badge-{{$item->assigned_suggestion_count>0?'primary':'warning'}}">{{$item->assigned_suggestion_count>0?'Assigned':'unsigned'}}</span></td>
                <td>{{$item->created_at}}</td>
                <td>

{{--                    Operations--}}
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                @can('delete-users')
                                    <a class="dropdown-item" href="/delete/{{$item->id}}">
                                        <i class='fas fa-trash' style="color: red"></i>Delete</a>
                                @endcan
                                    @can('edit-users')
                                        <a class="dropdown-item" href="/editSuggestion/{{$item->id}}" data-toggle="tooltip" data-placement="top"
                                           title="Click to edit"><i class='fas fa-edit'></i>Edit</a>
                                    @endcan

                                <div class="dropdown-divider"></div>
                                    @can('manage-users')
                                        @if($item->assigned_suggestion_count==0)
                                            <button
                                                data-url="{{ route('suggestion.assign',$item->id) }}"
                                                type="button" class="create-modal btn btn-outline-success btn-sm js-assign dropdown-item"
                                                id="{{$item->id}}"
                                                data-toggle="modal" data-target="#assignModal" data-whatever="@getbootstrap"><i
                                                    class="fas fa-tasks"></i>Assign
                                            </button>
                                        @endif
                                    @endcan
                            </div>
                        </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
<!-- The Modal For Preview on Details-->

<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Assign Suggestion to staff</h5>
                <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="submitForm">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="staff-name" class="col-form-label">Department</label>
                        <select class="form-control" name="assigned_user" id="departmentName">
                            <option value="">__Select a department__</option>
                            @foreach($department as $departments)
                                <option value="{{$departments->id}}"> {{$departments->department_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="staff-name" class="col-form-label">Staff names</label>
                        <select class="form-control" name="assigned_user" id="staff-name">
                            <option value="">__Select a staff__</option>
                            @foreach($assignStaff as $staff)
                                <option value="{{$staff->id}}"> {{$staff->names}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="staff-name" class="col-form-label">Suggestion Priority</label>
                        <select class="form-control" name="suggestion-priority" id="suggestion-priority">
                            <option value="">__Suggestion Priority__</option>
                            @foreach($precedence as $precedences)
                                <option value="{{$precedences->id}}"> {{$precedences->precedence}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Comment</label>
                        <textarea class="form-control" name="comment" id="message-text"
                                  placeholder="Write a comment here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign<i class="fa fa-hand-o-right"
                                                                           aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Preview Scripts -->

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
