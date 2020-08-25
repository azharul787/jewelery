@extends('layouts.backend.master')

@section('title', 'Customer Ledger Report')

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
						<a href="{{ route('admin.customer.index')}}" calss="btn" >
							<i class="fa fa-mail-reply"></i>
						</a>
						Customer Ledger Report</h4>
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
						<form id="demo-form2" action="{{ route('admin.ledger.cledgers')}}" method="post" data-parsley-validate class="form" enctype="multipart/form-data" >
							@csrf
							@method('POST')
							<div class="row">
								<div class="col-sm-1"></div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>Customer Name *</label>
										<select name="customer_id"  id="customer_id" class="form-control select2" required="required">
											<option value="">-Select Customer Name-</option>
										</select> 
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>From</label>
										<input id="datepicker-range-start" type="text" name="from_date"  class="form-control" value="" data-zdp_readonly_element="false" placeholder="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>To</label>
										<input id="datepicker-range-end" type="text" name="to_date"  class="form-control"value="" data-zdp_readonly_element="false" placeholder="yyyy-mm-dd">
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
														<h4>{{$customer->customer_name}}</h4>
														<p>{{$customer->customer_phone}}</p>
														<p>From: {{ date("d-m-Y", strtotime($from_date))}} - {{ date("d-m-Y", strtotime($to_date))}}</p>
													</div>
												</div>
												<div class="col-xs-2"></div>
											</div>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>SL</th>
														<th>Pay Date</th>
														<th>Invoice No</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													@php
														$total = 0;	
													@endphp
												@foreach($transactions as $key=>$tr)
													@php
														$total = $total + $tr->amount;
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td>{{ date("d-m-Y", strtotime($tr->ca_date))}}</td>
														<td>{{ $tr->sale->invoice_no}}</td>
														<td>{{ $tr->amount}}</td>														
													</tr>
												@endforeach
													<tr>
														<th colspan="2"></th>
														<th>Total=</th>
														<th>{{$total}}</th>
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
    /*------load customer list-------------*/
		var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.customer.customerList2') }}',
                type: 'Get',
                data: {'_token' : token},
                dataType: 'json',
                success: function (response) {
				//console.log(response)
                    var len = response.length;
                    $("#customer_id").empty();
                    $("#customer_id").append("<option value=''> Select Customer </option>");
                    if (len == 0) {
                        $("#customer_id").empty();
                        var id = "";
                        var name = "";
                        $("#customer_id").append("<option value='" + id + "'>" + name + "</option>");
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['customer_name'];
                        //var distric = response[i]['distric']['distric_name'];
                        var disable = "";
                        $("#customer_id").append("<option " + disable + " value='" + id + "'>"+name+" </option>");
                    }
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
    
 