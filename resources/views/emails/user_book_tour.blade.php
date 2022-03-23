@extends('emails.email-template')

@section('greetings', 'Admin')
@section('heading', 'New Booking')
{{-- @section('sub_heading', 'A user has purchased item.') --}}

@section('content_before_button')
@if(isset($status) && $status == config('global.general.status_confirm'))
	<p>
		Thank you for choosing us,Your ticket is confirm,<br>
		The detail of your ticket is given below.<br>
	</p>
@else
	<p>
		Thank you for choose hour,You ticket is cancel.<br>
		The detail of your ticket is given below.<br>
	</p>
@endif
<table id="content_table_1">
	<tr>
		<th class="table_heading" colspan="2">Booking detail</th>
	</tr>
	<tr>
		<td>Name</td>
		<td>
			{{ @$name }}
		</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>
			{{ @$email }}
		</td>
	</tr>
	<tr>
		<td>Phone No</td>
		<td>
			{{ @$phone_no }}
		</td>
	</tr>
	<tr>
		<td>Tour Name</td>
		<td>
			{{ @$tour_name }}
		</td>
	</tr>
	<tr>
		<td>No Of Tickets</td>
		<td>
			{{ @$no_of_ticket }}
		</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>
			{{ @$status }}
		</td>
	</tr>
	
</table>
@endsection

{{-- @section('button_title', 'Login') --}}
{{-- @section('button_link', route('login')) --}}