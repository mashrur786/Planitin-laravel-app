@extends('admins.dashboard')
@section('styles')
    <link rel="stylesheet" href="/css/select2.css">
    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.2/quill.snow.css" rel="stylesheet">
@endsection

@section('page-title')
    Edit Restaurants
@endsection

@section('content')

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.restaurants.update', ['restaurant_id' => $restaurant->id ]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required value="{{ $restaurant->email }}">
                </div>

                <div class="form-group">
                    <label for="">Business Name</label>
                    <input type="text" class="form-control" name="business_name" required value="{{ $restaurant->business_name }}">
                </div>

                <div class="form-group">
                    <label for="">Business Type</label><br>
                    <select name="type" class="selectpicker">
                        <option value="restaurant"> Restaurant / Dine-in </option>
                        <option value="takeaway"> Takeaway / Fast-food </option>
                        <option value="cafe"> Café & Bars</option>
                        <option value="dessert"> Dessert / treats </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Cuisine</label><br>
                    <input class="form-control" name="cuisine" type="text" required value="{{ $restaurant->cuisine }}">
                </div>
                <div class="form-group">
                    <label for="id_label_multiple">Select or Create Requirement

                        <br>
                        <select class="select2-multiple form-control" multiple="multiple" name="requirements[]">

                           @foreach(App\Requirement::all() as $requirement)

                                    @if($restaurant->requirements()->where('requirement_id', $requirement->id)->exists())
                                        <option value="{{ $requirement->id }}" selected> {{  $requirement->name }}</option>
                                    @else
                                        <option value="{{ $requirement->id }}"> {{  $requirement->name }}</option>
                                    @endif
                           @endforeach

                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                     <textarea name="description" class="form-control">{{ $restaurant->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Reward Points Capstone</label>
                     <input type="number" name="capstone" class="form-control" placeholder="{{ $restaurant->capstone }}">
                </div>
                <div class="form-group">
                    <label for="">Promotional Text</label>
                        <div id="ql-editor" style="min-height: 150px">

                        </div>
                    <input type="hidden" name="promotion_text">
                </div>

                <div class="form-group">
                     <label class="btn btn-default">
                        Upload Featured Image <input name="f_img" class="btn" type="file" value="{{ $restaurant->featured_img }}">
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Business Telephone One</label>
                    <input class="form-control" type="text" name="business_phone1" value="{{ $restaurant->business_phone1 }}">
                </div>

                <div class="form-group">
                    <label for="">Additional Phone Number</label>
                    <input class="form-control" type="text" name="business_phone2" value="{{ $restaurant->business_phone2 }}">
                </div>

                <div class="form-group">
                    <label for="">Business Address</label>
                    <textarea class="form-control" type="text" name="address"> {{ $restaurant->address }}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Street/Road</label>
                    <input class="form-control" type="text" name="street" value="{{ $restaurant->street }}">
                </div>
                <div class="form-group">
                    <label for="">Area</label>
                    <input class="form-control" type="text" name="area" value="{{ $restaurant->area }}">
                </div>

                <div class="form-group">
                    <label for="">Town/City</label>
                    <input class="form-control" type="text" name="town" value="{{ $restaurant->town }}">
                </div>

                <div class="form-group">
                    <label for="">County</label>
                    <input class="form-control" type="text" name="county" value="{{ $restaurant->county }}">
                </div>

                <div class="form-group">
                    <label for="">Outcode</label>
                    <input class="form-control" type="text" name="outcode" value="{{ $restaurant->outcode }}">
                    <label for="">Incode</label>
                    <input class="form-control" type="text" name="incode" value="{{ $restaurant->incode }}">
                </div>

                <div class="form-group">
                    <label for="">Website Address</label>
                    <input class="form-control" type="text" name="website" {{ $restaurant->website }}>
                </div>

                <div class="form-group">
                    <label for=""> Contact Name</label>
                    <input class="form-control" type="text" name="contact_name" value="{{ $restaurant->contact_name }}">
                </div>

                <div class="form-group">
                    <label for=""> Contact Phone</label>
                    <input class="form-control" type="text" name="contact_phone" value="{{ $restaurant->contact_phone }}">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

</div>


@endsection
@section('scripts')
    <script  type="text/javascript" src="/js/select2.min.js"></script>
    <script src="//cdn.quilljs.com/1.3.2/quill.min.js"></script>
    <script type="text/javascript">
        /* Quill editor */

         /* Quill editor */
        $(function() {

            var editor = new Quill('#ql-editor', {
                theme : 'snow',
                placeholder: 'Promotional text...'
            });

            editor.clipboard.dangerouslyPasteHTML('{!! $restaurant->promotion_text !!}');

            editor.on('text-change', function(delta, oldDelta, source) {
                var content = editor.getContents();
                content = quillGetHTML(content);
                $('input[name="promotion_text"]').val(content);
            });

        });


        function quillGetHTML(inputDelta) {
            var tempCont = document.createElement("div");
            (new Quill(tempCont)).setContents(inputDelta);
            return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
        }

        $(".select2-multiple").select2(
            {
                placeholder: "Select a Requirement"
            }
        );
    </script>
@endsection