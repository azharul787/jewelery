	@extends('layouts.backend.master')

@section('title', 'Customer Edit')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Customer Edit</h4>
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
						<form action="{{route('admin.customer.update',$customer->id)}}" method="post" class="form-horizontal" role="form" >
							@csrf
							@method('put')
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="customer_name" value="{{old('customer_name') ?? $customer->customer_name}}" placeholder="Supplier Name" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('customer_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="customer_phone" value="{{old('customer_phone') ?? $customer->customer_phone}}" placeholder="01xxxxxxxxx" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('customer_phone') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="customer_email" value="{{old('customer_email') ?? $customer->customer_email}}" placeholder="Email Address" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('customer_email') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Distric  </label>
								<div class="col-sm-9">
									<select class="col-sm-8 select2 " name="distric_name" id="distric_id">
										<option value="">-Select-</option>
										@foreach($districs as $dis)
											<option value="{{$dis->id}}" {{$dis->id == $customer->distric_id ? 'selected' : ''}}>{{$dis->distric_name}}</option>
										@endforeach
									</select>  
									<p class="error-sms">{{ $errors->first('distric_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Upozila  </label>
								<div class="col-sm-9">
									<select class="col-sm-8 select2 " name="upozila_name" id="upozila_id">
										<option value="{{$customer->upozila_id}}">{{$customer->upozila->upozila_name}}</option>
										
									</select>  
									<p class="error-sms">{{ $errors->first('upozila_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Union  </label>
								<div class="col-sm-9">
									<select class="col-sm-8 select2 " name="union_name" id="union_id">
										<option value="{{$customer->union_id}}">{{$customer->union->union_name}}</option>
									</select>  
									<p class="error-sms">{{ $errors->first('union_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="customer_address" value="{{old('customer_address') ?? $customer->customer_address}}" placeholder="Customer Address" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('customer_address') }}</p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Update</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
<script>
	$(document).ready(function(){
		// select2 section
		$('.select2').select2()	;
		
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
	});
	
	function deleteCategory(id) {
		var conf = confirm('Do you want to really Delete?');
		  if(conf == true)
		  {
			document.getElementById('delete-form-'+id).submit();
		  }
        }
	</script>
@endpush									