
        <div class="col-md-6 col-md-offset-4">
            @if(request()->session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span class="glyphicon glyphicon-ok"></span> <strong>Success Message</strong>
                    <hr class="message-inner-separator">
                     <p>  {{ request()->session()->get('success') }} </p>
                </div>

            @elseif(request()->session()->has('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span class="glyphicon glyphicon-ok"></span> <strong>Oops!</strong>
                    <hr class="message-inner-separator">
                    <p>  {{ request()->session()->get('error') }} </p>
                </div>
            @endif

            {{--@if(count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span class="glyphicon glyphicon-ok"></span> <strong>Error:</strong>
                    <hr class="message-inner-separator">
                    <ul>
                    @foreach($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif--}}
        </div>

