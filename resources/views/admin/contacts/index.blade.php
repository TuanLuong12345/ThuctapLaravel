<!-- resources/views/admin/contacts/index.blade.php -->

@extends('layout.admin')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created At</th>
                <th >Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr class="{{ $contact->status === 0 ? 'not-viewed' : '' }}">
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td >{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->title }}</td>
                    @if($contact->status === 0)
                        <td style="color: red">Chưa xem</td>
                    @else
                        <td style="color: green; font-weight: bold;">Đã xem</td>
                    @endif
                    <td>{{ $contact->created_at }}</td>
                    <td  class="edit_delete">
                        <a href="{{ route('admin.contact_view', ['id' => $contact->id]) }}" class="btn btn-info">
                            View
                        </a>
                        <a href="{{route('admin.contact_delete',['id'=>$contact->id])}}"
                           class="btn btn-danger action_delete">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{$contacts->links()}}
    </div>
@endsection
