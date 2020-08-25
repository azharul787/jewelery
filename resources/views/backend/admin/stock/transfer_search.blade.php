@extends('layouts.backend.master')

@section('title', 'Stock List')

@push('css')
	<style>
		i.fa.fa-trash.fa-lg {
		cursor: pointer;
		color: red;
	}
	</style>
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Transfer Product Warehouse </h4>
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
					<form action="{{route('admin.stock.sptupdate')}}" id="searchForm" class="form-horizontal" role="form" method="Post">
						@csrf
						@method('Put')
						<div class="row search-section">
							
								<div class="col-sm-5">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Warehouse</label>
										<div class="col-sm-8">
											<select class="form-control select2" name="warehouse" id="warehouse_id">
												<option value=""> -- Select -- </option>
												@foreach($warehouses as $wr)
													<option value="{{$wr->id}}">{{$wr->warehouse_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Product Name</label>
										<div class="col-sm-9">
											<select class="form-control select2" name="product_id" id="product">
												<option value=""> -- Select warehouse -- </option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-1">
									<!--<div class="form-group">
										<button type="submit" class="btn btn-purple btn-sm">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
										</button>
									</div>-->
								</div>
							
						</div>
						<hr/>
						<div class="table-content">
							<table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive green" id="sale">
                                <thead class="info">
                                    <tr>
                                        <th class="all">SL </th>
                                        <th class="all">Product </th>
                                        <th class="all">Part No </th>
                                        <th class="all">Warehouse </th>
                                        <th class="all">Rack No </th>
                                        <th class="all">Stock </th>
                                        <th class="all">New Warehouse</th>
                                        <th class="all">Rack No</th>
                                        <th class="all">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								</tbody>
							</table>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <a href="{{route('admin.stock.stocklist')}}" class="btn btn-xs btn-warning" type="reset">Cancel</a>
								  <button type="submit" class="btn btn-xs btn-success">Transfer</button>
								</div>
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
		/***-------------------------------*/
		$("#warehouse_id").change(function () {
            var id = $(this).val();
			//alert(id)
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.stock.spList') }}',
                type: 'POST',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
				//console.log(response)
                    var len = response.length;
                    $("#product").empty();
                    $("#product").append("<option value=''> Select Product</option>");
                    if (len == 0) {
                        $("#product").empty();
                        var id = "";
                        var name = "";
                        $("#product").append("<option value='" + id + "'>" + name + "</option>");
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['product_name'];
                        var part_no = response[i]['model_no'];
                        var disable = "";
                        $("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" )</option>");
                    }
                }
            });
        });
		/*-------------------------*/
		var sl = 1;
		$("#product").change(function () {
            var id = $(this).val();
            var token = "{{csrf_token()}}";

            $.ajax({
                url: '{{ route('admin.stock.spDetails') }}',
                type: 'POST',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
			//alert(response)
			//console.log(response)
                    var len = response.length;
                   // $("#product").empty();
                   // $("#product").append("<option value=''> Select Product</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['purchase_detail_id'];
                        var name = response[i]['product_name'];
                        var disable = "";
                        $("#product").append("<option " + disable + " id='product_" + id + "' value='" + id + "'>" + name + "</option>");
                    }

                    var id = response['purchase_detail_id'];  
					var product_id = response['product_id']; 					
					var product_name = response['product_name']; 					
                    var model_no =  response['model_no'];
                    var warehouse_id =  response['warehouse_id'];
                    var warehouse_name =  response['warehouse_name'];
                    var rack_no =  response['rack_no'];
                    var stock =  response['now_stock'];
                
                    $("#sale tbody").append(
                        "<tr id='"+id+"'>"
                          +"<td><input type='hidden' name='purchase_detail_id[]' value='"+id+"' />"+(sl++)+"</td>"
                          +"<td><input type='hidden' name='product_id[]' value='"+product_id+"' />"+product_name+" </td>"
						  +"<td><input type='hidden' name='model_no[]' value='"+model_no+"' />"+model_no+" </td>"
                          +"<td>"+warehouse_name+" </td>"
                          +"<td>"+rack_no+" </td>"
                          +"<td>"+stock+" </td>"
						  +"<td>"
							+"<select name='warehouse_id[]' class='form-control select2' required>"
								+"<option value=''> -- Select -- </option>"
								+"@foreach($warehouses as $wr)"
									+"<option value='{{$wr->id}}'>{{$wr->warehouse_name}}</option>"
								+"@endforeach"
							+"</select>"
						  +"</td>"
                          +"<td><input type='text' name='rack_no[]'/></td>"
                          +"<td class='text-center'><i class=' fa fa-trash fa-lg'></i></td>"
                        +"</tr>");

                   /* array.push(id);
                    var idLength = array.length;
                    for(j = 0; j<idLength; j++){
                        $('#product_'+array[j]).attr('disabled','disabled').select2({placeholder:"",width:"auto",allowClear:!0});
                    }

                    var total_ordered = parseFloat($('#total_ordered').html());
                    total_ordered = total_ordered + 1;
                    $('#total_ordered').html(total_ordered);

                    calculate_sub_total();

                    calculate_total();*/
                }
            });
        });
        
        $(document).on('click','.fa-trash',function(){
            var id = $(this).parent().parent().attr('id');
            $('#'+id).remove();

            $('#product_'+id).removeAttr('disabled');
            array.splice($.inArray(id, array), 1);
        });
	})
	</script>
@endpush									