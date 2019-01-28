@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Person
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
            <form method="post" action="{{ route('person.update', $p->id) }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="p_name" value={{ $p->name }} />
                </div>
                <div class="form-group">
                    <label for="phone">Phone :</label>
                    <input type="text" class="form-control" name="p_phone" value={{ $p->phone }} />
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="text" class="form-control" name="p_email" value={{ $p->email }} />
                </div>
                <div class="form-group">
                    <label for="logo">Avatar :</label>
                    <input type="text" class="form-control" name="p_avatar" value={{ $p->avatar }} />
                </div>
                <div class="form-group">
                    <label for="logo">Organization :</label>
                    <input type="text" class="form-control" name="p_org_id" value={{ $p->organization_id }} />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
