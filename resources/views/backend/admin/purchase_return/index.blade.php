@extends('layouts.backend.master')

@section('title', 'Purchase Return')

@push('css')
	
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Purchase Return List</h4>
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
							<form action="{{route('admin.purchase_return.index')}}" id="searchForm" method="Get">
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
							<table id="" class="table table-bordered" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Return Date</th>
										<th>Supplier</th>
										<th>Chalan No</th>
										<th>Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($purchases as $key=>$ret)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($ret->return_date))}}</td>
											<td><a href="{{route('admin.purchase_return.supplierReturn',$ret->supplier_id)}}" title="See Supplier Life Time Return Information">{{$ret->supplier->supplier_name}}</a></td>
											<td><a href="{{route('admin.purchase_return.show',$ret->id)}}" title="See Purchase Return Details Information">{{$ret->chalan_no}}</a></td>
											<td>{{$ret->total_price}}</td>
											<td>
											@can('purchase-return-edit')
												<a  href="{{route('admin.purchase_return.edit',$ret->id)}}"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('purchase-return-delete')	
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Information!" onclick="deleteCategory({{ $ret->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $ret->id }}" action="{{ route('admin.purchase_return.destroy',$ret->id) }}" method="POST" style="display: none;">
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
								{{$purchases->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Search Purchase</h4>
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
						<form action="{{route('admin.purchase_return.create')}}" method="Get" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Supplier <span class="red">*</span></label>
								<div class="col-sm-8">
									<select name="supplier_name" id="supplier_id" class="form-control select2">
										<option value="">-Select Supplier-</option>
										@foreach($suppliers as $sup)
											<option value="{{$sup->supplier_id}}" {{$sup->supplier_id == old('supplier_name') ? 'selected' : ''}}>{{$sup->supplier_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('supplier_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Chalan No <span class="red">*</span> </label>
								<div class="col-sm-8">
									<select name="chalan_no" id="chalan_no" class="form-control select2">
										<option value="">-Select Supplier-</option>
										
									</select> 
									<p class="error-sms">{{ $errors->first('chalan_no') }}</p>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Search</button>
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
		// select2 section
		$('.select2').select2()	;

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
		/***-------------get chalan no from ajax request------------------*/
		$("#supplier_id").change(function () {
            var id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.purchase_return.getChalanNo') }}',
                type: 'POST',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
				console.log(response)
                    var len = response.length;
                    $("#chalan_no").empty();
                    $("#chalan_no").append("<option value=''> Select Chalan No </option>");
                    if (len == 0) {
                        $("#chalan_no").empty();
                        var id = "";
                        var chalan = "";
                        $("#chalan_no").append("<option value='" + chalan + "'>" + chalan + "</option>");
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var chalan = response[i]['chalan_no'];
                        
                        var disable = "";
                        $("#chalan_no").append("<option " + disable + " value='" + chalan + "'>"+chalan+"</option>");
                    }
                }
            });
        });
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