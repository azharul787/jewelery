@extends('layouts.backend.master')

@section('title', 'Product Edit')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title"> <a href="{{ route('admin.product.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a> Product Edit</h4>
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
						<form action="{{route('admin.product.update',$product->id)}}" method="post" class="form-horizontal" role="form" >
							@csrf
							@method('put')
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Product Name </label>
								<div class="col-sm-9 ">
									<input type="text" id="form-field-1-1" name="product_name" id="product_name" value="{{old('product_name') ?? $product->product_name}}" placeholder="Product Name" class="col-xs-10 col-sm-8">
									<p class="error-sms">{{ $errors->first('product_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category  Name</label>
								<div class="col-sm-9">
									<select name="category_name"  class="chosen-select col-xs-10 col-sm-8 select2">
										<option value="">-Select-</option>
										@foreach($categories as $category)
											<option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->category_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('category_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type Name</label>
								<div class="col-sm-9">
									<select name="type_name"  class="col-xs-10 col-sm-8 select2">
										<option value="">-Select-</option>
										@foreach($types as $type)
											<option value="{{$type->id}}" {{$type->id == $product->type_id ? 'selected' : ''}}>{{$type->type_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('type_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Brand Name</label>
								<div class="col-sm-9">
									<select name="brand_name"  class="col-xs-10 col-sm-8 select2">
										<option value="">-Select-</option>
										@foreach($brands as $brand)
											<option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected' : ''}}>{{$brand->brand_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('brand_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Caret Name</label>
								<div class="col-sm-9">
									<select name="caret_name"  class="col-xs-10 col-sm-8 select2">
										<option value="">-Select-</option>
										@foreach($carets as $caret)
											<option value="{{$caret->id}}" {{$caret->id == $product->caret_id ? 'selected' : ''}}>{{$caret->caret_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('unit_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Unit Name</label>
								<div class="col-sm-9">
									<select name="unit_name"  class="col-xs-10 col-sm-8 select2">
										<option value="">-Select-</option>
										@foreach($units as $unit)
											<option value="{{$unit->id}}" {{$unit->id == $product->unit_id ? 'selected' : ''}}>{{$unit->unit_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('unit_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Supplier Name</label>
								<div class="col-sm-9">
									<select name="supplier_name"  class="col-xs-10 col-sm-8 select2">
										<option value="">-Select-</option>
										@foreach($suppliers as $sup)
											<option value="{{$sup->id}}" {{$sup->id == $product->supplier_id ? 'selected' : ''}}>{{$sup->supplier_name}}</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('supplier_name') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Part No </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="model_no" value="{{old('model_no') ?? $product->model_no}}" placeholder="Model No" class="col-xs-10 col-sm-8">
									<p class="error-sms">{{ $errors->first('model_no') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Supplier Price </label>
								<div class="col-sm-9 ">
									<input type="text" id="form-field-1-1" name="supplier_price" id="supplier_price" value="{{old('supplier_price') ?? $product->supplier_price}}" placeholder="Total Price" class="col-xs-10 col-sm-8">
									<p class="error-sms">{{ $errors->first('supplier_price') }}</p> 
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sale Price </label>
								<div class="col-sm-9 ">
									<input type="text" id="form-field-1-1" name="sale_price" id="sale_price" value="{{old('sale_price') ?? $product->sale_price}}" placeholder="Unit Price" class="col-xs-10 col-sm-8">
									<p class="error-sms">{{ $errors->first('sale_price') }}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Re-Order Label </label>
								<div class="col-sm-9 ">
									<input type="text" id="form-field-1-1" name="re_order_label" id="re_order_label" value="{{old('re_order_label') ?? $product->re_order_label}}" placeholder="Product Re-Order Label" class="col-xs-10 col-sm-8">
									<p class="error-sms">{{ $errors->first('re_order_label') }}</p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Update</button>
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
		/*-------search section------------*/
	})
</script>
@endpush									