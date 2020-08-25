@extends('layouts.backend.master')

@section('title', 'Order Return')

@push('css')
	
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Worker Order Return List</h4>
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
							<form action="{{route('admin.purchase_return.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$orders->count()}}">{{$orders->count()}}</option>
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
										<th>Return Date</th>
										<th>Supplier</th>
										<th>Chalan No</th>
										<th>Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($orders as $key=>$ret)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($ret->return_date))}}</td>
											<td>{{$ret->worker->name}}</a></td>
											<td><a href="{{route('admin.worker_order_return.show',$ret->id)}}" title="See Order Return Details Information">{{$ret->order_no}}</a></td>
											<td>{{$ret->wage}}</td>
											<td>
											@can('worker-order-edit')
												<a  href="{{route('admin.worker_order_return.edit',$ret->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('worker-return-delete')	
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $ret->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $ret->id }}" action="{{ route('admin.worker_order_return.destroy',$ret->id) }}" method="POST" style="display: none;">
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
								{{$orders->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Search Order</h4>
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
						<form action="{{route('admin.worker_order.worker_order_search')}}" method="Get" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Worker <span class="red">*</span></label>
								<div class="col-sm-8">
									<select name="worker_name" id="worker_id" class="form-control select2">
										<option value="">-Select Worker-</option>
										@foreach($workers as $w)
											<option value="{{$w->id}}" {{$w->id == old('worker_name') ? 'selected' : ''}}>{{$w->name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('worker_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Order No <span class="red">*</span> </label>
								<div class="col-sm-8">
									<select name="order_id" id="order_no" class="form-control select2">
										<option value="">-Select Worker-</option>
										
									</select> 
									<p class="error-sms">{{ $errors->first('order_no') }}</p>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Search</button>
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

		/***-------------get chalan no from ajax request------------------*/
		$("#worker_id").change(function () {

            var id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.worker_order.getOrderNo') }}',
                type: 'Get',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
				console.log(response)
                    var len = response.length;
                    $("#chalan_no").empty();
                    $("#chalan_no").append("<option value=''> Select Order No </option>");
                    if (len == 0) {
                        $("#chalan_no").empty();
                        var id = "";
                        var chalan = "";
                        $("#chalan_no").append("<option value='" + chalan + "'>" + chalan + "</option>");
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var chalan = response[i]['order_no'];
                        
                        var disable = "";
                        $("#order_no").append("<option " + disable + " value='" + id + "'>"+chalan+"</option>");
                    }
                }
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