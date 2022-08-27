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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#ff0066; width:100%; font-size:14px;" align="center"><i class="fa fa-home"></i> &nbsp;Godawn to Godawn Transfer</h5>

        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
            <div class="form-group"> 



 <form role="form" method="post" action="{{url('insertgtog')}}">
                    @csrf 
                    <input type="hidden" name="inputmode" id="inputmode" value="insert">
                <input type="hidden" name="updateid" id="updateid">
   
                                        <div class="col-md-12">
                        <div class="row" style="margin-top:-10px;">
                       
                        <div class="col-md-2" style="margin-top:15px;">
                                                    <label> Source Godawn <font color="#FF0000"></font></label>
                                                   <select class="form-control select" name="sourcegod" id="sourcegod">
                                                        
                                                    </select>
                        </div> 
                         <div class="col-md-2" style="margin-top:15px;">
                                                    <label> Target Godawn <font color="#FF0000"></font></label>
                                                   <select class="form-control select" name="targetgod" id="targetgod">
                                                        
                                                    </select>
                        </div>  
                        <div class="col-md-2" style="margin-top:15px;">
                            <label>Date<font color="#FF0000"></font></label>
                            <input type="date" name="date" id="date" value="{{date('Y-m-d')}}" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label>Time<font color="#FF0000"></font></label>
                            <input type="time" name="time" id="time" placeholder="" class="form-control" required/>
                        </div>

                        <div class="col-md-2" style="margin-top:15px;">
                            <label>Vehicle No.<font color="#FF0000"></font></label>
                            <input type="text" name="vehicleno" id="vehicleno" placeholder="Enter Vehicle No" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Driver Name <font color="#FF0000"></font></label>
                            <input type="text" name="drivername" id="drivername" placeholder="Enter Driver Name" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Live Birds (No.) <font color="#FF0000"></font></label>
                            <input type="text" name="livebird" id="livebird" placeholder="Live Birds No" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Total Wt. <font color="#FF0000"></font></label>
                            <input type="text" name="totalwt" id="totalwt" placeholder="Total Weigth" class="form-control" required/>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;">
                            <label> Avg. Birds Wt. <font color="#FF0000"></font></label>
                            <input type="text" name="avgwt" id="avgwt" placeholder="Average Bird Weight" class="form-control" readonly required/>
                        </div>
                      
                        
                


            </div> 
            <div class="row">   
              <div class="col-md-2" style="margin-top:1%;">
                            <button type="submit" class="btn btn-info "> <span class="fa fa-plus">   </span> Add</button>
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
                                    <table class="table" id="gtogtable">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Target Godawn</th>
                                                <th>Source Godawn</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Vehicle No.</th>
                                                <th>Driver Name</th>
                                                <th>Live Birds(No.)</th>
                                                <th>Total Wt.</th>
                                                <th>Avg Bird Wt.</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="gtogrow">
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
    getgodawn();
      function getgodawn()
      {
       $.ajax({
        type: "get",
        url: "{{Route('getgodawnnameid')}}",
        dataType:'json',
        success:function(data) {
                            //console.log(data);
                            $('#targetgod').empty();
                            $.each(data, function (a, b) { 
                                $("#targetgod").append(
                                    '<option value="'+b.id+'" selected>'+b.godawnname+'</option>'
                                    );
                              
                                      //alert(data[j].fullname);
                                  });

                            $("#targetgod").selectpicker('refresh');                      

                        }
                    });
   }
       $.ajax({
        type: "get",
        url: "{{Route('get_source_godawn_nameid')}}",
        dataType:'json',
        success:function(data) {
                           

                            $('#sourcegod').empty();
                            $.each(data, function (a, b) { 
                               
                                $("#sourcegod").append(
                                    '<option value="'+b.id+'" selected>'+b.godawnname+'</option>'
                                    );
                                      //alert(data[j].fullname);
                                  });

                            $("#sourcegod").selectpicker('refresh');                      

                        }
                    });
                        showgtog();
                        function showgtog()
                        {
                            $.ajax({
                        type: "get",
                        url: "{{url('getgtog')}}",
                        dataType:'json',
                        success:function(data) {
                            //console.log(data);
                                                    $('#gtogtable').DataTable().clear().destroy();
                                                    $.each(data, function (a, b) { 
$("#gtogrow").append(
    '<tr><td>'+b.id+'</td><td>'+b.targetgodname+'</td><td>'+b.sourcegodname+'</td><td>'+b.date+'</td><td>'+b.time+'</td><td>'+b.vehicleno+'</td><td>'+b.drivername+'</td><td>'+b.livebird+'</td><td>'+b.totalwt+'</td><td>'+b.avgwt+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
                                    );
                                      //alert(data[j].fullname);
                                  });
                                                                                createtable();

 
                        }
                        });                       
                    

                        }
                        $('#gtogtable tbody').on('click', '.delete', function () {
     var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{url('deletegtog')}}",
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
                         $('#gtogtable tbody').on('click', '.editrecord', function () {
            var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('editgtog')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
        //console.log(data);
        $("#inputmode").val('update');
        $("#updateid").val(data.id);
        $("#date").val(data.date);
        $("#time").val(data.time);
        $("#targetgod").val(data.targetgod);
        $("#sourcegod").val(data.sourcegod);
        $("#vehicleno").val(data.vehicleno);
        $("#drivername").val(data.drivername);
        $("#livebird").val(data.livebird);
        $("#totalwt").val(data.totalwt);
$("#avgwt").val(data.avgwt);
$("#targetgod").selectpicker('refresh');
$("#sourcegod").selectpicker('refresh');

    }
  });
});
                        function createtable()
                {
                    $("#gtogtable").dataTable(
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

        $("#livebird").keyup(function(){          

          var livebird = $("#livebird").val();
          var totalwt = $("#totalwt").val();        
          var avgwt=totalwt/livebird;
          $("#avgwt").val(avgwt);   

      });    

        $("#totalwt").keyup(function(){          

          var livebird = $("#livebird").val();
          var totalwt = $("#totalwt").val();        
          var avgwt=totalwt/livebird;
          $("#avgwt").val(avgwt); 

      });                   

});
      </script>
@stop