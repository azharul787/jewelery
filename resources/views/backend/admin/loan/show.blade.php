@extends('layouts.backend.master')

@section('title', 'Loan Transaction Report')

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
					<h4 class="widget-title">
						<a href="{{ route('admin.loan.index')}}" calss="btn" >
							<i class="fa fa-mail-reply"></i>
						</a>
						Loan Transaction Report</h4>
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
						<form id="demo-form2" action="{{ route('admin.loan.ltlist')}}" method="post" data-parsley-validate class="form" enctype="multipart/form-data" >
							@csrf
							@method('POST')
							<div class="row">
								<div class="col-sm-2"></div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>Person Name *</label>
										<select name="loaner_id" id="bank_id" class="form-control select2" required>
											<option value=""> -- Select Person -- </option>
											@foreach($loaners as $bk)
												<option value="{{ $bk->id}}" {{$bk->id == $loan->id ? 'selected' : ''}}>{{ $bk->loaner_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>From</label>
										<input id="datepicker-range-start" type="text" name="from_date"  class="form-control" value="{{ date('d-m-Y', strtotime($from_date))}}" data-zdp_readonly_element="false" placeholder="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>To</label>
										<input id="datepicker-range-end" type="text" name="to_date"  class="form-control"value="{{ date('d-m-Y', strtotime($to_date))}}" data-zdp_readonly_element="false" placeholder="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-sm-1">
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
										@if($transactions != '')
											<div class="row">
												<div class="col-xs-1"></div>
												<div class="col-xs-1">
													<img src="{{ asset('storage/about/'.$about->logo)}}" class="img-responsive img-thumbnail" alt="logo" width="85px" height="75px" >
												</div>
												<div class="col-xs-8">
													<div class="text-center">
														<h4>{{$about->english_name}}</h4>
														<h5>{{$loan->loaner_name}}</h5>
														<p>Branch:  {{$loan->loaner_phone}}</p>
														<p>Address:  {{$loan->loaner_address}}</p>
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
														<th>Debit</th>
														<th>Credit</th>
														<th>Balance</th>
													</tr>
												</thead>
												<tbody>
													@php
														$debit = 0;
														$credit = 0;
													@endphp
												@foreach($transactions as $key=>$tr)
													@php
														$debit = $debit + $tr->debit;
														$credit = $credit + $tr->credit;
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td>{{ date("d-m-Y", strtotime($tr->transaction_date))}}</td>
														<td>{{ $tr->debit }}</td>
														<td>{{ $tr->credit}}</td>
														<td>{{ $debit - $credit}}</td>
													</tr>
												@endforeach
													<tr>
														<th colspan="1"></th>
														<th>Total=</th>
														<th>{{$debit}}</th>
														<th>{{$credit}}</th>
														<th>{{$debit - $credit}}</th>
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
    
 