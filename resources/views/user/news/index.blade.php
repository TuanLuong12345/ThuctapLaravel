@extends('layout.admin')

@section('content')
    <h4 style="text-align: center; color: black">Danh sách bài viết của bạn</h4>
    <div class="row g-4 mt-1">
        <div class="col-md-12">
            <a href="{{route('user.news.create')}}"
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
                    <th scope="col" class="column">Title</th>
                    <th scope="col" class="column" style="width: 250px;">Image</th>
                    <th scope="col" class="column">Public_at</th>
                    <th scope="col" class="column">Status</th>
                    <th scope="col" class="column">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($User_news as $key => $User_new)
                    <tr>
                        <td><input
                                type="checkbox"
                                class="sub_chk"
                                data-id="{{$User_new->id}}"
                            >
                        </td>
                        <th scope="row">{{$User_new->id}}</th>
                        <td>
                            {{ $User_new->title}}
                            @if($User_new->banner === 1)
                                <span style="color:red;text-align: center">(Banner)</span>
                            @else

                            @endif
                        </td>
                        <td>
                            <img src="{{ asset('storage/images/'.$User_new->thumbnail) }}" class="card-img-top ">
                        </td>
                        <td>{{$User_new->public_at}}</td>
                        <td>

                            @if($User_new->status == 0)
                                <span class="pending-status">Đang chờ duyệt</span>
                            @elseif($User_new->status == 1)
                                <span class="approved-status">Đã duyệt bài</span>
                            @endif
                        </td>
                        <td class="edit_delete">
                            <a href="{{ route('user.news.view', ['id' => $User_new->id]) }}" class="btn btn-primary">
                                View
                            </a>
                            <a href="{{route('user.news.edit_select',['id'=>$User_new->id])}}"
                               class="btn btn-danger">
                                Edit
                            </a>
                            <a href="{{route('user.news.delete',['id'=>$User_new->id])}}"
                               class="btn btn-danger action_delete">
                                Delete
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>

            {{$User_news->links()}}

        </div>
    </div>
    <script src="{{asset('js/users/delete_all.js')}}"></script>
@endsection
