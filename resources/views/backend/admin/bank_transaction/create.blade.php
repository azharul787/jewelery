@extends('layouts.backend.master')

@section('title', 'Bank Transaction Entry')

@push('css')
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Bank Transaction Entry</h4>
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
								<form action="{{route('admin.bank_transaction.store')}}" method="post" class="form-horizontal" role="form" >
									@csrf
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Transaction Date <span class="red">*</span></label>
										<div class="col-sm-9">
											<input id="datepicker" type="text" name="transaction_date"  class="form-control input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
											<p class="error-sms">{{ $errors->first('transaction_date') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bank Name <span class="red">*</span></label>
										<div class="col-sm-9">
											<select name="bank_name" id="bank_id" class="form-control input-sm select2">
												<option value="">-Select Bank-</option>
												@foreach($banks as $bank)
													<option value="{{$bank->id}}" {{$bank->id == old('bank_name') ? 'selected' : ''}}>{{$bank->bank_name}}</option>
												@endforeach
											</select> 
											<p class="error-sms">{{ $errors->first('bank_name') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="account_no">Account No </label>
										<div class="col-sm-9">
											<input type="text" id="account_no" name="account_no" value="{{old('account_no')}}" readonly="readonly" placeholder="Transaction Account No" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('account_no') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bank Transaction Status <span class="red">*</span></label>
										<div class="col-sm-9">
											<select name="transaction_status"  class="form-control input-sm select2">
												<option value="">-Select Transaction Status-</option>
												<option value="Deposit" {{old('transaction_status') == 'Deposit' ? 'selected' : ''}}>Deposit</option>
												<option value="Withdraw" {{old('transaction_status') == 'Withdraw' ? 'selected' : ''}}>Withdraw</option>
											</select> 
											<p class="error-sms">{{ $errors->first('transaction_status') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Cheque No/Receipt No </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="cheque_no" value="{{old('cheque_no')}}" placeholder="Transaction Cheque/Receipt No" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('cheque_no') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Transaction Amount <span class="red">*</span></label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="transaction_amount" value="{{old('transaction_amount')}}" placeholder="Transaction Amount" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('transaction_amount') }}</p>
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
							<div class="col-xs-12 col-sm-3"></div>
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
			format: 'd-m-Y',
			direction:-1,
		});
		 /*-----select2 section---------*/
		$('.select2').select2();
		// search section
		/*---------------Account no show section-----------------*/
		$(document).on('change','#bank_id',function(){
			var bank_id = $(this).val();
			var token = "{{csrf_token()}}";
				$.ajax({
					url: '{{ route('admin.bank_transaction.accountNo') }}',
					type: 'GET',
					data: {bank_id:bank_id, '_token' : token},
					dataType: 'json',
					success: function (response) {					
					//console.log(response)
					$('#account_no').val(response.account_no)
				}
			});
		});
	})
	</script>
@endpush									