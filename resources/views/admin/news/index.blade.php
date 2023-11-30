@extends('layout.admin')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'/>
@section('content')
<h4 style="text-align: center; color: black">Danh sách bài viết</h4>
    @if(session('message'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row g-4 mt-1">
        <div class="col-md-12">
            <a href="{{route('news.create')}}"
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
                    @if($locale ==='vi')
                    <th scope="col" class="column">User_ID</th>
                    @else
                        <th scope="col" class="column">New_ID</th>
                    @endif
                    <th scope="col" class="column" style="width: 30px">Title</th>
                    <th scope="col" class="column" style="width: 250px;">Image</th>
                    <th scope="col" class="column">Author</th>
                    <th scope="col" class="column" style="width: 20px">Public_at</th>
                    <th scope="col" class="column">Status</th>
                    <th scope="col" class="column">Action</th>
                </tr>
                </thead>
                <tbody>
                {{--                    Nếu $locale=vi thì chạy với $news--}}

                    @foreach($news as $key => $new)
                        <tr>
                            <td><input
                                        type="checkbox"
                                        class="sub_chk"
                                        data-id="{{$new->id}}"
                                >
                            </td>
                            <th scope="row">{{$new->id}}</th>
                            <td>{{$new->user_id}}</td>
                            <td style="width: 30px">
                                {{ $new->title}}
                                @if($new->banner === 1)
                                    <span style="color:red;">(Banner)</span>
                                @else

                                @endif
                            </td>
                            <td>
                                <img src="{{ asset('storage/images/'.$new->thumbnail) }}" class="card-img-top ">
                            </td>
                            <td>{{ $new->user->name }}</td>
                            <td style="width: 20px">{{$new->public_at}}</td>
                            @if($new->status === 0)
                                <td> Đang chờ phê duyệt
                                    <button
                                            type="button"
                                            class="approve-button"
                                            data-id="{{ $new->id }}"
                                    >
                                        Đồng ý
                                    </button>
                                </td>
                            @elseif($new->status === 1)
                                <td> Đã phê duyệt</td>
                            @endif
                            <td class="edit_delete">
                                <a href="{{ route('news.view', ['id' => $new->id]) }}" class="btn btn-primary">
                                    View
                                </a>
                                <a href="{{route('news.edit_select',['id'=>$new->id])}}"
                                   class="btn btn-danger">
                                    Edit
                                </a>
                                <a href="{{route('news.delete',['id'=>$new->id])}}"
                                   class="btn btn-danger action_delete">
                                    Delete
                                </a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
                {{$news->links()}}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.approve-button').on('click', function () {
                var newsId = $(this).data('id');
                $.ajax({
                    url: 'http://127.0.0.1:8000/admin/news/status/' + newsId,
                    type: 'POST',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Phê duyệt thành công',
                            showConfirmButton: false,
                            timer: 1500 // Thời gian thông báo hiển thị (ms)
                        }).then(function () {
                            location.reload(); // Làm mới trang sau khi thông báo hiển thị
                        });
                    },
                    error: function () {
                        var errorMessage = xhr.status + ': ' + xhr.responseText;
                        console.log("Lỗi: " + errorMessage);
                        // Hiển thị thông báo lỗi cho người dùng
                        alert('Có lỗi xảy ra khi phê duyệt bài viết');
                    }
                });
            });
        });
    </script>
    <script src="{{asset('js/users/delete_all.js')}}"></script>
@endsection
