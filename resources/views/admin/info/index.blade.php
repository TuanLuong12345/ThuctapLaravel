@extends('layout.admin')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'/>
@section('content')
    <h4 style="text-align: center; color: black">Danh sách Info</h4>
    @if(session('message'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row g-4 mt-1">
        <div class="col-md-12">
            <a href="{{route('info.create')}}"
               class="btn btn-success float-right m-2">
                Add
            </a>


        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th class="check_all">
                        <input
                            type="checkbox"
                            id="master"
                        >
                    </th>
                    <th scope="col" class="column">Id</th>

                    <th scope="col" class="column" style="width: 150px;">Title</th>
                    <th scope="col" class="column" style="width: 500px;">Image</th>
                    <th scope="col" class="column">Type</th>
                    <th scope="col" class="column">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($info_Admin as $key => $info_Admin_view)
                    <tr>
                        <td><input
                                type="checkbox"
                                class="sub_chk"
                                data-id="{{$info_Admin_view->id}}"
                            >
                        </td>
                        <th scope="row">{{$info_Admin_view->id}}</th>
                        <td style="width: 150px;text-align: center">
                            {{ $info_Admin_view->title}}
                        </td>
                        <td>
                            <img src="{{ asset('storage/images/'.$info_Admin_view->thumbnail) }}" class="card-img-top ">
                        </td>
                        <td style="text-align: center">{{ $info_Admin_view->type }}</td>
                        <td class="edit_delete">
                            <a href="{{route('info.view',['id'=>$info_Admin_view->id])}}" class="btn btn-primary">
                                View
                            </a>
                            <a href="{{route('info.edit',['id'=>$info_Admin_view->id])}}"
                               class="btn btn-danger">
                                Edit
                            </a>
                            <a href="{{route('info.delete',['id'=>$info_Admin_view->id])}}"
                               class="btn btn-danger action_delete">
                                Delete
                            </a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            {{$info_Admin->links()}}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/users/delete_all.js')}}"></script>
@endsection
