@extends('base.base')

@section('content')

	<div class="container">
		<form id="booking_form" class="form" method="POST" action="{{ route('tour-store') }}" enctype="multipart/form-data">
    	@csrf
    	<input type="hidden" name="tour_id" id="tour_id" value="{{base64_encode($tours->id)}}">
	     <div class="row">
	        <div class="col-xs-12 col-sm-12 col-md-12">
	            <div class="form-group">
	                <strong>Name:</strong>
	                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12">
	            <div class="form-group">
	                <strong>Email:</strong>
	                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12">
	            <div class="form-group">
	                <strong>Phone:</strong>
	                <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone No">
	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12">
	            <div class="form-group">
	                <strong>No of tickets:</strong>
	                <input type="text" name="no_of_ticket" id="no_of_ticket" class="form-control" placeholder="No of tickects">
	            </div>
	        </div>

	        

	        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
	                <button type="submit" class="btn  submit_btn" id="btn_submit">Submit</button>
	                <a href="{{route('tour-listing')}}" class="btn  submit_btn" id="btn_cancel">Cancel</a>
	        </div>
	    </div>
	</form>
	</div>
@endsection

@section('scripts')
		<script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
		<script src="{{ asset('plugins/jquery-validation/additional-methods.js') }}"></script>
		<script src="{{ asset('plugins/jquery-validation/jquery_form.js') }}"></script>
<script type="text/javascript">
	let _url = __url;



	let $users_form = $("#booking_form").validate({

		errorElement: "div",
		errorClass: 'validation-error-label invalid-feedback',
		successClass: 'validation-valid-label',
		validClass: "validation-valid-label",
		focusInvalid: true,
		ignore: "input[type=hidden]",
		invalidHandler: function (e, t) {
		},
		highlight: function(element, errorClass) {
			$(element).removeClass(errorClass);
		},
		unhighlight: function(element, errorClass) {
			$(element).removeClass(errorClass);
		},
		success: function(label) {
			label.addClass("validation-valid-label").text("")
		},
		errorPlacement: function(error, element) {
	        if (element.attr("name") == "profile_image" ){
	            error.appendTo('#profile_image-error');
	        }else{
	            error.insertAfter(element);
	        }
	    },
		rules: {
			name: {
				required: true,
				pattern: "^(?=.*[a-zA-Z])([a-zA-Z0-9-_. ]+|)$",
			},

			email: {
				required: true,
				email:true,
			},
			phone_no: {
				required: true,
				minlength:10,
				maxlength:10,
			},
			no_of_ticket: {
				required: true,

			},
			
		},
		messages: {
			name: {
				required: "Name is required",
				pattern: "Title start with characters only (Special characters allowed: '-', '_', '.')"
			},
			email: {
				required: "Email is required",
			},
			phone_no: {
				required: "Phone no is required",
			},
			no_of_ticket: {
				required: "No of ticket is required",
			},
		},
		submitHandler: function (e) {
			$(e).ajaxSubmit({
				url: $('#action').val(),
				dataType:'json',
				type: 'POST',
				clearForm: false,
				beforeSubmit: function (formData, jqForm, options) {
					$('.submit_btn').attr('disabled', 'disabled');
					$('#btn_cancel').hide();
				},
				complete: function () {
					$('.submit_btn').removeAttr('disabled');
					$('#btn_cancel').show();
				},
				error: function ( error ) {
					let $error = error.responseJSON.errors;
					$users_form.showErrors($error);
				},	

				success: function (data) {
					if (data.status == true) {
						sweet_alert(data.msg,'success',0,'',1,__url +'/tour-listing');
						
					} else {
						sweet_alert(data.msg,'error');
					}
				}
			});
		}
	});
</script>
@endsection