@extends('layouts.backend.master')

@section('title', 'Purchase')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Purchase List</h4>
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
							<form action="{{route('admin.purchase.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$purchases->count()}}">{{$purchases->count()}}</option>
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
										<th>Supplier</th>
										<th>Chalan No</th>
										<th>Total Price</th>
										<th>Payment</th>
										<th>Due</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($purchases as $key=>$pro)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($pro->purchase_date))}}</td>
											<td><a href="{{route('admin.purchase.supplierSale',$pro->supplier_id)}}" title="See Supplier Life Time Sale Information">{{$pro->supplier->supplier_name}}</a></td>
											<td><a href="{{route('admin.purchase.show',$pro->id)}}" title="See Purchase Details Information">{{$pro->chalan_no}}</a></td>
											<td>{{$pro->net_purchase_price}}</td>
											<td>{{$pro->payment}}</td>
											<td>{{$pro->due_amount}}</td>
											<td>
											@if(date('d-m-Y',strtotime($pro->purchase_date)) == date('d-m-Y'))
												@can('purchase-edit')
													<a  href="{{route('admin.purchase.edit',$pro->id)}}" title="Edit Purchase Information"><i class="ace-icon fa fa-edit bigger-130"></i></a>
												@endcan
												@can('purchase-delete')
													<a  class="red" href="#" data-toggle="tooltip" title="Delete Purchase Information!" onclick="deleteCategory({{ $pro->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
													<form id="delete-form-{{ $pro->id }}" action="{{ route('admin.purchase.destroy',$pro->id) }}" method="POST" style="display: none;">
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
								{{$purchases->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
@endsection

@push('js')
<script>
	$(document).ready(function(){
		
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