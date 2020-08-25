@extends('layouts.backend.master')

@section('title', 'Setting Information')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Global Setting Information</h4>
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
						<form id="demo-form2" action="{{ route('admin.setting.update',setting()->id)}}" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
							@csrf
							@method('PUT')
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-4" for="sale_profit_percentage">Sale Profit Percentage <span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<input type="text" id="sale_profit_percentage" name="sale_profit_percentage" required="required" class="form-control col-md-7 col-xs-12" value="{{setting()->sale_profit_percentage}}">
									<p class="error-sms">{{ $errors->first('sale_profit_percentage') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-4" for="vat_percentage">Vat Percentage <span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<input type="text" id="vat_percentage" name="vat_percentage" required="required" class="form-control col-md-7 col-xs-12" value="{{setting()->vat_percentage}}" required>
									<p class="error-sms">{{ $errors->first('vat_percentage') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="per_10_gram_price" class="control-label col-md-4 col-sm-4 col-xs-4">Per 10 Gram Price <span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<input id="per_10_gram_price" class="form-control col-md-7 col-xs-12" type="text" name="per_10_gram_price" value="{{setting()->per_10_gm_price}}" required>
									<p class="error-sms">{{ $errors->first('per_10_gram_price') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-4">Customer Wage Per Gram<span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<input id="" class="date-picker form-control col-md-7 col-xs-12" name="customer_wage_per_gram" required="required" type="text" placeholder="xxxx" value="{{setting()->customer_wage_per_gram}}">
									<p class="error-sms">{{ $errors->first('customer_wage_per_gram') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-4">Worker Wage Per Gram <span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-4">
									  <input type="text" class="form-control" name="worker_wage_per_gram" placeholder="" value="{{setting()->worker_wage_per_gram}}">
									<p class="error-sms">{{ $errors->first('worker_wage_per_gram') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-4">Default Data Show Per Page In pagination<span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<input type="text"  name="ddspinp" class="form-control col-md-7 col-xs-12" value="{{setting()->ddspinp}}" >
									<p class="error-sms">{{ $errors->first('ddspinp') }}</p>
								</div>
							</div>
							<!--<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Web<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text"  name="web" class="date-picker form-control col-md-7 col-xs-12" value="" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="" name="address" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">setting<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea id="" name="setting" class="date-picker form-control col-md-7 col-xs-12" ></textarea>
								</div>
							</div>-->
							<hr/>	
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
									<a href="{{ route('admin.setting.edit')}}" class="btn btn-xs btn-danger">Cancel</a>
									<button class="btn btn-xs btn-warning" type="reset">Reset</button>
									<button type="submit" class="btn btn-xs btn-success">Update</button>
								</div>
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
<script>
	$(document).ready(function(){
		
		
	})
</script>
@endpush									