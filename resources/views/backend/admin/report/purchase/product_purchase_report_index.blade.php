@extends('layouts.backend.master')

@section('title', 'Expense Report List')

@push('css')
<!-- bootstrap-datetimepicker -->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
	<style>
		#search-btn{
			margin-top:24px;
		}
		/*thead{
			font-size: 11px;
		}
		tbody{
			font-size: 11px;
		}*/
	</style>
@endpush
@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title"> Purchase Report Product Wise</h4>
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
						<form id="demo-form2" action="{{ route('admin.report.prs')}}" method="post" data-parsley-validate class="form" enctype="multipart/form-data" >
							@csrf
							@method('PUT')
							<div class="row">
								<div class="col-sm-1"></div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>Product List *</label>
										<select name="product_id" id="product_id" class="form-control select2">
											<option value="All">All</option>
											@foreach($products as $pr)
												<option value="{{ $pr->product_id}}">{{ $pr->product_name}} ({{$pr->model_no}})</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>From</label>
										<input id="datepicker-range-start" type="text" name="from_date"  class="form-control" data-zdp_readonly_element="false">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>To</label>
										<input id="datepicker-range-end" type="text" name="to_date"  class="form-control" data-zdp_readonly_element="false">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>Report Type</label>
										<select class="form-control" name="report_type">
											<option value="Purchase">Purchase</option>
											<option value="Return">Return</option>
										</select>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<button class="btn btn-info btn-xs" id="search-btn">
											<i class="ace-icon fa fa-search fa-2x icon-only"></i>
										</button>
									</div>
								</div>
								<div class="col-sm-1">
									<a href="#" id="search-btn" class="btn btn-info btn-xs" onclick="printDiv('printableArea')">
										<i class="ace-icon fa fa-print fa-2x icon-only"></i>
									</a>
								</div>
							</div>
						</form>
						<hr/>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_content" id="printableArea">
									<div class="row">
										<div class="col-xs-12 col-sm-12">
										@if($purchases != '')
											<div class="row">
												<div class="col-xs-1"></div>
												<div class="col-xs-1">
													<img src="{{ asset('storage/about/'.$about->logo)}}" class="img-responsive img-thumbnail" alt="logo" width="85px" height="75px" >
												</div>
												<div class="col-xs-8">
													<div class="text-center">
														<h4>{{$about->english_name}}</h4>
														<h5>Product Purchase Report</h5>
														<p>Product Type: {{$ty}}</p>
														<p>From: {{ date("d-m-Y", strtotime($from))}} - {{ date("d-m-Y", strtotime($to))}}</p>
													</div>
												</div>
												<div class="col-xs-2"></div>
											</div>
											<table class="table table-condensed table-bordered">
												<thead>
													<tr>
														<th>SL</th>
														<th>Date</th>
														<th>Product</th>
														<th>Part No</th>
														<th>Quantity</th>
														<th>Price</th>
													</tr>
												</thead>
												<tbody>
													@php
														$total = 0;
														$quantity = 0;
													@endphp
												@foreach($purchases as $key=>$pur)
													@php
														$total = $total + $pur->purchase_price;
														$quantity = $quantity + $pur->quantity;
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td>{{ date("d-m-Y", strtotime($pur->purchase_date))}}</td>
														
														<td>{{ $pur->product->product_name}}</td>
														<td>{{ $pur->model_no}}</td>
														<td>{{ $pur->quantity}}</td>
														<td>{{ $pur->purchase_price}}</td>
													</tr>
												@endforeach
													<tr>
														<th colspan="3"></th>
														<th>Total=</th>
														<th>{{$quantity}}</th>
														<th>{{$total}}</th>
													</tr>
												</tbody>
											</table>
										@else
											<p align="center">Sory! no data found.</p>
										@endif
										</div>
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

<!-- Jquery Plugin For Date Calender-->
<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.src.js') }}"></script>
<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/examples.js') }}"></script>
<script>
  $(document).ready(function() 
  {
	// select2 section
    $('.select2').select2()	;
	});

  function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
		}
</script>
@endpush
    
 