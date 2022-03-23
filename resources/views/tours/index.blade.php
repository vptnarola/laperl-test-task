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
		<div class="row">
			<div class="col-md-4">
	            <div class="form-group">
	                <strong>Country</strong>
	                <select name="country_id" id="filter_country_id" class="form-control country_id_select2">
                	</select>
	            </div>
			</div>
			<div class="col-md-4">
	            <div class="form-group">
	                <strong>City</strong>
	                <select name="city_id" id="filter_city_id" class="form-control city_id_select2">
                	</select>
	            </div>
			</div>
			<div class="col-md-4">
              <a href="javascript:filter_record();" class="btn submit_btn mt-3" id="filter_btn">Filter</a>
              <a href="javascript:clear_filter();" class="btn submit_btn mt-3" id="filter_btn">Clear Filter</a>
            </div>
      	</div>
		
	    <table class="table tour-table" id="tour_datatable">
	        <thead>
	            <tr>
	                <th>Tour Id</th>
	                <th>Tour</th>
	                {{-- <th width="100px">Action</th> --}}
	            </tr>
	        </thead>
	        <tbody>
	        </tbody>
	    </table>
	</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/select2.js') }}"></script>
<script type="text/javascript">
	let _url = __url + '/tour-listing';
	var tour_datatable;
  	$(document).ready(function(){
	country_select2();	
	city_select2();	
    
    tour_datatable = $("#tour_datatable").dataTable({
		aaSorting: [],
		processing: true,
		serverSide: true,
		ajax: {
              "url": _url,
              "type":"GET",
              data: function ( d ) {
                  d.filter_country_id         = $('#filter_country_id').val();
                  d.filter_city_id   		  = $('#filter_city_id').val();
              },
          },
		searchDelay: 350,
		language: { searchPlaceholder: "Search..." },
		// "dom": '<"top"<"dttable_lenth_wrapper"fl>>rt<"custom_datatable" t><"bottom"pi><"clear">',
		columns: [
			{
				data: 'tour_id',
				name: 'tour_id',
				render: function(data, type, full, meta) {
					return '#'+full.tour_id;
				},
				orderable: false,
				searchable: false,
				visible:false
			},
			{
				data: 'name',
				name: 'name',
				orderable:true,
				searchable: true,
				render: function(data, type, full, meta) {
					let action_btn = '';
					let review     = '';
					let available_ticket     = full.available_ticket;
					for(var i = 1; i < full.rating; i++)
				    {
				        review += `<svg class="w-4 h-4 mx-px fill-current text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
							                                            <path d="M6.43 12l-2.36 1.64a1 1 0 0 1-1.53-1.11l.83-2.75a1 1 0 0 0-.35-1.09L.73 6.96a1 1 0 0 1 .59-1.8l2.87-.06a1 1 0 0 0 .92-.67l.95-2.71a1 1 0 0 1 1.88 0l.95 2.71c.13.4.5.66.92.67l2.87.06a1 1 0 0 1 .59 1.8l-2.3 1.73a1 1 0 0 0-.34 1.09l.83 2.75a1 1 0 0 1-1.53 1.1L7.57 12a1 1 0 0 0-1.14 0z"></path></svg>`;
				    } 
					action_btn += `<div>
							        <div class="px-2">
							            <div class="bg-white shadow-xl rounded-lg overflow-hidden md:flex">
							                <div class="bg-cover bg-bottom h-56 md:h-auto md:w-56 tour-image" style="background-image: url(`+full.image_path+`)">
							                </div>
							                <div>
							                    <div class="p-4 md:p-5">
							                        <p class="font-bold text-xl md:text-2xl">`+full.name+`</p>
							                        <p class="text-gray-700 md:text-lg">`+full.tour_short_description+`</p>
							                    </div>
							                    <div class="p-4 md:p-5 bg-gray-100">
							                        <div class="sm:flex sm:justify-between sm:items-center">
							                            <div>
							                                <div class="flex items-center">
							                                    <div class="flex inline-flex -mx-px">
							                                        `+review+`
							                                    </div>
							                                    <div class="text-gray-600 ml-2 text-sm md:text-base mt-1">`+full.review_count+` reviews</div>
							                                </div>
							                            </div>`;
							                            if(available_ticket > 0){
								                            action_btn +=`<a href="`+full.book_action+`" id="book_button_`+full.id+`" data-id="`+full.id+`" class="mt-3 sm:mt-0 py-2 px-5 md:py-3 md:px-6 bg-indigo-700 hover:bg-indigo-600 font-bold text-white md:text-lg rounded-lg shadow-md book_btn">
						        								Book now
						    								</a>`;
					    								}
							                        action_btn +=`</div>
							                        <div class="mt-3 text-gray-600 text-sm md:text-base">*Prices may vary depending on selected date.</div>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div><br>`;

					return `${action_btn} `;
						
				},
			},
			// {
			// 	data: 'action',
			// 	name: 'action',
			// 	render: function(data, type, full, meta) {
					
			// 		let action_btn = '';

			// 		action_btn += `<a href="`+data['book_action']+`" id="book_button_`+data.id+`" data-id="`+data.id+`" class="btn btn-sm btn-success mb-2">
   //      							Book
   //  								</a>`;

			// 		return `${action_btn} `;
						
			// 	},
			// 	orderable: false,
			// 	searchable: false
			// },
		],
		rowCallback: function(row, data, iDisplayIndex) {
        },
        fnDrawCallback: function( oSettings ) {
            
        },
        preDrawCallback: function() {
        },
		
    });
    
  });

  	// Filter data using user id
    function filter_record(){
      $('#tour_datatable').DataTable().ajax.reload();
    }
    // clear Filter 
    function clear_filter(){
        $("#filter_country_id").select2("destroy");
        $('#filter_country_id').val('');
        $("#filter_country_id").find('option').remove();

        $("#filter_city_id").select2("destroy");
        $('#filter_city_id').val('');
        $("#filter_city_id").find('option').remove();
        
        //initialize select2
        country_select2();
        city_select2();
        
      $('#tour_datatable').DataTable().ajax.reload();
    }
</script>
@endsection