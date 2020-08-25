@extends('layouts.backend.master')

@section('title', 'Loan Management')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Loan Transaction List</h4>
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
							<form action="{{route('admin.loan.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$loans->count()}}">{{$loans->count()}}</option>
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
							<table id="" class="table table-bordered condensed" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Date</th>
										<th>Loaner Name</th>
										<th>Debit</th>
										<th>Credit</th>
										<th>Note</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($loans as $key=>$lo)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($lo->transaction_date))}}</td>
											<td><a href="{{route('admin.loan.show',$lo->loaner_id)}}">{{$lo->loaner->loaner_name}}</a></td>
											<td>{{$lo->debit}}</td>
											<td>{{$lo->credit}}</td>
											<td>{{$lo->note}}</td>
											<td>
											@can('loan-edit')
												<a  href="{{route('admin.loan.edit',$lo->id)}}" title="Edit Loan Information"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('loan-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Loan Information!" onclick="deleteCategory({{ $lo->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $lo->id }}" action="{{ route('admin.loan.destroy',$lo->id) }}" method="POST" style="display: none;">
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
								{{$loans->links()}}
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