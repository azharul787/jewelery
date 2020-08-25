	@extends('layouts.backend.master')

@section('title', 'Warehouse')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-8 col-sm-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Warehouse List</h4>
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
							<form action="{{route('admin.warehouse.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$warehouses->count()}}">{{$warehouses->count()}}</option>
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="250">250</option>
										<option value="500">500</option>
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
							<table id="" class="table table-bordered" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Name</th>
										<th>Code</th>
										<th>Phone</th>
										<th>Email</th>
										<th>Location</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($warehouses as $key=>$sup)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{$sup->warehouse_name}}</td>
											<td>{{$sup->warehouse_code}}</td>
											<td>{{$sup->warehouse_phone}}</td>
											<td>{{$sup->warehouse_email}}</td>
											<td>{{$sup->warehouse_location}}</td>
											<td>
												<a  href="{{route('admin.warehouse.edit',$sup->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $sup->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $sup->id }}" action="{{ route('admin.warehouse.destroy',$sup->id) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form> 
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="text-center">
								{{$warehouses->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Warehouse Edit</h4>
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
						<form action="{{route('admin.warehouse.update',$warehouse->id)}}" method="post" class="form-horizontal" role="form" >
							@csrf
							@method('Put')
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name </label>
								<div class="col-sm-9">
									<input type="text" id="warehouse_name" name="warehouse_name" value="{{old('warehouse_name') ?? $warehouse->warehouse_name}}" placeholder="Warehouse Name" class="form-control">
									<p class="error-sms">{{ $errors->first('warehouse_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Code </label>
								<div class="col-sm-9">
									<input type="text" id="warehouse_code" name="warehouse_code" value="{{old('warehouse_code') ?? $warehouse->warehouse_code}}" placeholder="Warehouse Name" class="form-control">
									<p class="error-sms">{{ $errors->first('warehouse_code') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="warehouse_phone" value="{{old('warehouse_phone') ?? $warehouse->warehouse_phone}}" placeholder="Warehouse Phone" class="form-control">
									<p class="error-sms">{{ $errors->first('warehouse_phone') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="warehouse_email" value="{{old('warehouse_email') ?? $warehouse->warehouse_email}}" placeholder="Email Address" class="form-control">
									<p class="error-sms">{{ $errors->first('warehouse_email') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="warehouse_location" value="{{old('warehouse_location') ?? $warehouse->warehouse_location}}" placeholder="Warehouse Location" class="form-control">
									<p class="error-sms">{{ $errors->first('warehouse_location') }}</p>
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