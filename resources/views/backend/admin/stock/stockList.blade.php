@extends('layouts.backend.master')

@section('title', 'Stock List')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Stock List</h4>
					<span class="widget-toolbar">
						<a href="#" onclick="printDiv('printableArea')">
							<i class="ace-icon fa fa-print"></i>
						</a>
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
							<form action="{{route('admin.stock.stocks')}}" id="searchForm" method="Post">
								@csrf
								@method('PUT')
								<div class="col-sm-2">
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Search By</label>
										<div class="col-sm-9">
											<select class="form-control" name="search_by" id="show">
												<option value="product_name">Product Name</option>
												<option value="model_no">Part Number</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Search Value</label>
										<div class="col-sm-8">
											<div class="input-group">
												<input type="text" id="" name="search_value" class="form-control" placeholder="Search Value">
												<span class="input-group-btn">
													<button type="submit" class="btn btn-purple btn-sm">
													<span class="ace-icon fa fa-search icon-on-right bigger-110"></span></button>
												</span>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="">
								<div class="col-sm-12">
										<div class="input-group">
											<input type="text" id="myInput" class="form-control" placeholder="Search">
											<span class="input-group-btn">
												<button type="button" class="btn btn-purple btn-sm">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span></button>
											</span>
										</div>
								</div>
							</div><br/>
						<hr/>
						<div class="table-content" id="printableArea">
							<div class="text-center">
								<h5>{{$about->bangla_name}}</h5>
								{{$about->address}}<br/>
								Warehouse: {{$warehouse != '' ? $warehouse->warehouse_name : 'All'}}<br/>
							</div>
							<br/>
							<table id="" class="table table-bordered table-condensed" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Product</th>
										<th>Part No</th>
										<!--<th>Rack No</th>-->
										<th>Category</th>
										<th>Brand</th>
										<th>Unit</th>
										<th>Stock</th>
										<!--<th>Action</th>-->
									</tr>
								</thead>
								<tbody>
									@php
										$total_stock = 0;
									@endphp
									@foreach($products as $key=>$pro)
										@php
											$total_stock = $total_stock + $pro->product_stock;
										@endphp
										<tr class="{{$pro->product_stock < $pro->re_order_label ? 'red' : ''}} ">
											<td>{{$key + 1}}</td>
											<td>{{$pro->product_name}}</td>
											<td>{{$pro->model_no}}</td>
											{{--<td>{{$pro->rack_no}}</td>--}}
											<td>{{$pro->category_name}}</td>
											<td>{{$pro->brand_name}}</td>
											<td>{{$pro->unit_name}}</td>
											<td>{{$pro->product_stock}}</td>
											<!--<td>
											@can('stock-list')
												<a  href="{{route('admin.order.create')}}" title="Order the Product"><i class="ace-icon fa fa-shopping-cart bigger-130"></i></a>
											@endcan
											</td>-->
										</tr>
									@endforeach
										<tr>
											<td colspan="5"></td>
											<td>Total =</td>
											<td>{{$total_stock}}</td>
										</tr>
								</tbody>
							</table>
							<div class="text-center">
							
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
		// select2 section
		$('.select2').select2()	;
		/*-------search section------------*/
		 $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("tbody tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		  //
		 /* $("#show").on("change",function(){
			$("#searchForm").submit(); 
		  })*/

	})
	/*---------print section-------------*/
	function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
		}
	</script>
@endpush									