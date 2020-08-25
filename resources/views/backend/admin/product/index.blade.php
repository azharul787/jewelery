@extends('layouts.backend.master')

@section('title', 'Product')

@push('css')
<style type="text/css">
	/*tr:nth-child(even) {background: #BDD6EE}
	tr:nth-child(odd) {background: #DEEAF6}-*/
</style>
@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Product List</h4>
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
							<form action="{{route('admin.product.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$products->count()}}">{{$products->count()}}</option>
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="250">250</option>
										<option value="500">500</option>
										<option value="750">750</option>
										<option value="1000">1000</option>
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
							<table id="" class="table table-condensed table-bordered" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Product</th>
										<th>Code No</th>
										<th>Supplier</th>
										<th>Category</th>
										<th>Brand</th>
										<th>Type</th>
										<th>Caret</th>
										<th>Unit</th>
										<th>Rate</th>
										<th>S.Price</th>
										<th>O.Label</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="">
									@foreach($products as $key=>$pro)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{$pro->product_name}}</td>
											<td>{{$pro->model_no}}</td>
											<td>{{$pro->supplier->supplier_name}}</td>
											<td>{{$pro->category->category_name}}</td>
											<td>{{$pro->brand->brand_name}}</td>
											<td>{{$pro->type->type_name}}</td>
											<td>{{$pro->caret != '' ? $pro->caret->caret_name : ''}}</td>
											<td>{{$pro->unit->unit_name}}</td>
											<td>{{$pro->supplier_price}}</td>
											<td>{{$pro->sale_price}}</td>
											<td>{{$pro->re_order_label}}</td>
											<td>
											@can('product-edit')
												<a  href="{{route('admin.product.edit',$pro->id)}}" title="Edit Product Information"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('product-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Product Information!" onclick="deleteCategory({{ $pro->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $pro->id }}" action="{{ route('admin.product.destroy',$pro->id) }}" method="POST" style="display: none;">
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
								{{$products->links()}}
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