@extends('base.base')

@section('content')

@section('styles')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.0.1/tailwind.min.css" />
	<style type="text/css">
	    .tour-table {
	        border-bottom: none !important;
	    }

	    .tour-table th {
	        border: none !important;
	    }
	    .tour-image {
	        width: 50%;
	    }

	</style>
@endsection

	<div class="container">
		
	    <table class="table table-border " id="tour_datatable">
	        <thead>
	            <tr>
	                <th>Tour Name</th>
	                <th>User Name</th>
	                <th>User Email</th>
	                <th>User Phone No</th>
	                <th>Available Tickets</th>
	                <th>No Of Tickets</th>
	                <th>Status</th>
	                <th width="100px">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        </tbody>
	    </table>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
	let _url = __url + '/admin/tour-listing';
	let _confirm_book_url = __url + '/admin/confirm-tour-book';
	let _cancel_book_url = __url + '/admin/cancel-tour-book';
	var tour_datatable;
  	$(function () {
    
    tour_datatable = $("#tour_datatable").dataTable({
		aaSorting: [],
		processing: true,
		serverSide: true,
		ajax: _url,
		searchDelay: 350,
		language: { searchPlaceholder: "Search..." },
		// "dom": '<"top"<"dttable_lenth_wrapper"fl>>rt<"custom_datatable" t><"bottom"pi><"clear">',
		columns: [
			{
				data: 'tour_name',
				name: 'tour_name',
				render: function(data, type, full, meta) {
					return full.tour_name;
				},
			},
			{
				data: 'name',
				name: 'name',
				render: function(data, type, full, meta) {
					return full.name;
				},
			},
			{
				data: 'email',
				name: 'email',
				render: function(data, type, full, meta) {
					return full.email;
				},
			},
			{
				data: 'phone_no',
				name: 'phone_no',
				render: function(data, type, full, meta) {
					return full.phone_no;
				},
			},
			{
				data: 'available_ticket',
				name: 'available_ticket',
				render: function(data, type, full, meta) {
					return full.available_ticket;
				},
			},
			{
				data: 'no_of_ticket',
				name: 'no_of_ticket',
				render: function(data, type, full, meta) {
					return full.no_of_ticket;
				},
			},
			{
				data: 'status',
				name: 'status',
				render: function(data, type, full, meta) {
					let status_html = '';
					if(full.status == 'CONFIRM'){
						status_html = '<span class="label label-success">'+full.status_text+'</span>';
					}else if(full.status == 'CANCEL'){
						status_html = '<span class="label label-danger">'+full.status_text+'</span>';
					}else{
						status_html = '<span class="label label-warning">'+full.status_text+'</span>';
					}
					return status_html;
				},
			},
			
			{
				data: 'action',
				name: 'action',
				render: function(data, type, full, meta) {
					
					let action_btn = '<div id="action_div_'+full.id+'"></div> ';

					if(full.status == 'PENDING'){
						action_btn += `<a href="javascript:confirm_book_action(`+full.id+`,'`+full.encoded_id+`','`+full.encoded_tour_id+`');" id="confirm_button_`+full.id+`" data-id="`+full.id+`" class="btn btn-sm btn-success mb-2 book-action">
	        							Confirm
	    								</a>`;

						action_btn += `<a href="javascript:cancel_book_action(`+full.id+`,'`+full.encoded_id+`','`+full.encoded_tour_id+`');" id="cancel_button_`+full.id+`" data-id="`+full.id+`" class="btn btn-sm btn-danger book-action">
	        							Cancel
	    								</a>`;
					}else{
						action_btn += '--';
					}

					return `${action_btn} `;
						
				},
				orderable: false,
				searchable: false
			},
		],
		rowCallback: function(row, data, iDisplayIndex) {
        },
        fnDrawCallback: function( oSettings ) {
            
        },
        preDrawCallback: function() {
        },
		
    });
    
  });

	function confirm_book_action(book_tour_id = '',encoded_book_tour_id = '',encoded_tour_id = ''){
		Swal.fire({
			title: 'Are you sure?',
			text : 'Do you really want to confirm this tickect?',
			icon: 'warning',
			allowOutsideClick: false,
	  		allowEscapeKey: false,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Continue',
			cancelButtonText: 'No, Cancel',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type : "POST",
					url : _confirm_book_url,
					data:{
						book_tour_id: encoded_book_tour_id,
						tour_id: encoded_tour_id,
					},
					dataType: "json",
					beforeSend:function(){
						$('#confirm_button_'+book_tour_id).hide();
		            	$('#cancel_button_'+book_tour_id).hide();
		            	$('#action_div_'+book_tour_id).html('Please wait...');
		            },
		            complete:function(){
		            	$('#confirm_button_'+book_tour_id).show();
		            	$('#cancel_button_'+book_tour_id).show();
		            	$('#action_div_'+book_tour_id).html('');
		            },
					success: function(data){
			            if (data.status == true) {
			            	$('#confirm_button_'+book_tour_id).hide();
			            	$('#cancel_button_'+book_tour_id).hide();
			            	sweet_alert(data.msg,'success',1,tour_datatable);
						} else {
							sweet_alert(data.msg,'error',1,tour_datatable);
							
						}
					},
					
				});
			}
			else
			{
				refresh_datatable(tour_datatable);
			}
		});
	}

	function cancel_book_action(book_tour_id = '',encoded_book_tour_id = '',encoded_tour_id = ''){
		Swal.fire({
			title: 'Are you sure?',
			text : 'Do you really want to cancel this tickect?',
			icon: 'warning',
			allowOutsideClick: false,
	  		allowEscapeKey: false,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Continue',
			cancelButtonText: 'No, Cancel',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type : "POST",
					url : _cancel_book_url,
					data:{
						book_tour_id: encoded_book_tour_id,
						tour_id: encoded_tour_id,
					},
					dataType: "json",
					beforeSend:function(){
						$('#confirm_button_'+book_tour_id).hide();
		            	$('#cancel_button_'+book_tour_id).hide();
		            	$('#action_div_'+book_tour_id).html('Please wait...');
		            },
		            complete:function(){
		            	$('#confirm_button_'+book_tour_id).show();
		            	$('#cancel_button_'+book_tour_id).show();
		            	$('#action_div_'+book_tour_id).html('');
		            },
					success: function(data){
			            if (data.status == true) {
			            	$('#confirm_button_'+book_tour_id).hide();
			            	$('#cancel_button_'+book_tour_id).hide();
			            	sweet_alert(data.msg,'success',1,tour_datatable);
						} else {
							sweet_alert(data.msg,'error',1,tour_datatable);
							
						}
					},
					
				});
			}
			else
			{
				refresh_datatable(tour_datatable);
			}
		});
	}
</script>
@endsection