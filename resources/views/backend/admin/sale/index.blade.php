@extends('layouts.backend.master')

@section('title', 'Sale')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Sale List</h4>
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
						<div class="row search-section">
							<form action="{{route('admin.sale.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$sales->count()}}">{{$sales->count()}}</option>
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="250">250</option>
										<option value="500">500</option>
									</select>
								</div>
								<div class="col-sm-5"></div>
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" id="myInput" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="button" class="btn btn-purple btn-sm">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span></button>
										</span>
									</div>
								</div>
							</form> 
						</div>
						<div class="table-content">
							<table id="" class="table table-bordered table-condensed" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Date</th>
										<th>Customer</th>
										<th>Invoice No</th>
										<th>Total Price</th>
										<th>Discount</th>
										<th>Grand Total</th>
										<th>Payment</th>
										<th>Due</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($sales as $key=>$pro)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($pro->sale_date))}}</td>
											<td><a href="{{route('admin.sale.customerPurchase',$pro->customer_id)}}" title="See Customer Life Time Purchase Information">{{$pro->customer->customer_name}}</a></td>
											<td><a href="{{route('admin.sale.show',$pro->id)}}" title="See Invoice Item Detail Information">{{$pro->invoice_no}}</a></td>
											<td>{{$pro->total_price}}</td>
											<td>{{$pro->discount}}</td>
											<td>{{$pro->grand_total_price}}</td>
											<td>{{$pro->payment}}</td>
											<td>{{$pro->due_amount}}</td>
											<td>
											@can('sale-list')
												<a  href="{{route('admin.sale.salePrint',$pro->id)}}" class="printPage" target="_blank" title="Print Sale Information"><i class="ace-icon fa fa-2x fa-print bigger-130"></i></a>
											@endcan
										@if(date('d-m-Y',strtotime($pro->sale_date)) == date('d-m-Y'))
											@can('sale-edit')
												<a  href="{{route('admin.sale.edit',$pro->id)}}" title="Edit Sale Information"><i class="ace-icon fa fa-2x fa-edit bigger-130"></i></a>
											@endcan
											@can('sale-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Sale Information!" onclick="deleteCategory({{ $pro->id }})"><i class="fa fa-2x fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $pro->id }}" action="{{ route('admin.sale.destroy',$pro->id) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form>
											@endcan
										@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="text-center">
								{{$sales->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
@endsection

@push('js')
	<!-- Print Memo Section-->
	<script src="{{asset('myfile/backend/assets/js/print-page.js')}}"></script>
<script>
	$(document).ready(function(){
		
	
		/* print section --*/
	   $('.printPage').printPage();
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