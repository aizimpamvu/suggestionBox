@extends('layout')

@section('content')
    <h1 style="text-align: center">Suggestions Assigned to me</h1>
    <table class="table table-hover" id="myTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Suggestions</th>
            <th scope="col">Comment</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->suggestion->suggestion_details}}</td>
                <td>{{$item->comment}}</td>
                <td>


                        <button
                            data-url="{{ route('suggestion.assign',$item->id) }}"
                            type="button" class="create-modal btn btn-outline-primary btn-sm js-assign"
                            id="{{$item->id}}"
                            data-toggle="modal" data-target="#assignModal" data-whatever="@getbootstrap"><i
                                class="fas fa-tasks"></i>View Details
                        </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

<!-- The Modal For Preview on Details-->

<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Suggestion Details</h5>
                <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:grey">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <thead>
                    <tr>
                        <th>Suggestion</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
{{--                        <td>{{$item->suggestion_details->id()}}</td>--}}
                    </tr>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>


        </div>
    </div>
</div>
@section('script')
<script type="text/javascript">
    //Data table
    $(document).ready(function () {

        var formAction = '';
        $('#myTable').DataTable();

    });
</script>
@endsection
