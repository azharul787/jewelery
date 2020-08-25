@extends('layouts.backend.master')

@section('title', 'Expense Entry')

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
					<h4 class="widget-title">Expense Entry</h4>
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
								<form action="{{route('admin.expense.store')}}" method="post" class="form-horizontal" role="form" >
									@csrf
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date *</label>
										<div class="col-sm-9">
											<input id="datepicker" type="text" name="expense_date"  class="form-control input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
											<p class="error-sms">{{ $errors->first('expense_date') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ex. Type *</label>
										<div class="col-sm-9">
											<select name="type_name"  class="form-control input-sm select2">
												<option value="">-Select Type-</option>
												@foreach($types as $ty)
													<option value="{{$ty->id}}" {{$ty->id == old('type_name') ? 'selected' : ''}}>{{$ty->type_name}}</option>
												@endforeach
											</select> 
											<p class="error-sms">{{ $errors->first('type_name') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Amount </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="expense_amount" value="{{old('expense_amount')}}" placeholder="Expense Amount" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('expense_amount') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Description </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1-1" name="description" value="{{old('description')}}" placeholder="Expense Description" class="form-control input-sm">
											<p class="error-sms">{{ $errors->first('description') }}</p>
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
		 $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("tbody tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		  //
		  $("#show").on("change",function(){
			$("#searchForm").submit(); 
		  })
	})
	
	function deleteCategory(id) {
		var conf = confirm('Do you want to really Delete?');
		  if(conf == true)
		  {
			document.getElementById('delete-form-'+id).submit();
		  }
        }
	</script>
@endpush									