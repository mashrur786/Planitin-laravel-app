@extends('admins.dashboard')
@section('styles')
    <link rel="stylesheet" href="/dateTimePicker/css/bootstrap-datetimepicker.min.css">

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.2/quill.snow.css" rel="stylesheet">
    <style>
        #ql-editor {
            min-height: 200px;
        }
    </style>

@endsection
@section('page-title')
    Create Campaigns
@endsection
@section('content')

        <div class="col-md-8">
            <form id="campaign" method="POST" action="{{ route('admin.campaigns') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">Select Restaurant / Business</label><br>
                    <select name="restaurant_id" class="selectpicker form-control">
                        @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}"> {{ $restaurant->business_name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" required placeholder="title.." name="title">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="">Description</label>
                        <div id="ql-editor">

                        </div>
                        <input type="hidden" required name="description">

                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="">Expiry Date</label>
                        <input placeholder="Year-month-day hour:Minutes:Second" data-date-format="yyyy-mm-dd hh:ii:ss" class="form_datetime form-control" name="expires" size="16" type="text" value="">

                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>

            </form>
        </div>


@endsection

@section('scripts')
    <!-- Main Quill library -->

    <script src="//cdn.quilljs.com/1.3.2/quill.min.js"></script>
    {{-- date picker --}}
    <script type="text/javascript" src="/dateTimePicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">

        /* Quill editor */

        var editor = new Quill('#ql-editor', {
            theme : 'snow',
            placeholder: 'Description...'
        });

        editor.on('text-change', function(delta, oldDelta, source) {
            var content = editor.getContents();
            content = quillGetHTML(content);
            $('input[name="description"]').val(content);


        });

        function quillGetHTML(inputDelta) {
            var tempCont = document.createElement("div");
            (new Quill(tempCont)).setContents(inputDelta);
            return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
        }

        /*date picker */
        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss"
        });

    </script>



@endsection
