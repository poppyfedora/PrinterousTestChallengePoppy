@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Organization
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('organization.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="org_name"/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone :</label>
                    <input type="text" class="form-control" name="org_phone"/>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="text" class="form-control" name="org_email"/>
                </div>
                <div class="form-group">
                    <label for="website">Website :</label>
                    <input type="text" class="form-control" name="org_website"/>
                </div>
                <div class="form-group">
                    <label for="logo">Logo :</label>
                    <input type="text" class="form-control" name="org_logo"/>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
