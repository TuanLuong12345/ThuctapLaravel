
@extends('layout.users.search.admin_user_search')


@section('content')
    <div id="content">
        <!-- End of Header -->
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="select_paginate" style="margin-left: 250px;width: 400px">
                                Hiển thị số lượng
                                <select class="col-md-2" id="itemsPerPage" onchange="updateItemsPerPage()">
                                    <option value="5" {{ $itemsPerPage==5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ $itemsPerPage==10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ $itemsPerPage==15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ $itemsPerPage==20 ? 'selected' : '' }}>20</option>
                                </select>
                                kết quả / 1 trang
                            </div>
                            <a href="{{route('users.create')}}"
                               class="btn btn-success float-right m-2">
                                Add
                            </a>
                            <button
                                    class="btn btn-danger delete_all"
                                    data-url="{{ route('usersDeleteAll') }}"
                            >Delete All Selected
                            </button>
                            <a href="{{route('users.export')}}"
                               style="background-color: #0000cc"
                               class="btn btn-success float-right m-2">
                                Export Excel
                            </a>

                            <form action="{{route('users.import')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file"
                                       class="form-control col-md-6"
                                       required
                                >
                                <button style="background-color:yellowgreen;margin-bottom: 10px;color: black"
                                        class="btn float-left"
                                >
                                    Import User Data
                                </button>
                                <br>
                            </form>
                            <form action="{{route('users.export_search_selected')}}"
                                  method="get"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="selected_ids" id="selected_ids" />
                                <button  style="margin-bottom: 10px;margin-top:-20px;color: black" class="btn btn-warning float-right" type="submit">
                                    Export Selected
                                </button>
                                <br>
                            </form>

                            @if(session('errorMessages'))
                                <div class="alert alert-danger col-md-4" style="margin-left: 200px">
                                        @foreach(session('errorMessages') as $index => $error)
                                            @if(is_array($error['error_messages']) && count($error['error_messages']) > 0)
                                                    <div >* Lỗi ở dòng  {{ $error['i'] }}:</div>
                                                    @foreach($error['error_messages'] as $field => $messages)
                                                        @foreach($messages as $message)
                                                            - {{ $message }} <br>
                                                        @endforeach
                                                    @endforeach
                                            @endif
                                        @endforeach
                                </div>
                            @endif

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
                                    <th scope="col" class="column">Tên User</th>
                                    <th scope="col" class="column">Email</th>
                                    <th scope="col" class="column">Phone</th>
                                    <th scope="col" class="column">Role</th>
                                    <th scope="col" class="column">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($users->count())
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td><input
                                                    type="checkbox"
                                                    class="sub_chk"
                                                    data-id="{{$user->id}}"
                                                >
                                            </td>
                                            <th scope="row">{{$user->id}}</th>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->role}}</td>
                                            <td class="edit_delete">
                                                <a href="{{route('users.edit',['id'=>$user->id])}}"
                                                   class="btn btn-danger">
                                                    Edit
                                                </a>
                                                <a href="{{route('users.delete',['id'=>$user->id])}}"
                                                   class="btn btn-danger"
                                                   data-tr="tr_{{$user->id}}"
                                                   data-toggle="confirmation"
                                                   data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                                   data-btn-ok-class="btn btn-sm btn-danger"
                                                   data-btn-cancel-label="Cancel"
                                                   data-btn-cancel-icon="fa fa-chevron-circle-left"
                                                   data-btn-cancel-class="btn btn-sm btn-default"
                                                   data-title="Are you sure you want to delete ?"
                                                   data-placement="left" data-singleton="true">
                                                    {{-- <i class="fas fa-trash"></i> --}}
                                                    Delete
                                                </a>
                                                {{--                                            <a href="{{route('users.delete',['id'=>$user->id])}}"--}}
                                                {{--                                               class="btn btn-danger action_delete">--}}
                                                {{--                                                Delete--}}
                                                {{--                                            </a>--}}
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{$users->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

{{--//js deleted all--}}
    <script src="{{asset('js/users/delete_all.js')}}"></script>
{{--   Js phân trang --}}
    <script src="{{asset('js/users/user_paginate.js')}}"></script>
{{--    Js checkbox--}}
    <script src="{{asset('js/users/export_search_selected.js')}}"></script>
@endsection

