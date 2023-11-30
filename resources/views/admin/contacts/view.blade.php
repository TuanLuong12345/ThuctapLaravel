<!-- resources/views/admin/contacts/index.blade.php -->

@extends('layout.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('admin.contact_admin') }}" class="btn btn-secondary mb-3" style="margin-left: -10px">
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
                                            <label class="label" for="name">* Full Name :</label>
                                            <p>
                                            {{$contact->name}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="email">* Email Address :</label>
                                            <p>
                                                {{$contact->email}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="subject">* Số điện thoại :</label>
                                            <p>
                                                {{$contact->phone}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="subject">* Tiêu đề:</label>
                                            <p>
                                                {{$contact->title}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="#">* Nội dung:</label>
                                            <p>
                                            {{$contact->content}}
                                            </p>
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
