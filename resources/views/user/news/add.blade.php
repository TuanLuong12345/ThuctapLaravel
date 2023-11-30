@extends('layout.admin')

@section('content')
    <div class="row my-3">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary">
                    <h3 class="text-light fw-bold">Add  News Post VietNamese</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('user.news.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-2">
                            Tiêu đề :
                            <input
                                type="text"
                                name="title_vi"
                                id="title_vi"
                                class="form-control @error('title_vi') is-invalid @enderror"
                                value="{{ old('title_vi') }}"
                                required
                            >
                            @error('title_vi')
                            <div class="alert alert-danger">* {{ $message }}</div>
                            @enderror

                        </div>
                        <div class="my-2">
                            Ảnh Minh Họa:
                            <input
                                type="file"
                                name="thumbnail"
                                id="thumbnail"
                                accept="image/*"
                                class="form-control @error('thumbnail') is-invalid @enderror"
                                required
                            >
                            @error('thumbnail')
                            <div class="alert alert-danger">* {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-md-12"
                                   for="public_at"
                                   style="margin-top: 20px"

                            >Ngày public:</label>
                            <input type="datetime-local"
                                   min="{{ date('Y-m-d\TH:i') }}"
                                   id="public_at"
                                   name="public_at"
                            >
                        </div>
                        <div class="form-outline mb-4" >
                            <label class="form-label" for="form6Example7">Nội dung:</label>
                            <textarea
                                class="form-control"
                                id="editor_vi"
                                name="content_vi"
                                rows="5"
                            ></textarea>

                        </div>
                        @error('content_vi')
                        <div class="alert alert-danger">* {{ $message }}</div>
                        @enderror
                        <div class="my-2">
                            <input type="submit" value="Add Post" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugin/ckfinder/ckfinder.js') }}"></script>
    <script>
        createCkeditor('editor_vi');

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
        createCkeditor('editor_en');

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
