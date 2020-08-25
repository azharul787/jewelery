	@extends('layouts.backend.master')

@section('title', 'Warehouse')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Warehouse Entry</h4>
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
						<form action="{{route('admin.warehouse.store')}}" method="post" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name </label>
								<div class="col-sm-9">
									<input type="text" id="warehouse_name" name="warehouse_name" value="{{old('warehouse_name')}}" placeholder="Warehouse Name" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('warehouse_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Code </label>
								<div class="col-sm-9">
									<input type="text" id="warehouse_code" name="warehouse_code" value="{{old('warehouse_code')}}" placeholder="Warehouse Name" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('warehouse_code') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="warehouse_phone" value="{{old('warehouse_phone')}}" placeholder="Warehouse Phone" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('warehouse_phone') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="warehouse_email" value="{{old('warehouse_email')}}" placeholder="Email Address" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('warehouse_email') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="warehouse_location" value="{{old('warehouse_location')}}" placeholder="Warehouse Location" class="col-sm-8">
									<p class="error-sms">{{ $errors->first('warehouse_location') }}</p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Save</button>
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
		
		 $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("tr").filter(function() {
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
	</script>
@endpush									