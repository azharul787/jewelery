@extends('layouts.backend.master')

@section('title', 'Cash Closing')

@push('css')
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
	<style type="text/css">
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
					<h4 class="widget-title">
						<a href="{{ route('admin.cash.closing_index')}}" calss="btn" >
							<i class="fa fa-mail-reply"></i>
						</a>
						Cash Closing Report</h4>
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
						<form id="demo-form2" action="{{ route('admin.cash.closing_search')}}" method="post" data-parsley-validate class="form" enctype="multipart/form-data" >
							@csrf
							@method('POST')
							<div class="row">
								<div class="col-sm-2"></div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>From</label>
										<input id="datepicker-range-start" type="text" name="from_date"  class="form-control" value="{{ date('d-m-Y', strtotime($from_date))}}" data-zdp_readonly_element="false" placeholder="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>To</label>
										<input id="datepicker-range-end" type="text" name="to_date"  class="form-control"value="{{ date('d-m-Y', strtotime($to_date))}}" data-zdp_readonly_element="false" placeholder="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<button class="btn btn-success btn-xs" id="search-btn">
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
														<h5>Cash Closing Report</h5>
														<p>From: {{ date("d-m-Y", strtotime($from_date))}} - {{ date("d-m-Y", strtotime($to_date))}}</p>
													</div>
												</div>
												<div class="col-xs-2"></div>
											</div>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>SL</th>
														<th>Date</th>
														<th>Lastday Balance</th>
														<th>Receipt</th>
														<th>Payment</th>
														<th>Balance</th>
													</tr>
												</thead>
												<tbody>
													@php
														$receipt = 0;
														$payment = 0;
													@endphp
												@foreach($cashs as $key=>$cs)
													@php
														$receipt = $receipt + $cs->receipt;
														$payment = $payment + $cs->payment;
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td>{{ date("d-m-Y", strtotime($cs->closing_date))}}</td>
														<td>{{ $cs->lastday_balance}}</td>
														<td>{{ $cs->receipt}}</td>
														<td>{{ $cs->payment}}</td>
														<td>{{ $cs->balance}}</td>
													</tr>
												@endforeach
													<tr>
														<th colspan="2"></th>
														<th>Total=</th>
														<th>{{$receipt}}</th>
														<th>{{$payment}}</th>
														<th>{{$receipt - $payment}}</th>
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
@endsection

@push('js')
<!-- Jquery Plugin For Date Calender-->
<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.src.js') }}"></script>
<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/examples.js') }}"></script>
<script>
	 function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
		}
</script>
@endpush									