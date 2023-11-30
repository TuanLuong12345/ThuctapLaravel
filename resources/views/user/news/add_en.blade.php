@extends('layout.admin')

@section('content')

    <div class="row my-3">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary">
                    <h3 class="text-light fw-bold">Add Post EN User</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('user.news.store_en', ['id' => $newsUserVi->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="my-2">
                            Tiêu đề(Tiếng Anh) :
                            <input
                                type="text"
                                name="title_en"
                                id="title_en"
                                class="form-control "
                                required
                            >
                        </div>
                        <div class="my-2">
                            Ảnh Minh Họa:

                            <img class="thumbnail" src="{{asset('storage/images/'.$newsUserVi->thumbnail)}}" alt="">
                            <div class="form-group">
                                <label class="col-md-12"
                                       for="public_at"
                                       style="margin-top: 20px"
                                >Ngày public:</label>
                                <span>{{ $newsPublicAt }}</span>
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example7">Nội dung(Tiếng Anh) :</label>
                            <textarea
                                class="form-control"
                                id="editor_en"
                                name="content_en"
                                rows="5"
                            ></textarea>
                        </div>
                        <div class="my-2">
                            <input type="submit" value="Edit Post EN" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugin/ckfinder/ckfinder.js') }}"></script>
    <script>
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




