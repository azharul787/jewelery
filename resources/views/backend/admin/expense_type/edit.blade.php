@extends('layouts.backend.master')

@section('title', 'Expense Category')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-7">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title"> <a href="{{ route('admin.expense_type.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a> Expense Type Edit</h4>
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
							<form action="{{route('admin.expense_type.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$types->count()}}">{{$types->count()}}</option>
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
										<th>Category Name</th>
										<th>Description</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($types as $key=>$category)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{$category->type_name}}</td>
											<td>{{$category->description}}</td>
											<td>
												<a  href="{{route('admin.expense_type.edit',$category->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $category->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $category->id }}" action="{{ route('admin.expense_type.destroy',$category->id) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form> 
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="text-center">
								{{$types->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-5">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Category Edit</h4>
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
						<form action="{{route('admin.expense_type.update',$type->id)}}" method="post" class="form-horizontal" role="form" >
							@csrf
							@method('put')
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Category Name </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="type_name" value="{{old('type_name') ?? $type->type_name}}" placeholder="Category Name" class="form-control">
									<p class="error-sms">{{ $errors->first('type_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Description </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="description" value="{{old('description') ?? $type->description}}" placeholder="Category Name" class="form-control">
									<p class="error-sms">{{ $errors->first('description') }}</p>
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
	
	function deleteCategory(id) {
		var conf = confirm('Do you want to really Delete?');
		  if(conf == true)
		  {
			document.getElementById('delete-form-'+id).submit();
		  }
        }
	</script>
@endpush									