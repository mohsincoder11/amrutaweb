@extends('layout')
@section('content')
<div id="snackbarsuccess">
	<div class="row">
		<div class="col-md-3"><img src="{{asset('public/logo/success3.gif')}}" alt=""></div>
		<div class="col-md-9"><label for=""><strong>Success!</strong> Record Created Successfully.</label></div>

	</div>               

</div>
<div id="snackbarupdate">
	<div class="row">
		<div class="col-md-3"><img src="{{asset('public/logo/infoicon.gif')}}" alt=""></div>
		<div class="col-md-9"><label for=""><strong>Success!</strong> Record Updated Successfully.</label></div>

	</div>                   

</div>
<?php  $successcode=Session::get('successcode')?>
<input type="hidden" value="{{$successcode}}" id="successcode">

<div class="page-content-wrap">

	@include('more.morelayout')



	<div class="row">
		<div class="col-md-12" style="margin-top:-15px;">
			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">

				<h5 class="panel-title" style="color:#FFFFFF; background-color:#ff0066; width:100%; font-size:14px;" align="center"><i class="fa fa-file-text"></i> &nbsp;Purchase Form</h5>

				<div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
					<div class="form-group"> 



						<form role="form" method="post" action="{{url('insertpurchaseform')}}">
							@csrf 					
							<input type="hidden" name="inputmode" id="inputmode" value="insert">
							<input type="hidden" name="updateid" id="updateid">
							<div class="col-md-12">
								<div class="row">
									

									<div class="form-group" style="margin-top:-10px;"> 
	<div class="col-md-2" style="margin-top:15px;">
											<label>Select GRN<font color="#FF0000"></font></label>
											<select class="form-control select" name="grn_id" id="grn_id">
											</select>
										</div>

										<div class="col-md-2" style="margin-top:15px;">
											<label>Date<font color="#FF0000"></font></label>
											<input type="date" name="date" id="date" value="{{date('Y-m-d')}}" placeholder="" class="form-control" required/>
										</div>
										<div class="col-md-2" style="margin-top:15px;">
											<label>Time<font  color="#FF0000"></font></label>
											<input type="time" name="time" id="time" placeholder="" class="form-control" required/>
										</div>

										<div class="col-md-2" style="margin-top:15px;">
											<label>Vehicle No.<font color="#FF0000"></font></label>
											<input type="text" name="vehicleno" id="vehicleno" placeholder="Enter Vehicle No" class="form-control" required/>
										</div>

										<div class="col-md-2" style="margin-top:15px;">
											<label> Vendor <font color="#FF0000"></font></label>
											<select class="form-control select" name="vendor" id="vendor">
											</select>
										</div>


										<div class="col-md-2" style="margin-top:15px;">
											<label>Ref. No.<font color="#FF0000"></font></label>
											<input type="text" name="refno" id="refno" placeholder="Enter Reference No" class="form-control" required/>
										</div>	
									




									</div> 
								</div>
								<div class="row" style="padding-top:1%;" id="grndata_row">
									<table width="100%" border="0">

										<tr>

											<td style="padding:5px;" width="15%">
												<label> Godawn<font color="#FF0000"></font></label> <br>

												<label for="" id="godawn_label"></label>
											</td>
											<td style="padding: 5px;" width="15%"> 
												<div class="input-group">                                         <label>Date of Purchase<font color="#FF0000"></font></label> <br>

													<label for="" id="purchase_date_label"></label>


												</div>
											</td>

											<td style="text-align:left; padding: 5px;" width="15%">                                         <label>Select Vendor<font color="#FF0000"></font></label> <br>

												<label for="" id="vendor_label"></label>

											</td>



											<!-- </div> -->



											<td style="text-align:left; padding: 5px;" width="15%">                                         <label>Vehicle No<font color="#FF0000"></font></label> <br>

												<label for="" id="vehicle_no_label"></label>

											</td>


											<td style="text-align:left; padding: 5px;" width="15%">                                         <label>Driver Name<font color="#FF0000"></font></label> <br>

												<label for="" id="drivername_label"></label>

												<td style="text-align:left; padding: 5px;" width="25%">                                         <label style="margin-left: 110px;">Transact Mortality<font color="#FF0000"></font></label><br> 
													<div class="row">
														<div class="col-md-6">
															<label for="" id="transmornos_label"></label>


														</div>
														<div class="col-md-6">
															<label for="" id="transmorwt_label"></label>
														</div>
													</div>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
									<div class="row">
										<div class="col-md-4"  style="padding-top: 1%;">

											<div class="input-group" >

												<button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span><span id="inputlabel">Add</span> </button>

											</div>
										</div>   
									</div>



								</div>
							</form>

						</div>
					</div>
				</div>
			</div>


			<div>
				<div>
					<!-- END DEFAULT DATATABLE -->
					<div class="col-md-12">

						<div class="panel panel-default" style="margin-top:-15px;">
							<div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
								<table class="table" id="grntable">
									<thead>
										<tr>
											<th>id</th>
											<th width="10%">PID No</th>
											<th width="10%">GRN Id</th>
											<th width="7%">Date</th>
											<th width="7%">Time</th>
											<th width="7%">Vehicle No.</th>
											<th width="20%">Vendor</th>
											<th width="10%">Ref. No.</th>
											<th width="8%">Action</th>
										</tr>
									</thead>
									<tbody id="grnrow">

									</tbody>
								</table>

								<!-- END DEFAULT DATATABLE -->


							</div>
						</div>                                
					</div>
				</div>
			</div>                                

		</div>

	</div>            

	<div class="loaderpage" id="loader">
		<div class="loader">
			<img src="{{asset('public/logo/cloader3.gif')}}" alt="">
		</div>
		<p class="loaderp">
			Loading........
		</p>
	</div>
	@stop
	@section('js')
	<script>
		$( document ).ready(function() {
			$("#grndata_row").hide();
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			if($("#successcode").val()==1)
			{
				var x = document.getElementById("snackbarsuccess");
				x.className = "show";
				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
			}
			if($("#successcode").val()==2)
			{
				var x = document.getElementById("snackbarupdate");
				x.className = "show";
				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
			}

			showgrn();
			getvendor();
			function getvendor()
			{
				$.ajax({
					type: "get",
					url: "{{Route('getvendornameid')}}",
					dataType:'json',
					success:function(data) {
                            //console.log(data);
                            $('#vendor').empty();
                            $.each(data, function (a, b) { 
                            	$("#vendor").append(
                            		'<option value="'+b.id+'" selected>'+b.name+'</option>'
                            		);
                                      //alert(data[j].fullname);
                                  });

                            $("#vendor").selectpicker('refresh');   

                        }
                    });
			}
			function showgrn()
			{

				$.ajax({
					type: "get",
					url: "{{Route('getpurchaseform')}}",
					dataType:'json',
					success:function(data) {
                            //console.log(data);
                            $('#grntable').DataTable().clear().destroy();
                            $.each(data, function (a, b) { 
                            	$("#grnrow").append(
                            		'<tr><td>'+b.id+'</td><td>'+b.pid+'</td><td>'+b.grnid+'</td><td>'+b.date+'</td><td>'+b.time+'</td><td>'+b.vehicleno+'</td><td>'+b.name+'</td><td>'+b.refno+'</td><td><button class="btn btn-primary btn-sm rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-sm rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
                            		);
                                      //alert(data[j].fullname);
                                  });
                            createtable();
                            $("#loader").hide();                   


                        }
                    });                       


			}
			$('#grntable tbody').on('click', '.delete', function () {
				var id = $(this).attr('id');
  //alert(id);
  $.ajax({
  	type: "get",
  	url: "{{Route('deletetpurchaseform')}}",
  	data: {_token: CSRF_TOKEN,id:id}, 
  	dataType:'json',
  	success:function(data) {
  		swal("Deleted!", "Your record has been deleted!", "success");
  		setTimeout(function(){
  			location.reload();
  		}, 1800)         
  	}
  });
});
			$('#grntable tbody').on('click', '.editrecord', function () {
				var id = $(this).attr('id');
  //alert(id);
  $.ajax({
  	type: "get",
  	url: "{{Route('editpurchaseform')}}",
  	data: {_token: CSRF_TOKEN,id:id}, 
  	dataType:'json',
  	success:function(data) {
  		console.log(data);
  		$("#inputmode").val('update');
  		$("#inputlabel").text('Update Purchase');
  		$("#updateid").val(data.id);
  		$("#date").val(data.date);
  		$("#time").val(data.time);
  		$("#vehicleno").val(data.vehicleno);
  		$("#vendor").val(data.vendor);
  		$("#vendor").selectpicker('refresh');
  		$("#refno").val(data.refno);
  		$("#grn_id").val(data.grn_id);
  		$("#grn_id").selectpicker('refresh');


  	}
  });
});
			$.ajax({
				type: "get",
				url: "{{Route('get_grn_id')}}",
				dataType:'json',
				success:function(data) {
					$('#grn_id').empty();
					$("#grn_id").append(
						'<option selected>select GRN</option>'
						);
					$.each(data, function (a, b) { 
						$("#grn_id").append(
							'<option value="'+b.id+'" >'+b.grnid+'</option>'
							);
                                      //alert(data[j].fullname);
                                  });
					$("#grn_id").selectpicker('refresh');

				}
			});

			$("#grn_id").on('change',function()
			{
				$("#grndata_row").show();
				$.ajax({
					type: "get",
					data:{id:$(this).val()},
					url: "{{Route('get_grn_data_by_id')}}",
					dataType:'json',
					success:function(data) {
						console.log(data);

						$("#godawn_label").text(data.godawnname);
						$("#purchase_date_label").text(data.dateofpur);
						$("#vendor_label").text(data.name);
						$("#vehicle_no_label").text(data.vehno);
						$("#drivername_label").text(data.drivername);
						$("#transmornos_label").text(data.transmornos);
						$("#transmorwt_label").text(data.transmorwt);
					}
				});
			})
			function createtable()
			{
				$("#grntable").dataTable(
				{
					"info": true,
					"autoWidth": false,
					responsive: true,
					"order": [[ 0, "desc" ]],
					"columnDefs": [
					{
						"targets": [ 0],
						"visible": false,
					}],
					language: {
						searchPlaceholder: 'Search...',
						sSearch: '',
						lengthMenu: '_MENU_ items/page',
					}

				});
			} 
		});
	</script>
	@stop