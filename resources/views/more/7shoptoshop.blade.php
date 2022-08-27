@extends('layout')
@section('content')
<?php  $successcode=Session::get('successcode')?>
                                       <input type="hidden" value="{{$successcode}}" id="successcode">
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
 <div class="page-content-wrap">

 @include('more.morelayout')


<div class="row">
    <div class="col-md-12" style="margin-top:-15px;">
       <!-- START DEFAULT DATATABLE -->
       <div class="panel panel-default">

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#996633; width:100%; font-size:14px;" align="center"><i class="fa fa-home"></i> &nbsp;Shop to Shop Transfer</h5>

        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
            <div class="form-group"> 



 <form role="form" method="post" action="{{url('insertstos')}}">
                    @csrf     
                     <input type="hidden" name="inputmode" id="inputmode" value="insert">
                <input type="hidden" name="updateid" id="updateid">
   
                                    <div class="col-md-12">
                        <div class="form-group" style="margin-top:-10px;">
                        <div class="col-md-2" style="margin-top:15px;">
                                                    <label> Target Shop <font color="#FF0000"></font></label>
                                                   <select class="form-control select"  name="targetshop" id="targetshop">
                                                        
                                                    </select>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                                                    <label> Source Shop <font color="#FF0000"></font></label>
                                                   <select class="form-control select"  name="sourceshop" id="sourceshop">
                                                       
                                                    </select>
                        </div>   
     <div class="col-md-2" style="margin-top:15px;">
                            <label>Date<font color="#FF0000"></font></label>
                            <input type="date" placeholder=""  name="date" id="date" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label>Time<font color="#FF0000"></font></label>
                            <input type="time" placeholder=""  name="time" id="time" class="form-control" required/>
                        </div>

                        <div class="col-md-2" style="margin-top:15px;">
                            <label>Vehicle No.<font color="#FF0000"></font></label>
                            <input type="text" placeholder="Vehicle Number"  name="vehicleno" id="vehicleno" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Driver Name <font color="#FF0000"></font></label>
                            <input type="text" placeholder="Driver Name"  name="drivername" id="drivername" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Live Birds (No.) <font color="#FF0000"></font></label>
                            <input type="text" placeholder="Live Birds No"  name="livebird" id="livebird" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Total Wt. <font color="#FF0000"></font></label>
                            <input type="text" placeholder="Total Weight"  name="totalwt" id="totalwt" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Avg. Birds Wt. <font color="#FF0000"></font></label>
                            <input type="text" placeholder="Average Birds Weight"  name="avgwt" id="avgwt" class="form-control" required/>
                        </div>

                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Raw Chicken <font color="#FF0000"></font></label>
                            <input type="text" placeholder="Raw Chicken"  name="rawchicken" id="rawchicken" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:36px;">
                            <button type="submit" class="btn btn-danger active">Transfer</button>
                        </div>
                        
                <div class="col-md-2" style="margin-top:1rem;" align="center">

                    <div class="input-group" style="margin-top:-10px; margin-bottom:15px;">

                        <!-- <button type="button" class="btn btn-primary"><span class="fa fa-user"></span> Add User</button> -->

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
                                    <table class="table " id="stostable">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Target Shop</th>
                                                <th>Source Shop</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Vehicle No.</th>
                                                <th>Driver Name</th>
                                                <th>Live Birds(No.)</th>
                                                <th>Total Wt.</th>
                                                <th>Avg Bird Wt.</th>
                                                <th>Raw Chicken</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="stosrow">
                                            
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
<!-- END PAGE CONTENT -->
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
         getshop();
 function getshop()
      {
       $.ajax({
        type: "get",
        url: "{{Route('getshopnameid')}}",
        dataType:'json',
        success:function(data) {
                           // console.log(data);
                            $('#sourceshop').empty();
                            $('#targetshop').empty();
                            $.each(data, function (a, b) { 
                                $("#sourceshop").append(
                                    '<option value="'+b.id+'" selected>'+b.shopname+'</option>'
                                    ); 
                                $("#targetshop").append(
                                    '<option value="'+b.id+'" selected>'+b.shopname+'</option>'
                                    );
                                      //alert(data[j].fullname);
                                  });

                            $("#sourceshop").selectpicker('refresh');                      
                            $("#targetshop").selectpicker('refresh');                      

                        }
                    });
   }
                        showstos();
                        function showstos()
                        {
                            $.ajax({
                        type: "get",
                        url: "{{url('getstos')}}",
                        dataType:'json',
                        success:function(data) {
                            //console.log(data);
                                                    $('#stostable').DataTable().clear().destroy();
                                                    $.each(data, function (a, b) { 
$("#stosrow").append(
    '<tr><td>'+b.id+'</td><td>'+b.targetshopname+'</td><td>'+b.sourceshopname+'</td><td>'+b.date+'</td><td>'+b.time+'</td><td>'+b.vehicleno+'</td><td>'+b.drivername+'</td><td>'+b.livebird+'</td><td>'+b.totalwt+'</td><td>'+b.avgwt+'</td><td>'+b.rawchicken+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
                                    );
                                      //alert(data[j].fullname);
                                  });
                                                                                createtable();

 
                        }
                        });                       
                    

                        }
                        $('#stostable tbody').on('click', '.delete', function () {
     var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{url('deletestos')}}",
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
                         $('#stostable tbody').on('click', '.editrecord', function () {
            var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('editstos')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
        //console.log(data);
        $("#inputmode").val('update');
        $("#updateid").val(data.id);
        $("#date").val(data.date);
        $("#time").val(data.time);
        $("#targetshop").val(data.targetshop);
        $("#sourceshop").val(data.sourceshop);
        $("#vehicleno").val(data.vehicleno);
        $("#drivername").val(data.drivername);
        $("#livebird").val(data.livebird);
        $("#totalwt").val(data.totalwt);
$("#avgwt").val(data.avgwt);
$("#rawchicken").val(data.rawchicken);
$("#targetshop").selectpicker('refresh');
$("#sourceshop").selectpicker('refresh');

    }
  });
});
                        function createtable()
                {
                    $("#stostable").dataTable(
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
                                            $("#loader").hide();                   

});
      </script>
       @stop