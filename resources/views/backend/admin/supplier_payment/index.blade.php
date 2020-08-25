@extends('layouts.backend.master')

@section('title', 'Payment')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Supplier Payment List</h4>
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
							<form action="{{route('admin.account.spi')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$payments->count()}}">{{$payments->count()}}</option>
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
										<th>Supplier Name</th>
										<th>Pay Date</th>
										<th>Amount</th>
										<!--<th>Description</th>
										<th>Action</th>-->
									</tr>
								</thead>
								<tbody>
									@foreach($payments as $key=>$ex)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{$ex->supplier->supplier_name}}</td>
											<td>{{date('d-m-Y',strtotime($ex->pay_date))}}</td>
											<td>{{$ex->amount}}</td>
											<!--<td>
												<a  href="{{route('admin.expense.edit',$ex->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $ex->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $ex->id }}" action="{{ route('admin.expense.destroy',$ex->id) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form> 
											</td>-->
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="text-center">
								{{$payments->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Search Purchase</h4>
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
						<form action="{{route('admin.account.spsearch')}}" method="post" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Supplier *</label>
								<div class="col-sm-9">
									<select name="supplier_name"  class="form-control select2">
										<option value="">-Select Supplier-</option>
										@foreach($suppliers as $sup)
											<option value="{{$sup->id}}" {{$sup->id == old('supplier_name') ? 'selected' : ''}}>{{$sup->supplier_name}} ({{$sup->total_due}})</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('supplier_name') }}</p>
								</div>
							</div>
							<!--<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Phone No* </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="phone" value="{{old('phone')}}" placeholder="Supplier Phone No" class="form-control">
									<p class="error-sms">{{ $errors->first('phone') }}</p>
								</div>
							</div>-->

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit"  class="btn btn-xs btn-success">Search</button>
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

		 // search section
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

	</script>
@endpush									