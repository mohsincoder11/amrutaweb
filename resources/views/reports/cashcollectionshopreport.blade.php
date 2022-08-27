@extends('layout')
@section('content')

<div class="page-content-wrap">
	
	@include('reports/reportlayout')


	<div class="row">
		<div class="col-md-12" style="margin-top:-15px;">
			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">

				<h5 class="panel-title" style="color:#FFFFFF; background-color:#877810; width:100%; font-size:14px;" align="center"><i class="fa fa-dollar"></i> &nbsp;Cash Collection Shop Report</h5>
				<div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
					<div class="form-group"> 


						<div class="row">
							<div class="col-md-10">
								<form method="POST" action="{{url('cashcollectionshopreports')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
									{{ csrf_field() }} 
									
									<div class="col-md-12">
										<div class="form-group" style="margin-top:-10px;">   
											<div class="col-md-2"></div>
											<div class="col-md-2" style="margin-top:15px; padding-left:5px; padding-right:2px;">
												<label>Start Date<font color="#FF0000"></font></label>
												<div class="input-group">
													<input type="text" value="{{$fromdatepage ?? '' ?? ''}}" name="fromdate" id="fromdate" class="form-control "data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
													<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												</div>

											</div>
											<div class="col-md-2" style="margin-top:15px; padding-left:5px; padding-right:2px;">
												<label>To Date<font color="#FF0000"></font></label>
												<div class="input-group">
													<input type="text" value="{{$todatepage ?? '' ?? ''}}" name="todate" id="todate" class="form-control "data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
													<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												</div>

											</div>
											<div class="col-md-2" style="margin-top:15px; padding-left:5px; padding-right:2px;">
												<label>Select Shop<font color="#FF0000"></font></label>
												<div class="input-group">
													<select name="shopid" data-live-search="true" class="select">
														<option value="all">All</option>

														@foreach($shop as $s)
														<option value="{{$s->userid}}">{{$s->shopname}}</option>
														@endforeach
													</select>
												</div>

											</div>
											<div class="col-md-2" style="margin-top:15px; padding-left:5px; padding-right:2px;">
												<label>MOP<font color="#FF0000"></font></label>
												<div class="input-group">
													<select name="mop" class="select">
														<option value="all">All</option>
														<option value="cash">Cash</option>
														<option value="online">Online</option>
													</select>
												</div>

											</div>
											



											<div class="col-md-2" style="margin-top:3.2rem;" align="center">

												<div class="input-group col-md-12" style=" margin-bottom:15px;">

													<button type="submit" class="btn btn-primary col-md-12"><span class="fa fa-search"></span> Search</button>
												</div>
											</div> 





										</div> 
									</div>
								</form>
							</div>
							<div class="col-md-2" >
								<form method="POST" action="{{url('printcashcollectionshop')}}" class="form-horizontal" name="printform" id="printform" enctype="multipart/form-data" target="_blank">
									@csrf

									<div class="input-group col-md-12" style=" margin-bottom:15px;margin-top:2.4rem;">
										<input type="hidden" name="printfromdate" id="printfromdate" value="{{$fromdate ?? ''}}">
										<input type="hidden" name="printtodate" id="printtodate" value="{{$todate ?? ''}}">
										<input type="hidden" id="collectionshopcount" name="collectionshopcount" value="{{$collectionshopcount ?? ''}}">
										<input type="hidden" name="printshopid" value="{{$shopid ?? ''}}">
										<input type="hidden" name="printmop" value="{{$mop ?? ''}}">
										<input type="hidden" name="totalcash" value="{{$totalcashcollected ?? ''}}">
										<button type="submit" class="btn btn-warning col-md-9 printcash"><span class="fa fa-print"></span> Print</button>
									</div>

								</form>
							</div>
						</div>
						

					</div>
				</div>


			</div>

		</div>


	</div>
	<div class="row">
		<div class="col-md-12" style="margin-top:-15px;">


			<div class="panel panel-default">






				<h5 class="panel-title" style="color:#FFFFFF; background-color:#877810; width:100%; font-size:14px;" align="center"><i class="fa fa-dollar"></i> Shop Orders</h5>
				<div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
					<div class="row" ><h3 style="margin-top: 10px;text-align: center">From :{{$fromdate ?? ''}} &nbsp; To :{{$todate ?? ''}} </h3><h3 style="margin-top: 10px;text-align: center;color: black;">Shop  :{{ucfirst($shopname) ?? ''}} &nbsp;<label for="">MOP :{{ucfirst($mop) ?? ''}}</label>&nbsp<label for="">Total Cash :{{$totalcashcollected}}</label>
					</h3></div>

					<table class="table" id="shoporder">
						<thead>
							<tr>

								<th>id</th>
								<th>Order No</th>
								<th>Order Date</th>
								<th>Shopname</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$totalcashcollectedss=0;
							if($shoporder!=null) 
							{
								?>

								@foreach($shoporder as $a)
								<tr>
									<td>{{$a->id}}</td>
									<td>{{$a->orderno}}</td>
									<td>{{date('d-m-Y',strtotime($a->created_at))}}</td>
									<td>
										@if($a->shopname==null)
										Admin
										@else
										{{$a->shopname}}
										@endif
									</td>
									<td>{{$a->amount}}</td>
								</tr>
							
								@endforeach
								
								<?php 
							}
							

							?>

						</tbody>
					</table>
				</div>
			</div>


		</div>
	</div> 
</div>
<!-- END PAGE CONTAINER -->


@stop

@section('js')
<script>

	$(document).ready( function () {
		$('#shoporder').DataTable({
			"order": [[ 0, "desc" ]],
			  "columnDefs": [
        {
          "targets": [ 0],
          "visible": false,
        }],
		"pageLength": 10,


		});
		
		var cashc=$('#collectionshopcount').val();
						//alert(cashc);
						$(".printcash").click(function(){
							if(cashc==0)
							{
								alert('0 Record found');
							}
						});

						$("#fromdate").datepicker({ dateFormat: "dd-mm-yyyy" }).datepicker("setDate", new Date());
						$("#todate").datepicker({ dateFormat: "dd-mm-yyyy" }).datepicker("setDate", new Date());

					});
				</script>

				@stop