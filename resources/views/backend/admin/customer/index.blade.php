@extends('layouts.backend.master')

@section('title', 'Customer')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Customer List</h4>
					<span class="widget-toolbar">
						<a href="#" data-action="settings">
							<i class="ace-icon fa fa-cog"></i>
						</a>
						<a href="#" data-action="reload">
							<i class="ace-icon fa fa-refresh"></i>
						</a>
						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>
						<a href="#" data-action="close">
							<i class="ace-icon fa fa-times"></i>
						</a>
					</span>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row search-section">
							<form action="{{route('admin.customer.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$customers->count()}}">{{$customers->count()}}</option>
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="250">250</option>
										<option value="500">500</option>
										<option value="750">750</option>
										<option value="1000">1000</option>
									</select>
								</div>
								<div class="col-sm-5"></div>
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" id="myInput" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span></button>
										</span>
									</div>
								</div>
							</form> 
						</div>
						<div class="table-content">
							<table id="" class="table table-bordered table-condensed" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Name </th>
										<th>Phone</th>
										<th>Address</th>
										<!--<th>Balance</th>-->
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($customers as $key=>$cus)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{$cus->customer_name}}</td>
											<td>{{$cus->customer_phone}}</td>
											<td>{{$cus->customer_address}}</td>
											<!--<td>{{$cus->sale->sum('due_amount')}}</td>-->
											<td>
											@can('customer-edit')
												<a  href="{{route('admin.customer.edit',$cus->id)}}" title="Edit Customer Information"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('customer-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Customer Information!" onclick="deleteCategory({{ $cus->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $cus->id }}" action="{{ route('admin.customer.destroy',$cus->id) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form>
											@endcan 
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="text-center">
								{{$customers->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
<script>
	$(document).ready(function(){
		
		 $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("tbody tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		  //
		  $("#show").on("change",function(){
			$("#searchForm").submit(); 
		  })
	})
	
	function deleteCategory(id) {
		var conf = confirm('Do you want to really Delete?');
		  if(conf == true)
		  {
			document.getElementById('delete-form-'+id).submit();
		  }
        }



    // dependency dropdown for Address section
	$('#distric_id').on('change',function(){
			var distric_id = $(this).val();
			
			if(distric_id != '')
			{
				var token = "{{csrf_token()}}";
					$.ajax({
						url: '{{ route('admin.union.getUpozila') }}',
						type: 'GET',
						data: {distric_id:distric_id, '_token' : token},
						dataType: 'json',
						success: function (response) {					
							var len = response.length;
							//alert(len)
							$("#upozila_id").empty();
							$("#upozila_id").append("<option value=''>-Select-</option>");
							if (len == 0) {
								$("#upozila_id").empty();
								var id = "";
								var name = "";
								$("#upozila_id").append("<option value='" + id + "'>" + name + "</option>");
							}
							for (var i = 0; i < len; i++) {
								var id = response[i]['id'];
								var name = response[i]['upozila_name'];
								$("#upozila_id").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					});
			}				
			else{
				alert('Please Select Distric');
			}
		});
	$('#upozila_id').on('change',function(){
			var upozila_id = $(this).val();
			
			if(upozila_id != '')
			{
					var token = "{{csrf_token()}}";
					$.ajax({
						url: '{{ route('admin.village.getUnion') }}',
						type: 'GET',
						data: {upozila_id:upozila_id, '_token' : token},
						dataType: 'json',
						success: function (response) {					
							var len = response.length;
							//alert(len)
							$("#union_id").empty();
							$("#union_id").append("<option value=''>-Union-</option>");
							if (len == 0) {
								$("#union_id").empty();
								var id = "";
								var name = "";
								$("#union_id").append("<option value='" + id + "'>" + name + "</option>");
							}
							for (var i = 0; i < len; i++) {
								var id = response[i]['id'];
								var name = response[i]['union_name'];
								$("#union_id").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					});
			}				
			else{
				alert('Please Select Distric');
			}
		});
		/******************************-*/
		$('#union_id').on('change',function(){
			var union_id = $(this).val();
			
			if(union_id != '')
			{
					var token = "{{csrf_token()}}";
					$.ajax({
						url: '{{ route('admin.village.getVillage') }}',
						type: 'GET',
						data: {union_id:union_id, '_token' : token},
						dataType: 'json',
						success: function (response) {					
							var len = response.length;
							//alert(len)
							$("#village_id").empty();
							$("#village_id").append("<option value=''>-Village-</option>");
							if (len == 0) {
								$("#village_id").empty();
								var id = "";
								var name = "";
								$("#village_id").append("<option value='" + id + "'>" + name + "</option>");
							}
							for (var i = 0; i < len; i++) {
								var id = response[i]['id'];
								var name = response[i]['village_name'];
								$("#village_id").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					});
			}				
			else{
				alert('Please Select Union');
			}
		});
	</script>
@endpush									