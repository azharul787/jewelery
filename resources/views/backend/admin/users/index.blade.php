@extends('layouts.backend.master')

@section('title', 'Users List')

@push('css')

@endpush

@section('content')
	<div class="row">
	@can('user-list')
		<div class="col-xs-12 col-sm-7">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">User List</h4>
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
							<form action="{{route('admin.users.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$users->count()}}">{{$users->count()}}</option>
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
										<th>User Name</th>
										<th>Email</th>
										<th>Roles</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $key=>$us)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{$us->name}}</td>
											<td>{{$us->email}}</td>
											<td>
											  @if(!empty($us->getRoleNames()))
												@foreach($us->getRoleNames() as $v)
												   <label class="badge badge-success">{{ $v }}</label>
												@endforeach
											  @endif
											</td>
											<td>
											@can('user-edit')
												<a  href="{{route('admin.users.edit',$us->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('user-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $us->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $us->id }}" action="{{ route('admin.users.destroy',$us->id) }}" method="POST" style="display: none;">
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
								{{$users->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endcan
	@can('user-entry')
		<div class="col-xs-12 col-sm-5">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">User Entry</h4>
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
						{!! Form::open(array('route' => 'admin.users.store','method'=>'POST','class'=>'form-horizontal form-label-left')) !!}
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Full Name <span class="required">*</span></label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" id="first-name" name="name" value="{{old('name')}}" required="required" class="form-control col-md-7 col-xs-12" placeholder="User Full Name">
									<p class="error-sms">{{ $errors->first('name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="last-name">Email<span class="required">*</span></label>
									<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="email" id="last-name" name="email" value="{{old('email')}}"  required="required" class="form-control col-md-7 col-xs-12" placeholder="User Email">
									<p class="error-sms">{{ $errors->first('email') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Password</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input id="middle-name" class="form-control col-md-7 col-xs-12" type="password" name="password" value="{{old('password')}}" placeholder="xxxxxxxx" >
									<p class="error-sms">{{ $errors->first('password') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Confirm Password</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
								  <input id="middle-name" class="form-control col-md-7 col-xs-12" type="password" name="confirm-password" value="{{old('confirm-password')}}" placeholder="Re-type to confirm password">
								<p class="error-sms">{{ $errors->first('confirm-password') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Role</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
									{!! Form::select('roles[]', $roles,[], array('class' => 'form-control col-md-7 col-xs-12','multiple')) !!}
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Save</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	@endcan
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