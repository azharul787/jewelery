@extends('layouts.backend.master')

@section('title', 'Income Expense Report')

@push('css')
<!-- bootstrap-datetimepicker -->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
	<style>
		#search-btn{
			margin-top:24px;
		}
	</style>
@endpush
@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title"> Income Expense Report</h4>
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
						<form id="demo-form2" action="{{ route('admin.ledger.income_expenses')}}" method="post" data-parsley-validate class="form" enctype="multipart/form-data" >
							@csrf
							@method('POST')
							<div class="row">
								<div class="col-sm-2"></div>
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
								<div class="col-sm-2">
									<a href="#" id="search-btn" class="btn btn-xs btn-info" onclick="printDiv('printableArea')">
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
											<div class="row">
												<div class="col-xs-1"></div>
												<div class="col-xs-1">
													<img src="{{ asset('storage/about/'.$about->logo)}}" class="img-responsive img-thumbnail" alt="logo" width="85px" height="75px" >
												</div>
												<div class="col-xs-8">
													<div class="text-center">
														<h4>{{$about->english_name}}</h4>
														<p>Income Expense Report</p>
														<p>From: {{ date("d-m-Y", strtotime($from))}} - {{ date("d-m-Y", strtotime($to))}}</p>
													</div>
												</div>
												<div class="col-xs-2"></div>
											</div>
											<div class="row">
												<div class="col-xs-6">
													<table class="table table-bordered">
														<thead>
															<tr>
																<th>SL</th>
																<th>Date</th>
																<th>Description</th>
																<th>Income</th>
															</tr>
														</thead>
														<tbody>
															@php
																$total = 0;
																$ex_total = 0;
															@endphp
														@foreach($incomes as $key=>$in)
															@php
																$total = $total + $in->amount;
															@endphp
															<tr>
																<td>{{ $key + 1}}</td>
																<td>{{ date("d-m-Y", strtotime($in->ca_date))}}</td>
																<td>{{ $in->customer->customer_name}}</td>
																<td>{{ $in->amount}}</td>
															</tr>
														@endforeach
															<tr>
																<th colspan="2"></th>
																<th>Income Total=</th>
																<th>{{$total}}</th>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="col-xs-6">
													<table class="table table-bordered">
														<thead>
															<tr>
																<th>SL</th>
																<th>Date</th>
																<th>Description</th>
																<th>Expense</th>
															</tr>
														</thead>
														<tbody>
															@php
																
																$ex_total = 0;
															@endphp
														@foreach($expenses as $key=>$ex)
															@php
																$ex_total = $ex_total + $ex['amount'];
															@endphp
															<tr>
																<td>{{ $key + 1}}</td>
																<td>{{ date("d-m-Y", strtotime($ex['pay_date']))}}</td>
																<td>{{ $ex['description']}}</td>
																<td>{{ $ex['amount']}}</td>
															</tr>
														@endforeach
															<tr>
																<th colspan="2"></th>
																<td>Expense Total</td>
																<td>{{$ex_total}}</td>
															</tr>
														</tbody>
													</table>
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
    
 