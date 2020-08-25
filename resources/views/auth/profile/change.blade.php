@extends('layouts.backend.master')

@section('title', 'Change User Profile')

@push('css')


@endpush
@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="widget-title">Edit Profile</h4>
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
            <form id="demo-form2" action="{{ route('admin.profile.updateprofile')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Full Name <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name"  class="form-control col-md-7 col-xs-12" name="user_name" value="{{ Auth::user()->name }}" placeholder="Full Name">
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="phone" value="{{ Auth::user()->phone }}">
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="email" value="{{ Auth::user()->email }}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control col-md-7 col-xs-12" name="address" value="{{ Auth::user()->address }}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input id="profile_img" onChange="readURL(this)" name="image" class="form-control col-md-7 col-xs-12"  type="file">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <img src="{{ asset('storage/user/'.Auth::user()->image) }}" class="img-responsive img-thumbnail" id="profile_img_tag" width="170px" hight="150px"/>
                </div>
              </div>
              <hr/>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a class="btn btn-xs btn-danger" href="{{route('home')}}">Cancel</a>
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
    function readURL(input) 
      { 
      //alert("jdfdfds")
        if (input.files && input.files[0]) 
          {
            var reader = new FileReader();
            
            reader.onload = function (e) {
              $('#profile_img_tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
      }
  </script>
@endpush