@extends('layouts.app')

@section('style')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Contacts</h1>
        </div>
    </div>
    <div class="row">
		<hr>
        <div class="text-center" style="font-size: 1.2em">
			<i style="font-size: 1.5em" class="ion-ios-email-outline"></i>
			<br> info@planitin.com
			<br>
			<br>..........<br><br>
			<i style="font-size: 1.5em" class="ion-ios-telephone-outline">
			</i>
			<br>+44 7930 261131
        </div>
		<hr>
        <div class="col-md-6 col-md-offset-3">
			<p>Give us a shout whether you are a food & drinks business owner, a skilled professional in tech or a potential partner who wants to see this grow. </p>
            <div class="contactform" id="contact-form">

				<form action="{{ route('contact.store') }}" method="post" role="form" class="contactForm" >
					<div class="row">
							 {{ csrf_field() }}
							<div class="field your-name form-group">
								<input type="text" name="name" class="form-control" id="name" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
								<div class="validation"></div>

							</div>
							<div class="field your-email form-group">
								<input type="text" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email" />
								<div class="validation"></div>

							</div>

                            <div class="field your-telephone form-group">
								<input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Telephone" data-rule="telephone" data-msg="Please enter a valid telephone number" />
								<div class="validation"></div>

							</div>
							<div class="field subject form-group">
								<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
								<div class="validation"></div>

							</div>


							<div class="field message form-group">
								<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please enter your queries" placeholder="Message"></textarea>
								<div class="validation"></div>

							</div>
							<input type="submit" value="Send message" class="btn btn-theme pull-left">

					</div>
				</form>
			</div>
        </div>
    </div>

</div>

    <br><br><br>

@endsection

@section('script')
    <script src="{{ asset('js/validate.js') }}"></script>
@endsection