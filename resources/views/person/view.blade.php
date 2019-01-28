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
            <h2>Detail:</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID : {{$p->id}}</td>
            </tr>
            <tr>
                <td>Name : {{$p->name}}</td>
            </tr>
            <tr>
                <td>Phone : {{$p->phone}}</td>
            </tr>
            <tr>
                <td>Email : {{$p->email}}</td>
            </tr>
            <tr>
                <td>Avatar : {{$p->avatar}}</td>
            </tr>
            <tr>
                <td>Organization ID : {{$p->organization_id}}</td>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <a href="{{ route('person.index')}}">Back to Index</a>
    <div>
@endsection