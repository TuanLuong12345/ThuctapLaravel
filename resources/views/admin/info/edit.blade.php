@extends('layout.admin')

@section('content')

    <div class="row my-3">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary">
                    <h3 class="text-light fw-bold">Edit Info</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('info.update',['id'=>$InfoEdit->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-2">
                            Tiêu đề :
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-control"
                                value="{{$InfoEdit->title}}"
                                required
                            >
                            @error('title')
                            <div class="alert alert-danger">* {{ $message }}</div>
                            @enderror

                        </div>
                        <div class="my-2">
                            Ảnh Minh Họa:
                            <img class="thumbnail" src="{{asset('storage/images/'.$InfoEdit->thumbnail)}}"
                                 alt="">
                            <input
                                type="file"
                                name="thumbnail"
                                id="thumbnail"
                                accept="image/*"
                                class="form-control"
                            >
                            @error('thumbnail')
                            <div class="alert alert-danger">* {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4" >
                            <label class="form-label" for="form6Example7">Nội dung :</label>
                            <textarea
                                class="form-control"
                                id="editor"
                                name="content"
                                rows="5"

                            >{{$InfoEdit->content}}</textarea>

                        </div>
                        @error('content')
                        <div class="alert alert-danger">* {{ $message }}</div>
                        @enderror
                        <div class="my-2">
                            Type :
                            <input
                                type="text"
                                name="type"
                                id="type"
                                value="{{$InfoEdit->type}}"
                                required
                            >
                        </div>
                        <div class="my-2">
                            <input type="submit" value="Add Info" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugin/ckfinder/ckfinder.js') }}"></script>
    <script>
        createCkeditor('editor');
        function createCkeditor(name) {
            CKEDITOR.replace(name, {
                filebrowserBrowseUrl: "{{ asset('plugin/ckfinder/ckfinder.html') }}",
                filebrowserImageBrowseUrl: "{{ asset('plugin/ckfinder/ckfinder.html?type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('plugin/ckfinder/ckfinder.html?type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
            });
        }

    </script>
@endsection



