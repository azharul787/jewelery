@extends('layouts.backend.master')

@section('title', 'Bank')

@push('css')

@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Bank Transaction List</h4>
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
							<form action="{{route('admin.bank.index')}}" id="searchForm" method="Get">
								<div class="col-sm-2">
									<select class="form-control" name="show" id="show">
										<option value="{{$banks->count()}}">{{$banks->count()}}</option>
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
										<th>Tr.Date</th>
										<th>Bank Name</th>
										<th>Account No</th>
										<th>Cheque No</th>
										<th>Status</th>
										<th>Tr. Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($banks as $key=>$bran)
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($bran->transaction_date))}}</td>
											<td><a href="{{route('admin.bank_transaction.show',$bran->bank_id)}}">{{$bran->bank->bank_name}}</a></td>
											<td>{{$bran->account_no}}</td>
											<td>{{$bran->cheque_no}}</td>
											<td>{{$bran->transaction_status}}</td>
											<td>{{$bran->transaction_amount}}</td>
											<td>
											@can('bank-transaction-edit')
												<a  href="{{route('admin.bank_transaction.edit',$bran->id)}}" title="Edit Bank Transaction Information"><i class="ace-icon fa fa-edit bigger-130"></i></a>
											@endcan
											@can('bank-transaction-delete')
												<a  class="red" href="#" data-toggle="tooltip" title="Delete Bank Transaction Information!" onclick="deleteCategory({{ $bran->id }})"><i class="fa fa-trash-o bigger-130" ></i></a>
												<form id="delete-form-{{ $bran->id }}" action="{{ route('admin.bank_transaction.destroy',$bran->id) }}" method="POST" style="display: none;">
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
								{{$banks->links()}}
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