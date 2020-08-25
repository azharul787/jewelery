	@extends('layouts.backend.master')

@section('title', 'Warehouse')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
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
							<table id="" class="table table-bordered table-condensed" role="grid" aria-describedby="dynamic-table_info">
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
											@can('warehouse-edit')
												<a  href="{{route('admin.warehouse.edit',$sup->id)}}" title="Edit Warehouse Information"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('warehouse-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Warehouse Information!" onclick="deleteCategory({{ $sup->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $sup->id }}" action="{{ route('admin.warehouse.destroy',$sup->id) }}" method="POST" style="display: none;">
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
								{{$warehouses->links()}}
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
	</script>
@endpush									