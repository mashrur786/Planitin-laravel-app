@extends('admins.dashboard')

@section('page-title')
    Home
@endsection

@section('content')

<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-body">
            Welcome <strong>Admin</strong>!
        </div>
    </div>
</div>
<div class="col-md-12">
    <a href="{{ route('admin.sendTestMail') }}">
        <button type="button" class="btn btn-primary">Test Emails</button>
    </a>


</div>



@endsection