@extends('layout')
@section('content')

<div class="page-content-wrap">
	
	@include('reports/reportlayout')

	<div class="row">
		<div class="col-md-12" style="margin-top:-15px;">
			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">

				<h5 class="panel-title" style="color:#FFFFFF; background-color:#613660; width:100%; font-size:14px;" align="center"><i class="fa fa-shopping-cart"></i> &nbsp;Delivery Boy Report</h5>
				<div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
					<div class="form-group"> 


						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-7">
								<form method="POST" action="{{url('deliveryboyreports')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
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
												<label>Select Delivery Boy<font color="#FF0000"></font></label>
												<div class="input-group">
													<select name="deliveryboyid" data-live-search="true" id="assignto" class="select">
                                               <option value="all">All</option>

                                               @foreach($deliveryboy as $s)
                                               <option value="{{$s['id']}}">{{$s['name']}}</option>
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
								<form method="POST" action="{{url('printdeliveryboy')}}" class="form-horizontal" name="printform" id="printform" enctype="multipart/form-data" target="_blank">
									@csrf

									<div class="input-group col-md-12" style=" margin-bottom:15px;margin-top:2.4rem;">
										<input type="hidden" name="printfromdate" id="printfromdate" value="<?php if ($fromdatepage ?? '' ?? '' ?? ''!=null): ?>
										{{$fromdatepage ?? '' ?? '' ?? ''}}
										<?php endif ?>">
										<input type="hidden" name="printtodate" id="printtodate" value="<?php if ($todatepage ?? '' ?? ''!=null): ?>
										{{$todatepage ?? '' ?? ''}}
										<?php endif ?>">
										<input type="hidden" name="deliveryboyid" value="{{$deliveryboyid}}">
										<input type="hidden" name="deliveryboyidname" value="{{$deliveryboyidname}}">
										<input type="hidden" name="deliveryboyordercount" id="deliveryboyordercount" value="{{$deliveryboyordercount}}">
										<button type="submit" class="btn btn-warning col-md-6 printdeliveryboyorder"><span class="fa fa-print"></span> Print</button>
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






				<h5 class="panel-title" style="color:#FFFFFF; background-color:#613660; width:100%; font-size:14px;" align="center"><i class="fa fa-shopping-cart"></i> Delivery Boy Orders</h5>
				<div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
					<div class="row" ><h3 style="margin-top: 10px;text-align: center">From :{{$fromdatepage ?? ''}} &nbsp; To :{{$todatepage ?? ''}} </h3><h3 style="margin-top: 10px;text-align: center;color: black;">Delivery Boy :{{ucfirst($deliveryboyid)}} &nbsp;Total Order :{{$deliveryboyordercount}} &nbsp;Total Amount :{{isset($totalAmount) ? number_format($totalAmount,2) : ''}} 
					</h3></div>

					<table class="table" id="deliveryboyorder">
						<thead>
							<tr>

								<th>id</th>
								<th>Order No</th>
								<th>Order Date</th>
								<th>Item Name</th>
								<th>Amount</th>
								<th>Delivery Boy</th>
								<th>Timetaken</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$totaldiscount=0;
							if($deliveryboyorder!=null) 
							{
								?>

								@foreach($deliveryboyorder as $a)
								<tr>
									<td>{{$a->id}}</td>
									<td>{{$a->orderno}}</td>
									<td>{{date('d-m-Y',strtotime($a->created_at))}}</td>

									<td>
										{{$a->items}}
									</td>
									<td>{{$a->amount}}</td>
									<td>
										{{$a->assignto}}
									</td>
									<td>{{$a->timetaken}}</td>
								</tr>
								
								@endforeach
								
								<?php 
							}
							if($apporder!=null) 
							{
								?>

								@foreach($apporder as $a)
								<tr>
									<td>{{$a->id}}</td>
									<td>{{$a->orderno}}</td>
									<td>{{date('d-m-Y',strtotime($a->created_at))}}</td>

									<td>
										{{$a->items}}
									</td>
									<td>{{$a->amount}}</td>
									<td>
										{{$a->assignto}}
									</td>
									<td>{{$a->timetaken}}</td>
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
		$('#deliveryboyorder').DataTable({
			"order": [[ 0, "desc" ]],
			  "columnDefs": [
        {
          "targets": [ 0],
          "visible": false,
        }],
		"pageLength": 10,


		});
		

var deliveryboyordercount=$('#deliveryboyordercount').val();
						//alert(deliveryboyordercount);
						 $(".printdeliveryboyorder").click(function(){
						if(deliveryboyordercount==0)
						{
							alert('0 Record found');
						}
					});

		$("#fromdate").datepicker({ dateFormat: "dd-mm-yyyy" }).datepicker("setDate", new Date());
		$("#todate").datepicker({ dateFormat: "dd-mm-yyyy" }).datepicker("setDate", new Date());

	});
</script>

@stop