@extends('layouts.backend.master')

@section('title', 'Permission')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-7">
			<div class="widget-box">
				<div class="widget-header">
					
					<h4 class="widget-title"> <a href="{{ route('admin.permission.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a> permission List</h4>
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
							<form action="{{route('admin.permission.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$permissions->count()}}">{{$permissions->count()}}</option>
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
										<th>Permission Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($permissions as $key=>$cat)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{$cat->name}}</td>
											<td>
												<a  href="{{route('admin.permission.edit',$cat->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deletepermission({{ $cat->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $cat->id }}" action="{{ route('admin.permission.destroy',$cat->id) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form> 
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="text-center">
								{{$permissions->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-5">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Permission Edit</h4>
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
						<form action="{{route('admin.permission.update',$permission->id)}}" method="post" class="form-horizontal" role="form" >
							@csrf
							@method('put')
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Permission Name </label>
								<div class="col-sm-8">
									<input type="text" id="form-field-1-1" name="permission_name" value="{{old('permission_name') ?? $permission->name}}" placeholder="Permission Name" class="form-control">
									<p class="error-sms">{{ $errors->first('permission_name') }}</p>
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
			$("tbody tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		  //
		  $("#show").on("change",function(){
			$("#searchForm").submit(); 
		  })
	})
	
	function deletepermission(id) {
		var conf = confirm('Do you want to really Delete?');
		  if(conf == true)
		  {
			document.getElementById('delete-form-'+id).submit();
		  }
        }
</script>
@endpush									