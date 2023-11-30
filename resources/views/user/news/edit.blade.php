@extends('layout.admin')

@section('content')

    <div class="row my-3">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary">
                    <h3 class="text-light fw-bold">Edit Post</h3>
                </div>
                <div class="card-body p-4">

                    @if($locale === 'vi')

                        <form action="{{route('user.news.update',['id'=>$newsUserEdit->id])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="my-2">
                                Tiêu đề :
                                <input
                                    type="text"
                                    name="title_vi"
                                    id="title_vi"
                                    class="form-control "
                                    value="{{$newsUserEdit->title}}"
                                    required
                                >
                            </div>
                            <div class="my-2">
                                Ảnh Minh Họa:

                                <img class="thumbnail" src="{{asset('storage/images/'.$newsUserEdit->thumbnail)}}" alt="">
                                <input
                                    type="file"
                                    name="thumbnail"
                                    id="thumbnail"
                                    accept="image/*"
                                    class="form-control"
                                >
                                <div class="form-group">
                                    <label class="col-md-12"
                                           for="public_at"
                                           style="margin-top: 20px"

                                    >Ngày public:</label>
                                    <input type="datetime-local"
                                           id="public_at"
                                           min="{{ date('Y-m-d\TH:i') }}"
                                           name="public_at"
                                           value="{{ $newsPublicAt }}"
                                    >
                                </div>

                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form6Example7">Nội dung :</label>
                                <textarea
                                    class="form-control"
                                    id="editor_vi"
                                    name="content_vi"
                                    rows="5"
                                >{!! $newsUserEdit->content !!}</textarea>
                            </div>
                            <div class="my-2">
                                <input type="submit" value="Edit Post" class="btn btn-primary">
                            </div>
                        </form>

                    @else
                        @if($newsUserEditEn == null)
                            <form action="{{route('user.news.store_en',['id'=>$newsUserEdit->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="my-2">
                                    Tiêu đề :
                                    <input
                                        type="text"
                                        name="title_en"
                                        id="title_vi"
                                        class="form-control @"
                                        value="{{ old('title_en') }}"
                                        required
                                    >

                                </div>
                                <div class="my-2">
                                    Ảnh Minh Họa:
                                    <input
                                        type="file"
                                        name="thumbnail"
                                        id="thumbnail"
                                        accept="image/*"
                                        class="form-control "
                                        required
                                    >
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
                                    <label class="form-label" for="form6Example7">Nội dung :</label>
                                    <textarea
                                        class="form-control"
                                        id="editor_vi"
                                        name="content_en"
                                        rows="5"
                                    ></textarea>
                                </div>
                                <div class="my-2">
                                    <input type="submit" value="Add Post" class="btn btn-primary">
                                </div>
                            </form>
                        @else
                            <form action="{{route('user.news.update_en',['id'=>$newsUserEditEn->id])}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="my-2">
                                    Tiêu đề :
                                    <input
                                        type="text"
                                        name="title_en"
                                        id="title_en"
                                        class="form-control "
                                        value="{{$newsUserEditEn->title}}"
                                        required
                                    >
                                </div>
                                <div class="my-2">
                                    Ảnh Minh Họa:

                                    <img class="thumbnail" src="{{asset('storage/images/'.$newsUserEditEn->thumbnail)}}"
                                         alt="">
                                    <div class="form-group">
                                        <label class="col-md-12"
                                               for="public_at"
                                               style="margin-top: 20px"
                                        >Ngày public:</label>
                                        <span>{{ $newsPublicAt }}</span>
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form6Example7">Nội dung :</label>
                                    <textarea
                                        class="form-control"
                                        id="editor_vi"
                                        name="content_en"
                                        rows="5"
                                    >{!! $newsUserEditEn->content !!}</textarea>
                                </div>
                                <div class="my-2">
                                    <input type="submit" value="Edit Post" class="btn btn-primary">
                                </div>
                            </form>
                        @endif
                    @endif

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
    </script>
@endsection
