@extends('layouts.backend.master')

@section('title', 'Union')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-8 col-sm-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title"> <a href="{{ route('admin.union.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a> Union List</h4>
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
							<form action="{{route('admin.union.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$unions->count()}}">{{$unions->count()}}</option>
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
										<th>Union </th>
										<th>Upozila</th>
										<th>Distric</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($unions as $key=>$un)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{ $un->union_name}}</td>
											<td>{{ $un->upozila->upozila_name}}</td>
											<td>{{ $un->upozila->distric->distric_name}}</td>
											<td>
												@can('union-edit')
												<a  href="{{route('admin.union.edit',$un->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
												@endcan
												@can('union-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $un->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $un->id }}" action="{{ route('admin.union.destroy',$un->id) }}" method="POST" style="display: none;">
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
								{{$unions->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Union Edit</h4>
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
						<form action="{{route('admin.union.store')}}" method="post" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Distric Name </label>
								<div class="col-sm-8">
									<select class="form-control select2 " name="distric_name" id="distric_id">
										<option value="">-Select-</option>
										@foreach($districs as $dis)
											<option value="{{$dis->id}}" {{$dis->id == $union->upozila->distric_id ? 'selected' : ''}}>{{$dis->distric_name}}</option>
										@endforeach
									</select>  
									<p class="error-sms">{{ $errors->first('distric_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Upozila Name </label>
								<div class="col-sm-8">
									<select class="form-control select2 " name="upozila_name" id="upozila_id">
										<option value="{{$union->upozila_id}}">{{$union->upozila->upozila_name}}</option>
									</select>  
									<p class="error-sms">{{ $errors->first('upozila_name') }}</p>
								</div>
							</div>  
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Union Name </label>
								<div class="col-sm-8">
									<input type="text" id="form-field-1-1" name="union_name" value="{{old('union_name') ?? $union->union_name}}" placeholder="Union Name" class="form-control">
									<p class="error-sms">{{ $errors->first('union_name') }}</p>
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
		/*--------------------*/
		
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

        // dependency dropdown of Village name
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
	</script>
@endpush									