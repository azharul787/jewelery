@extends('layouts.backend.master')

@section('title', 'About Information')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">About Information</h4>
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
						<form id="demo-form2" action="{{ route('admin.about.update',$about->id)}}" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
							@csrf
							@method('PUT')
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bangla Name <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="bang-name" name="bang_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$about->bangla_name}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">English Name <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="last-name" name="eng_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$about->english_name}}">
								</div>
							</div>
							<div class="form-group">
								<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Founder</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="founder" value="{{$about->founder}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Establish Year<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="" class="date-picker form-control col-md-7 col-xs-12" name="est_year" required="required" type="text" placeholder="xxxx" value="{{$about->establish_year}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									  <input type="text" class="form-control" name="phone" placeholder="01xxxxxxxx" value="{{$about->phone}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text"  name="email" class="date-picker form-control col-md-7 col-xs-12" value="{{$about->email}}" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Web<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text"  name="web" class="date-picker form-control col-md-7 col-xs-12" value="{{$about->web}}" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="" name="address" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="{{$about->address}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">About<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea id="" name="about" class="date-picker form-control col-md-7 col-xs-12" >{{$about->about}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Favicon Image<span class="required">*</span></label>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<input type="file" id="favicon" onChange="docImg(this)" name="favicon" class="form-control">
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6"> 
									  <img src="{{ asset('storage/about/'.$about->favicon)}}" class="img-responsive img-thumbnail" id="docImage" width="40px" height="50px"/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Logo image</label>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<input type="file" id="profile_img" onChange="readURL(this)" name="logo" class="form-control">
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<div class="form-group">
										<img src="{{ asset('storage/about/'.$about->logo)}}" class="img-responsive img-thumbnail" id="profile_img_tag" width="85px" height="100px"/>
									</div>
								</div>
							</div>		
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
									<a href="{{ route('admin.about.index')}}" class="btn btn-xs btn-danger">Cancel</a>
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
		
		
	})
// profile photo display section
	function readURL(input) 
		{
			if (input.files && input.files[0]) 
				{
					var reader = new FileReader();
					reader.onload = function (e) {
					$('#profile_img_tag').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
		}

	// document file display section
	function docImg(input) 
		{
			if (input.files && input.files[0]) 
				{
					var reader = new FileReader();
					reader.onload = function (e) {
					$('#docImage').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
		}
	</script>
@endpush									