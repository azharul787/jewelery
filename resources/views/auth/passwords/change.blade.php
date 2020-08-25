@extends('layouts.backend.master')

@section('title', 'Change Password')

@push('css')
  
@endpush
@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="widget-title">Change Password</h4>
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
                    <form id="demo-form2" action="{{ route('admin.password.update')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"  >
            @csrf
            @method('Post')
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Current Password<span class="required">*</span>
                        </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="name"  class="form-control input-sm col-md-7 col-xs-12" name="oldPassword" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="last-name" name="password"  class="form-control input-sm col col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Retype New Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control input-sm col col-md-7 col-xs-12" type="password" name="password_confirmation">
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

@endpush