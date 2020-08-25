@extends('layouts.backend.master')

@section('title', 'Manage Bank Entry')

@push('css')
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Bank Name Information Entry</h4>
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
							<div class="col-xs-12 col-sm-2"></div>
							<div class="col-xs-12 col-sm-8">
								<form action="{{route('admin.bank.store')}}" method="post" class="form-horizontal" role="form" >
									@csrf
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bank Name <span class="red">*</span></label>
										<div class="col-sm-9">
											<input type="text" name="bank_name"  class="form-control input-sm"  value="{{ old('bank_name')}}" placeholder=" Bank Name">
											<p class="error-sms">{{ $errors->first('bank_name') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Account No <span class="red">*</span></label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="account_no" value="{{old('account_no')}}" placeholder="Bank Account No" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('account_no') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Branch Name <span class="red">*</span></label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="branch_name" value="{{old('branch_name')}}" placeholder="Branch Name" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('branch_name') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Branch Location </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="bank_location" value="{{old('bank_location')}}" placeholder="Branch Location" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('bank_location') }}</p>
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
	})

	</script>
@endpush									