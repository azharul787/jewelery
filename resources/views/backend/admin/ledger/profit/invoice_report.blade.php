@extends('layouts.backend.master')

@section('title', 'Invoice wise Profit')

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
					<h4 class="widget-title">Invoice Wise Profit Report</h4>
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
						<form id="demo-form2" action="{{ route('admin.ledger.iprs')}}" method="post" data-parsley-validate class="form" enctype="multipart/form-data" >
							@csrf
							@method('PUT')
							<div class="row">
								<div class="col-sm-1"></div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>Invoice No *</label>
										<select name="invoice_no" id="invoice_no" class="form-control select2">
											<option value="All">All</option>
											@foreach($invoices as $in)
												<option value="{{ $in->invoice_no}}">{{ $in->invoice_no}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>From</label>
										<input id="datepicker-range-start" type="text" name="from_date"  class="form-control" data-zdp_readonly_element="false">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>To</label>
										<input id="datepicker-range-end" type="text" name="to_date"  class="form-control" data-zdp_readonly_element="false">
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
										@if($sales != '')
											<div class="row">
												<div class="col-xs-1"></div>
												<div class="col-xs-1">
													<img src="{{ asset('storage/about/'.$about->logo)}}" class="img-responsive img-thumbnail" alt="logo" width="85px" height="75px" >
												</div>
												<div class="col-xs-8">
													<div class="text-center">
														<h4>{{$about->english_name}}</h4>
														<h5>Invoice Wise Profit Report</h5>
														<p>Invoice No: {{$ty}}</p>
														<p>From: {{ date("d-m-Y", strtotime($from_date))}} - {{ date("d-m-Y", strtotime($to_date))}}</p>
													</div>
												</div>
												<div class="col-xs-2"></div>
											</div>
											<table class="table table-condensed table-bordered">
												<thead>
													<tr>
														<th>SL</th>
														<th>Date</th>
														<th>Invoice No</th>
														<th>Total Sale</th>
														<th>Discount</th>
														<th>Net.Sale</th>
														<th>Payment</th>
														<th>Due</th>
														<th>Profit</th>
													</tr>
												</thead>
												<tbody>
													@php
														$total_purchase = 0;
														$total_discount = 0;
														$total_np = 0;
														$total_pament = 0;
														$total_due = 0;
														$total_profit = 0;
													@endphp
												@foreach($sales as $key=>$sl)
													@php
														$total_purchase = $total_purchase + $sl->total_price;
														$total_discount = $total_discount + $sl->discount;
														$total_np = $total_np + $sl->grand_total_price;
														$total_pament = $total_pament + $sl->payment;
														$total_due = $total_due + $sl->due_amount;
														/*---------profit calculation-----------*/
														$profit = 0;
														foreach($sl->saleDetail as $sd){
															$sale_qty = $sd->quantity - $sd->return_qty;
															$pro = $sd->unit_price - $sd->purchaseDetail->purchase_price;
															$dis = $sd->discount;
															$profit = $profit + (($sale_qty * $pro) - $dis);
														}
														$total_profit = $total_profit + $profit;
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td>{{ date("d-m-Y", strtotime($sl->sale_date))}}</td>
														<td>{{ $sl->invoice_no}}</td>
														<td>{{ $sl->total_price}}</td>
														<td>{{ $sl->discount + $dis}}</td>
														<td>{{ $sl->grand_total_price}}</td>
														<td>{{ $sl->payment}}</td>
														<td>{{ $sl->due_amount}}</td>
														<td>{{ $profit}}</td>
													</tr>
												@endforeach
													<tr>
														<th colspan="2"></th>
														<th>Total=</th>
														<th>{{$total_purchase}}</th>
														<th>{{$total_discount}}</th>
														<th>{{$total_np}}</th>
														<th>{{$total_pament}}</th>
														<th>{{$total_due}}</th>
														<th>{{$total_profit}}</th>
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
    
 