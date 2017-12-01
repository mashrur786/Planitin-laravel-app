@extends('admins.dashboard')
@section('styles')
    <link rel="stylesheet" href="/dateTimePicker/css/bootstrap-datetimepicker.min.css">
    {{-- bootstrap toggle switch --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
                 {{--<div class="form-group">
                     <div class="checkbox">
                         Greeting Deal
                          <label style="margin-left: 10px">
                            <input id="greeting" name="greeting" data-size="small" type="checkbox" value="0" data-toggle="toggle">
                          </label>
                     </div>
                </div>--}}
                 <div class="form-group">
                    <div class="form-group">
                        <label for="">Expiry Date</label>
                        <input id="expires" placeholder="Year-month-day hour:Minutes:Second" data-date-format="yyyy-mm-dd hh:ii:ss" class="form_datetime form-control" name="expires" size="16" type="text" value="">
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
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
                <br><br><br>
            </form>
        </div>


@endsection

@section('scripts')
    <!-- Main Quill library -->

    <script src="//cdn.quilljs.com/1.3.2/quill.min.js"></script>
    {{-- date picker --}}
    <script type="text/javascript" src="/dateTimePicker/js/bootstrap-datetimepicker.min.js"></script>
    {{-- boorstrap toggle switch --}}
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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

        /* toggle greeting */
        /*$(function() {
            $('#greeting').change(function() {

                  if($(this).prop("checked") == true){
                   //run code
                      $(this).val(1);
                      $('#expires').prop('disabled', true);
                    }else{
                   //run code
                      $(this).val(0);
                      $('#expires').prop('disabled', false);
                    }
            })
        });*/

    </script>



@endsection
