@extends('layouts.backend.master')

@section('title', 'Sale Return')

@push('css')
	
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Sale Return List</h4>
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
							<form action="{{route('admin.sale_return.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$sales->count()}}">{{$sales->count()}}</option>
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
										<th>Customer</th>
										<th>Invoice No</th>
										<th>R. Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($sales as $key=>$ret)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($ret->return_date))}}</td>
											<td><a href="{{route('admin.sale_return.customerReturn',$ret->customer_id)}}" title="See Customer Life Time Return Information">{{$ret->customer->customer_name}}</a></td>
											<td><a href="{{route('admin.sale_return.show',$ret->id)}}" title="See Purchase Return Details Information">{{$ret->invoice_no}}</a></td>
											<td>{{$ret->grand_total_price}}</td>
											<td>
											@can('sale-return-edit')
												<a  href="{{route('admin.sale_return.edit',$ret->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('sale-return-delete')	
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $ret->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $ret->id }}" action="{{ route('admin.sale_return.destroy',$ret->id) }}" method="POST" style="display: none;">
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
								{{$sales->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Search Sale</h4>
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
						<form action="{{route('admin.sale_return.create')}}" method="Get" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Customer <span class="red">*</span></label>
								<div class="col-sm-8">
									<select name="customer_name" id="customer_id" class="form-control select2">
										<option value="">-Select Customer-</option>
										@foreach($customers as $cus)
											<option value="{{$cus->customer_id}}" {{$cus->customer_id == old('customer_name') ? 'selected' : ''}}>{{$cus->customer_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('customer_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Invoice No <span class="red">*</span> </label>
								<div class="col-sm-8">
									<select name="invoice_no" id="invoice_no" class="form-control select2">
										<option value=""> --Select-- </option>
										
									</select> 
									<p class="error-sms">{{ $errors->first('invoice_no') }}</p>
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
		/***-------------get Invoice no from ajax request------------------*/
		$("#customer_id").change(function () {
            var id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.sale_return.getInvoiceNo') }}',
                type: 'POST',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
				console.log(response)
                    var len = response.length;
                    $("#invoice_no").empty();
                    $("#invoice_no").append("<option value=''> Select Invoice No </option>");
                    if (len == 0) {
                        $("#invoice_no").empty();
                        var id = "";
                        var chalan = "";
                        $("#invoice_no").append("<option value='" + chalan + "'>" + chalan + "</option>");
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var chalan = response[i]['invoice_no'];
                        
                        var disable = "";
                        $("#invoice_no").append("<option " + disable + " value='" + chalan + "'>"+chalan+"</option>");
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