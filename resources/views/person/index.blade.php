@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <a href="{{ route('person.create')}}" class="btn btn-primary">Add New</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Number</td>
                <td>Name</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Avatar</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($persons as $item)
                <tr>
                    <td>{{$item['number']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['phone']}}</td>
                    <td>{{$item['email']}}</td>
                    <td>{{$item['avatar']}}</td>
                    <td><a href="{{ route('person.edit',$item['id'])}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="{{ route('person.show',$item['id'])}}" class="btn btn-primary">View</a></td>
                    <td>
                        <form action="{{ route('person.destroy', $item['id'])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection