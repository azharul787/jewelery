@extends('layouts.backend.master')

@section('title', 'Loan Receive Entry')

@push('css')
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-1"></div>
		<div class="col-xs-12 col-sm-10">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Loan Receive</h4>
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
							<div class="col-xs-12 col-sm-1"></div>
							<div class="col-xs-12 col-sm-9">
								<form action="{{route('admin.loan.store')}}" method="post" class="form-horizontal" role="form" >
									@csrf
									<input type="hidden" name="status" value="Credit">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Transaction Date <span class="red">*</span></label>
										<div class="col-sm-9">
											<input id="datepicker" type="text" name="transaction_date"  class="form-control input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
											<p class="error-sms">{{ $errors->first('transaction_date') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Loaner Name <span class="red">*</span></label>
										<div class="col-sm-9">
											<select name="loaner_name"  class="form-control input-sm select2">
												<option value=""> -- Select Loaner -- </option>
												@foreach($loaners as $lo)
													<option value="{{$lo->id}}" {{$lo->id == old('loaner_name') ? 'selected' : ''}}>{{$lo->loaner_name}}</option>
												@endforeach
											</select> 
											<p class="error-sms">{{ $errors->first('loaner_name') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Loan Amount <span class="red">*</span></label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="loan_amount" value="{{old('loan_amount')}}" placeholder="Loan Amount" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('loan_amount') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Note </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="note" value="{{old('note')}}" placeholder="Note About Something" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('note') }}</p>
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
							<div class="col-xs-12 col-sm-2"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-1"></div>
	</div>
@endsection

@push('js')
<!-- Jquery Plugin For Date Calender-->
	<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.src.js') }}"></script>
<script>
	$(document).ready(function(){
		// calender section
		 $('#datepicker').Zebra_DatePicker({
			format: 'd-m-Y',
			direction:1,
		});
		 $('.select2').select2();
		 // search section
	})
	</script>
@endpush									