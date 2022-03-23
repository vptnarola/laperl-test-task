@extends('emails.email-template')

@section('greetings', 'Admin')
@section('heading', 'New Booking')
{{-- @section('sub_heading', 'A user has purchased item.') --}}

@section('content_before_button')
<p>
 	Please, review the booking detail and reply to him/her for the same.<br>
	The detail of the person and query is given below.<br>
</p>
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
		<td>No Of Tickets</td>
		<td>
			{{ @$no_of_ticket }}
		</td>
	</tr>
	
</table>
@endsection

{{-- @section('button_title', 'Login') --}}
{{-- @section('button_link', route('login')) --}}