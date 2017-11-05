@extends('admins.dashboard')
@section('styles')
    <link rel="stylesheet" href="/css/select2.css">
@endsection

@section('page-title')
    Add Restaurants
@endsection
@section('content')

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.restaurants') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" required placeholder="Enter email">
        </div>
                <div class="form-group">
            <label for="">Business Name</label>
            <input type="text" class="form-control" required placeholder="Business Name" name="business_name">
        </div>
                <div class="form-group">
            <label for="">Business Type</label><br>
            <select name="type" class="selectpicker">
                <option value="restaurant"> Restaurant / Dine-in </option>
                <option value="takeaway"> Takeaway / Fast-food </option>
                <option value="cafe"> Café </option>
                <option value="dessert"> Dessert / treats </option>
            </select>
        </div>
                <div class="form-group">
                    <label for="">Cuisine</label><br>
                    <input class="form-control" name="cuisine" type="text" required placeholder="Cuisine">
                </div>
                <div class="form-group">
                    <label for="id_label_multiple">Select or Create Requirement
                        <br>
                        <select class="select2-multiple form-control" multiple="multiple" name="requirements[]">
                           @foreach($requirements as $requirement)
                                <option value="{{ $requirement->id }}"> {{  $requirement->name }}</option>
                           @endforeach
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                     <textarea name="description" class="form-control" placeholder=""></textarea>
                </div>
                <div class="form-group">
                     <label class="btn btn-default">
                        Upload Featured Image <input name="f_img" class="btn" type="file" hidden>
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Business Telephone One</label>
                    <input class="form-control" type="text" name="business_phone1">
                </div>
                <div class="form-group">
            <label for="">Additional Phone Number</label>
            <input class="form-control" type="text" name="business_phone2">
        </div>
                <div class="form-group">
                    <label for="">Business Address</label>
                    <textarea class="form-control" type="text" name="address"> </textarea>
                </div>
                <div class="form-group">
                    <label for="">Street/Road</label>
                    <input class="form-control" type="text" name="street">
                </div>
                <div class="form-group">
            <label for="">Area</label>
            <input class="form-control" type="text" name="area">
        </div>
                <div class="form-group">
            <label for="">Town/City</label>
            <input class="form-control" type="text" name="town">
        </div>
                <div class="form-group">
            <label for="">County</label>
            <input class="form-control" type="text" name="county">
        </div>
                <div class="form-group">
            <label for="">Outcode</label>
            <input class="form-control" type="text" name="outcode">
            <label for="">Incode</label>
            <input class="form-control" type="text" name="incode">
        </div>
                <div class="form-group">
            <label for="">Website Address</label>
            <input class="form-control" type="text" name="website">
        </div>
                <div class="form-group">
            <label for=""> Contact Name</label>
            <input class="form-control" type="text" name="contact_name">
        </div>
                <div class="form-group">
            <label for=""> Contact Phone</label>
            <input class="form-control" type="text" name="contact_phone">
        </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>



@endsection
@section('scripts')
    <script  type="text/javascript" src="/js/select2.min.js"></script>
    <script type="text/javascript">
        $(".select2-multiple").select2(
            {
                placeholder: "Select a Requirement"
            }
        );
    </script>
@endsection