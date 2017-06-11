@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8"><h3>Add Restaurants</h3></div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" required placeholder="Enter email">
                    </div>
                     <div class="form-group">
                        <label for="">Business Name</label>
                        <input type="text" class="form-control" required placeholder="">
                    </div>
                     <div class="form-group">
                        <label for="">Business Type</label>
                        <select class="selectpicker">
                            <option> Restaurant/ Dine-in</option>
                            <option>Takeaway/ Fast-food</option>
                            <option>Café </option>
                            <option> Drinks </option>
                            <option > Dessert/ treats </option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="">Description</label>
                         <textarea class="form-control" placeholder=""></textarea>
                    </div>





                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection