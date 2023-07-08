@extends('layout')
@section('content')

<div class="page-content-wrap">
	
	@include('reports/reportlayout')



	<div class="row">
		<div class="col-md-12" style="margin-top:-15px;">
			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">

				<h5 class="panel-title" style="color:#FFFFFF; background-color:#a43f3e; width:100%; font-size:14px;" align="center"><i class="fa fa-percent"></i> &nbsp;Shop Discount Report</h5>
				<div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
					<div class="form-group"> 


						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-7">
								<form method="POST" action="{{url('shopdiscountreports')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
									{{ csrf_field() }}                                       
									<div class="col-md-12">
										<div class="form-group" style="margin-top:-10px;">   

											<div class="col-md-3" style="margin-top:15px; padding-left:5px; padding-right:2px;">
												<label>Start Date<font color="#FF0000"></font></label>
												<div class="input-group">
													<input type="text" value="{{$fromdatepage ?? '' ?? ''}}" name="fromdate" id="fromdate" class="form-control "data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
													<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												</div>

											</div>
											<div class="col-md-3" style="margin-top:15px; padding-left:5px; padding-right:2px;">
												<label>To Date<font color="#FF0000"></font></label>
												<div class="input-group">
													<input type="text" value="{{$todatepage ?? '' ?? ''}}" name="todate" id="todate" class="form-control "data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
													<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												</div>

											</div>
											<div class="col-md-3" style="margin-top:15px; padding-left:5px; padding-right:2px;">
												<label>Select Shop<font color="#FF0000"></font></label>
												<div class="input-group">
													<select name="shopid" data-live-search="true" id="assignto" class="select">
														<option value="all">All</option>

														@foreach($shop as $s)
														<option value="{{$s['shopname']}}">{{$s['shopname']}}</option>
														@endforeach
													</select>
												</div>

											</div>
											



											<div class="col-md-3" style="margin-top:3.2rem;" align="center">

												<div class="input-group col-md-12" style=" margin-bottom:15px;">

													<button type="submit" class="btn btn-primary col-md-12"><span class="fa fa-search"></span> Search</button>
												</div>
											</div> 





										</div> 
									</div>
								</form>
							</div>
							<div class="col-md-3" >
								<form method="POST" action="{{url('printshopdiscount')}}" class="form-horizontal" name="printform" id="printform" enctype="multipart/form-data" target="_blank">
									@csrf

									<div class="input-group col-md-12" style=" margin-bottom:15px;margin-top:2.4rem;">
										<input type="hidden" name="printfromdate" id="printfromdate" value="<?php if ($fromdatepage ?? '' ?? '' ?? ''!=null): ?>
										{{$fromdatepage ?? '' ?? '' ?? ''}}
										<?php endif ?>">
										<input type="hidden" name="printtodate" id="printtodate" value="<?php if ($todatepage ?? '' ?? ''!=null): ?>
										{{$todatepage ?? '' ?? ''}}
										<?php endif ?>">
										<input type="hidden" name="shopid" value="{{$shopid}}">
										<input type="hidden" name="shopordercount" id="shopordercount" value="{{$shopordercount}}">
										<input type="hidden" name="totaldiscount" value="{{$totaldiscount}}">
										<button type="submit" class="btn btn-warning col-md-6 printshoporder"><span class="fa fa-print"></span> Print</button>
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






				<h5 class="panel-title" style="color:#FFFFFF; background-color:#a43f3e; width:100%; font-size:14px;" align="center"><i class="fa fa-bank"></i> Shop Orders</h5>
				<div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
					<div class="row" ><h3 style="margin-top: 10px;text-align: center">From :{{$fromdatepage ?? ''}} &nbsp; To :{{$todatepage ?? ''}} </h3><h3 style="margin-top: 10px;text-align: center;color: black;">Shop :{{ucfirst($shopid)}} &nbsp;
					Toal Discount :{{$totaldiscount}}</h3></div>

					<table class="table" id="shoporder">
						<thead>
							<tr>

								<th>id</th>
								<th>Order No</th>
								<th>Order Date</th>
								<th>Item Name</th>
								<th>Discount</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($shoporder!=null) 
							{
								?>

								@foreach($shoporder as $a)
								<tr>
									<td>{{$a->id}}</td>
									<td>{{$a->orderno}}</td>
									<td>{{date('d-m-Y',strtotime($a->created_at))}}</td>

									<td>
{{$a->items}}
									</td>
									<td>{{$a->discount}}</td>
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

		var shopordercount=$('#shopordercount').val();
						//alert(shopordercount);
						$(".printshoporder").click(function(){
							if(shopordercount==0)
							{
								alert('0 Record found');
							}
						});

						$("#fromdate").datepicker({ dateFormat: "dd-mm-yyyy" }).datepicker("setDate", new Date());
						$("#todate").datepicker({ dateFormat: "dd-mm-yyyy" }).datepicker("setDate", new Date());

					});
				</script>

				@stop