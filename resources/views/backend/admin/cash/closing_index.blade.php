@extends('layouts.backend.master')

@section('title', 'Cash Closing')

@push('css')
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
	<style type="text/css">
		label.col-sm-4.control-label.no-padding-right {
		    text-align: left;
		}
	</style>
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-7">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Cash Closing</h4>
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
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<form action="{{route('admin.cash.closing_save')}}" method="post" class="form-horizontal" role="form" >
									@csrf
									@method('POST')
									<input type="hidden" name="status" value="Credit">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Closing Date <span class="red">*</span></label>
										<div class="col-sm-8">
											<input id="" type="text" name="closing_date"  class="form-control input-sm" readonly="" value="{{ date('d-m-Y',strtotime($closing_date))}}" placeholder="dd-mm-yyyy">
											<p class="error-sms">{{ $errors->first('closing_date') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Last Day Closing <span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" id="form-field-1-1" name="lastday_balance" value="{{old('lastday_balance') ?? $lastday_cash != '' ? $lastday_cash->balance : '0' }}" readonly placeholder="Last Day Closing Balance" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('lastday_balance') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Total Receipt <span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" id="form-field-1-1" name="receipt" value="{{old('receipt') ?? $receipt}}" readonly placeholder="Today's Total Receipt" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('receipt') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Total Payment <span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" id="form-field-1-1" name="payment" value="{{old('payment') ?? $payment }}" readonly placeholder="Today's Total Payment" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('payment') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Balance </label>
										<div class="col-sm-8">
											<input type="text" id="form-field-1-1" name="current_balance" value="{{old('current_balance') ?? ($lastday_cash != '' ? $lastday_cash->balance : '0') + ($receipt - $payment)}}" readonly placeholder="Now Balance" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('current_balance') }}</p>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
										  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
										  <button type="submit" class="btn btn-xs btn-success">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-5">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Search Closing</h4>
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
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<form action="{{route('admin.cash.closing_index')}}" method="Post" class="form-horizontal" role="form" >
									@csrf
									@method('Get')
									<input type="hidden" name="status" value="Search">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Closing Date <span class="red">*</span></label>
										<div class="col-sm-8">
											<input id="datepicker" type="text" name="closing_date"  class="datepicker form-control input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
											<p class="error-sms">{{ $errors->first('closing_date') }}</p>
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
		</div>
	</div>
@endsection

@push('js')
<!-- Jquery Plugin For Date Calender-->
	<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.src.js') }}"></script>
<script>
	$(document).ready(function(){
		// calender section
		 $('#datepicker').Zebra_DatePicker({
			format: 'd-m-Y'
		});
		$('#datepicker2').Zebra_DatePicker({
			format: 'd-m-Y'
		});
	})
	</script>
@endpush									