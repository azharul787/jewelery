@extends('layouts.backend.master')

@section('title', 'Roles List')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title"> <a href="{{ route('admin.roles.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a> Role List</h4>
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
						<div class="row">
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li >
										<a data-toggle="tab" href="#list">
											<i class="green ace-icon fa fa-user bigger-120"></i>
											Roles List
											<span class="badge badge-success">{{$roles->count()}}</span>
										</a>
									</li>
									<li class="active">
										<a data-toggle="tab" href="#edit">
											<i class="green ace-icon fa fa-edit bigger-120"></i>
											Role Edit
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#new">
											<i class="green ace-icon fa fa-plus bigger-120"></i>
											New Role
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="list" class="tab-pane fade">
										<div class="row search-section">
											<form action="{{route('admin.roles.index')}}" id="searchForm" method="Get">
												<div class="col-sm-2">
													<select class="form-control" name="show" id="show">
														<option value="{{$roles->count()}}">{{$roles->count()}}</option>
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
														<th>Role Name</th>
														<th>Edit</th>
														<th>Delete</th>
													</tr>
												</thead>
												<tbody>
													@foreach($roles as $key=>$rol)
														<tr>
															<td>{{$key + 1}}</td>
															<td>{{$rol->name}}</td>
															<td>
															@can('role-edit')
																<a  href="{{route('admin.roles.edit',$rol->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
															@endcan
															</td>
															<td>
															@can('role-delete')
																<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $rol->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
																<form id="delete-form-{{ $rol->id }}" action="{{ route('admin.roles.destroy',$rol->id) }}" method="POST" style="display: none;">
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
												{{$roles->links()}}
											</div>
										</div>
									</div>
									<div id="edit" class="tab-pane fade in active">
										<!--<form action="{{route('admin.roles.update',$role->id)}}" method="post" class="form-horizontal" role="form" >
											@csrf-->
										{!! Form::model($role, ['method' => 'PATCH','route' => ['admin.roles.update', $role->id]]) !!}
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Role Name </label>
												<div class="col-sm-8">
													<input type="text" id="form-field-1-1" name="role_name" value="{{old('role_name') ?? $role->name}}" placeholder="Role Name" class="col-sm-6">
													<p class="error-sms">{{ $errors->first('role_name') }}</p>
												</div>
											</div>
											<h4>Permissions List: 
												<span class="badge badge-success">{{$permissions->count()}}</span>
											</h4>
											<div class="input-group">
												<input type="text" class="form-control" id="myInput2" placeholder="Search the Permission name">
												<span class="input-group-btn">
													<button type="button" class="btn btn-purple btn-sm">
													<span class="ace-icon fa fa-search icon-on-right bigger-110"></span></button>
												</span>
											</div>
											<hr/>
											<div class="ro">
												@foreach($permissions as $val)
												<div class="col-sm-3">
													<div class="form-group">
														<label>
															<!--<input name="permission[]" value="{{$val->id}}" @php in_array($val->id,$rolePermissions ) @endphp class="ace input-lg" type="checkbox">
															<span class="lbl bigger-120">  {{$val->name}}</span> -->
															{{ Form::checkbox('permission[]', $val->id, in_array($val->id, $rolePermissions) ? true : false, array('class' => 'ace input-lg')) }}
															<span class="lbl bigger-120">  {{$val->name}}</span>
														</label>
													</div>
												</div>
												@endforeach
											</div>
											<hr/>
											<div class="form-group">
												<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
												  <a href="{{route('admin.roles.index')}}" class="btn btn-xs btn-danger">Cancel</a>
												  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
												  <button type="submit" class="btn btn-xs btn-success">Update</button>
												</div>
											</div>
										{!! Form::close() !!}
									</div>
									<div id="new" class="tab-pane fade">
										<form action="{{route('admin.roles.store')}}" method="post" class="form-horizontal" role="form" >
											@csrf
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Role Name </label>
												<div class="col-sm-8">
													<input type="text" id="form-field-1-1" name="role_name" value="{{old('role_name')}}" placeholder="Role Name" class="col-sm-6">
													<p class="error-sms">{{ $errors->first('role_name') }}</p>
												</div>
											</div>
											<h4>Permissions List: 
												<span class="badge badge-success">{{$permissions->count()}}</span>
											</h4>
											<div class="input-group">
												<input type="text" class="form-control" id="myInput2" placeholder="Search the Permission name">
												<span class="input-group-btn">
													<button type="button" class="btn btn-purple btn-sm">
													<span class="ace-icon fa fa-search icon-on-right bigger-110"></span></button>
												</span>
											</div>
											<hr/>
											<div class="ro">
												@foreach($permissions as $value)
												<div class="col-sm-3">
													<div class="form-group">
														<label>
															<input name="permission[]" value="{{$value->id}}" class="ace input-lg" type="checkbox">
															<span class="lbl bigger-120">  {{ $value->name }} </span>
														</label>
													</div>
												</div>
												@endforeach
											</div>
											<hr/>
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
		  // entry section
		  $("#myInput2").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("label").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
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