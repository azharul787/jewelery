@extends('layouts.backend.master')

@section('title', 'Order')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Order List</h4>
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
							<form action="{{route('admin.worker_order.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$orders->count()}}">{{$orders->count()}}</option>
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
										<th>Order Date</th>
										<th>Order No</th>
										<th>Total Price</th>
										<th>Advance Payment</th>
										<th>Due</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($orders as $key=>$pen)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($pen->order_date))}}</td>
											<td><a href="{{route('admin.worker_order.show',$pen->id)}}" title="Details Order Information">{{$pen->order_no}}</a></td>
											<td>{{$pen->total_wage}}</td>
											<td>{{$pen->payment}}</td>
											<td>{{$pen->total_wage - $pen->payment}}</td>
											<td class="{{ $pen->status == 'Ready' ? 'green' : 'warning' }}">
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Order Information!" onclick="orderSearch({{ $pen->id }})">
													{{$pen->status}}
												</a>
												<form id="search-form-{{ $pen->id }}" action="{{ route('admin.purchase.search') }}" method="POST" style="display: none;">
													@csrf
													@method('POST')
													<input type="hidden" name="order_id" value="{{$pen->id}}">
												</form>
											</td>
											<td>
											@can('order-edit')
												<a  href="{{route('admin.worker_order.edit',$pen->id)}}" title="Edit Order Information"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('order-delete')	
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Order Information!" onclick="deleteCategory({{ $pen->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $pen->id }}" action="{{ route('admin.worker_order.destroy',$pen->id) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form>
											@endcan 
											</td>
										</tr>
									
									@endforeach
								</tbody>
								</table>
								<div class="text-center">
									{{$orders->links()}}
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
	function orderSearch(id){
		document.getElementById('search-form-'+id).submit();
	}
	</script>
@endpush									