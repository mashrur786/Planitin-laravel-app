<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(request()->session()->has('success'))
                <div class="alert alert-success">
                <strong>Success: {{ request()->session()->get('success') }}</strong>
                </div>
            @endif

            @if(count($errors) > 0)

            <div class="alert alert-danger">
                <strong>Errors:</strong>
                @foreach($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>

            @endif
        </div>
    </div>
</div>
