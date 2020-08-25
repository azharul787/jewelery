@extends('layouts.backend.master')

@section('title', 'Bank Balance Report')

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
						<a href="{{ route('admin.bank_transaction.index')}}" calss="btn" >
							<i class="fa fa-mail-reply"></i>
						</a>
						Bank Balance
						
					</h4>

					<span class="widget-toolbar">
						<a href="#" id="sear" class="" onclick="printDiv('printableArea')">
							<i class="ace-icon fa fa-print "></i>
						</a>
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
														<h4>{{$about->bangla_name}}</h4>
														<h4>{{$about->english_name}}</h4>
														<p>Phone:  {{$about->phone}}, Email: {{$about->email}}</p>
														<p>Address: {{$about->address }} </p>
													</div>
												</div>
												<div class="col-xs-2">
													
												</div>
											</div>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>SL</th>
														<th>Bank Name</th>
														<th>Account No</th>
														<th>Deposit</th>
														<th>Withdraw</th>
														<th>Balance</th>
													</tr>
												</thead>
												<tbody>
													@php
														$depo = 0;
														$wit = 0;
													@endphp
												@foreach($cbalances as $key=>$tr)
													@php
														$depo = $depo + $tr->total_deposit;
														$wit = $wit + $tr->total_withdraw;
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td><a href="{{route('admin.bank_transaction.show',$tr->bank_id)}}"> {{ $tr->bank_name}}</a></td>
														<td>{{ $tr->account_no}}</td>
														<td>{{ $tr->total_deposit}}</td>
														<td>{{ $tr->total_withdraw}}</td>
														<td>{{ $tr->total_deposit - $tr->total_withdraw}}</td>
													</tr>
												@endforeach
													<tr>
														<th colspan="2"></th>
														<th>Total=</th>
														<th>{{$depo}}</th>
														<th>{{$wit}}</th>
														<th>{{ $depo - $wit}}</th>
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
    
 