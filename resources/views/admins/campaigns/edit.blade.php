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
    Edit Campaigns
@endsection

@section('content')

        <div class="col-md-8">
            <form id="campaign" method="POST" action="{{ route('admin.campaigns.update', $campaign->id ) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="">Restaurant / Business</label><br>
                    <input class="form-control" type="text" name="restaurant_id" placeholder="{{ $campaign->restaurant->business_name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" required value="{{ isset($campaign->title) ? $campaign->title : old('title') }}" name="title">
                </div>

                <div class="form-group">
                    <label for="">Expiry Date</label>
                    <input data-date-format="yyyy-mm-dd hh:ii:ss" class="form_datetime form-control" name="expires" size="16" type="text" value="{{ isset($campaign->expires) ? $campaign->expires : old('expires') }}">

                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <div id="ql-editor">

                    </div>
                    <input type="hidden" required name="description" value="{!! $campaign->description !!}">
                </div>



                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save</button>
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
        $(function() {

            var editor = new Quill('#ql-editor', {
                theme : 'snow',
                placeholder: 'Description...'
            });

            editor.clipboard.dangerouslyPasteHTML('{!! $campaign->description !!}');

            editor.on('text-change', function(delta, oldDelta, source) {
                var content = editor.getContents();
                content = quillGetHTML(content);
                $('input[name="description"]').val(content);
            });

             /*date picker */
            $(".form_datetime").datetimepicker({
                format: "yyyy-mm-dd hh:ii:ss"
            });

        });


        function quillGetHTML(inputDelta) {
            var tempCont = document.createElement("div");
            (new Quill(tempCont)).setContents(inputDelta);
            return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
        }



    </script>



@endsection
