@extends('layouts.backend.master')

@section('title', 'Daily Summary Report')

@push('css')
<!-- bootstrap-datetimepicker -->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
	<style>
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
					<h4 class="widget-title"> Daily Summary Report</h4>
					<span class="widget-toolbar" >
						<a href="#" data-action="settings" onclick="printDiv('printableArea')">
							<i class="ace-icon fa fa-print"></i>
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
														<h4>{{$about->english_name}}</h4>
														<p>Phone:  {{$about->phone}}, Email: {{$about->email}}</p>
														<p>Address: {{$about->address }} </p>
														<h4>Daily Income Expense Summary Report</h4>
													</div>
												</div>
												<div class="col-xs-2"></div>
											</div>
                                            <br/>
											<table class="table table-bordered" >
												<thead>
													<tr>
														<th>SL</th>
														<th>Description</th>
														<th>Transaction</th>
														<th>Receipt</th>
														<th>Payment</th>
													</tr>
												</thead>
												<tbody>
													@php
														$total = 0;
														$ex_total = 0;
													@endphp
												@foreach($sum as $key=>$sm)
													@php
														$total = $total + $sm['income'];
														$ex_total = $ex_total + $sm['expense'];
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td><a href="#" class="myModal">{{ $sm['description'] }}</a></td>
														<td>{{ $sm['transaction'] }}</td>
														<td>{{ $sm['income'] }}</td>
														<td>{{ $sm['expense'] }}</td>
													</tr>
												@endforeach
													<tr>
														<th colspan="2"></th>
														<th>Grand Total =</th>
														<th>{{$total}}</th>
														<th>{{$ex_total}}</th>
													</tr>
												</tbody>
											</table>
											<!--Saving Modal -->
											<div id="myModal" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content" >
														<div class="modal-header">
															 <a href="#" id="" class="" onclick="printDiv('SavingPrintArea')"><i class="ace-icon fa fa-print fa-2x icon-only"></i></a>
															 <button type="button" class="close" data-dismiss="modal">&times;</button>
															<div id="SavingPrintArea">
																<div class="text-center">
																	<h3>{{$about->english_name}}</h3>
																	<h4>Daily Summary Details</h4>
																	<p id="head_name"></p>
																</div>
																<div class="modal-body">
																  <table class="table table-bordered table-condensed" id="modalTable">
																		<thead>
																			<tr>
																				<th>SL</th>
																				<th>Name</th>
																				<th>Receipt</th>
																				<th>Payment</th>
																			</tr>
																		</thead>
																		<tbody>
																		</tbody>
																		<tfoot>
																			<tr>
																				<th colspan="2">Total:</th>
																				<th id="credit_total"></th>
																				<th id="debit_total"></th>
																			</tr>
																		</tfoot>
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
	/*------summary details------*/
	
	$(document).on('click','.myModal',function(){
		var table = $(this).html();
		var token = "{{csrf_token()}}";
		$.ajax({
			url: '{{ route('admin.ledger.summaryDetails') }}',
			type: 'Get',
			data: {table: table, '_token' : token},
			dataType: 'json',
			success: function(response){
				//console.log(response)
				var len = response.length;
				//empty the table tbody
				$("#modalTable tbody tr").remove();
				$("#credit_total").html('');
				$("#debit_total").html('');
				var credit_total = 0;
				var debit_total = 0;

				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					var credit = response[i]['credit'] || 0;
					var debit = response[i]['debit'] || 0;
					credit_total+= parseInt(response[i]['credit'] || 0);
					debit_total+= parseInt(response[i]['debit'] || 0);
					/*--------------*/
					$("#modalTable tbody").append(
						"<tr>"
							+"<td>"+(i+1)+"</td>"
							+"<td>"+name+"</td>"
							+"<td>"+credit+"</td>"
							+"<td>"+debit+"</td>"
						+"</tr>"
					)
				}
				$("#head_name").html(table);
				$("#credit_total").html(credit_total);
				$("#debit_total").html(debit_total);
				$('#myModal').modal('show');	
			}
		});
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
    
 