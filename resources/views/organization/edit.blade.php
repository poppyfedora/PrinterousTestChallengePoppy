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
            <form method="post" action="{{ route('organization.update', $org->id) }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="org_name" value={{ $org->name }} />
                </div>
                <div class="form-group">
                    <label for="phone">Phone :</label>
                    <input type="text" class="form-control" name="org_phone" value={{ $org->phone }} />
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="text" class="form-control" name="org_email" value={{ $org->email }} />
                </div>
                <div class="form-group">
                    <label for="website">Website :</label>
                    <input type="text" class="form-control" name="org_website" value={{ $org->website }} />
                </div>
                <div class="form-group">
                    <label for="logo">Logo :</label>
                    <input type="text" class="form-control" name="org_logo" value={{ $org->logo }} />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
