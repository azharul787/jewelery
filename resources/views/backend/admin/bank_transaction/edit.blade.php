@extends('layouts.backend.master')

@section('title', 'Bank Transaction Entry')

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
					<h4 class="widget-title"> 
						<a href="{{ route('admin.bank_transaction.index')}}" calss="btn" >
						<i class="fa fa-mail-reply"></i></a> 
						Bank Transaction Edit
					</h4>
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
								<form action="{{route('admin.bank_transaction.update',$bankt->id)}}" method="post" class="form-horizontal" role="form" >
									@csrf
                                    @method('PUT')
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Transaction Date <span class="red">*</span></label>
										<div class="col-sm-9">
											<input id="datepicker" type="text" name="transaction_date"  class="form-control input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y', strtotime($bankt->transaction_date))}}" placeholder="dd-mm-yyyy">
											<p class="error-sms">{{ $errors->first('transaction_date') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bank Name <span class="red">*</span></label>
										<div class="col-sm-9">
											<select name="bank_name"  class="form-control input-sm select2">
												<option value="">-Select Bank-</option>
												@foreach($banks as $bank)
													<option value="{{$bank->id}}" {{$bank->id == $bankt->bank_id ? 'selected' : ''}}>{{$bank->bank_name}}</option>
												@endforeach
											</select> 
											<p class="error-sms">{{ $errors->first('bank_name') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Account No </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="account_no" value="{{old('account_no') ?? $bankt->account_no}}" placeholder="Transaction Account No" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('account_no') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Cheque No </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="cheque_no" value="{{old('cheque_no') ?? $bankt->cheque_no}}" placeholder="Transaction Cheque No" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('cheque_no') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Transaction Amount <span class="red">*</span></label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="transaction_amount" value="{{old('transaction_amount') ?? $bankt->transaction_amount}}" placeholder="Transaction Amount" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('transaction_amount') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bank Transaction Status <span class="red">*</span></label>
										<div class="col-sm-9">
											<select name="transaction_status"  class="form-control input-sm select2">
												<option value="">-Select Transaction Status-</option>
												<option value="Deposit" {{$bankt->transaction_status == 'Deposit' ? 'selected' : ''}}>Deposit</option>
												<option value="Withdraw" {{$bankt->transaction_status  == 'Withdraw' ? 'selected' : ''}}>Withdraw</option>
											</select> 
											<p class="error-sms">{{ $errors->first('transaction_status') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Note </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="note" value="{{old('note') ?? $bankt->note}}" placeholder="Note About Something" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('note') }}</p>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
										  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
										  <button type="submit" class="btn btn-xs btn-success">Update</button>
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
			format: 'd-m-Y'
		});
		 $('.select2').select2();
		 // search section
	})

	</script>
@endpush									