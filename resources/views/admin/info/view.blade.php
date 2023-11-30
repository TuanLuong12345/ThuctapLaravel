<!-- resources/views/admin/contacts/index.blade.php -->

@extends('layout.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('info.index') }}" class="btn btn-secondary mb-3" style="margin-left: -10px">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <div class="wrapper">
                    <div class="row no-gutters mb-5">
                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <div id="form-message-warning" class="mb-4"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="name">* ID :  {{$InfoViews->id}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="email">* Title : {{$InfoViews->title}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="subject">* Ảnh :</label>
                                            <img class="thumbnail" src="{{asset('storage/images/'.$InfoViews->thumbnail)}}" alt="">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="subject">* Type :  {{$InfoViews->type}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="#">* Nội dung :   {{$InfoViews->content}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
