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

            <h5 class="panel-title" style="color:#FFFFFF; background-color:#101215  ; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i> &nbsp;Distribute to Shop/Cutting Unit</h5>

            <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
                <div class="form-group"> 



                   <form role="form" method="post" action="{{url('insertdistribute')}}">
                    @csrf
                    <input type="hidden" name="inputmode" id="inputmode" value="insert">
                    <input type="hidden" name="updateid" id="updateid">

                    <input type="hidden" name="godawn_id" id="godawn_id"> 
                    <input type="hidden" name="user_id" id="user_id" > 

                    <div class="col-md-12">
                        <div class="row" style="margin-top:-10px;">   

                            <div class="col-md-2" style="margin-top:15px;">
                                <label>Date<font color="#FF0000"></font></label>
                                <input type="date" name="date" id="date" value="{{date('Y-m-d')}}" class="form-control" required/>
                            </div>
                            <div class="col-md-2" style="margin-top:15px;">
                                <label>Time<font color="#FF0000"></font></label>
                                <input type="time" name="time" id="time" placeholder="" class="form-control" required/>
                            </div>

                            <div class="col-md-2" style="margin-top:15px;">
                                <label>Opening Birds<font color="#FF0000"></font></label>
                                <input type="number" name="openingbirds" id="openingbirds" placeholder="Opening Birds" class="form-control" readonly required/>
                            </div>

                            <div class="col-md-1" style="margin-top:15px;">
                                <label>Vehicle No.<font color="#FF0000"></font></label>
                                <input type="text" name="vehno" id="vehno" placeholder="Vehicle No" class="form-control" required/>
                            </div>
                            <div class="col-md-2" style="margin-top:15px;">
                                <label>Driver Name<font color="#FF0000"></font></label>
                                <input type="text" name="drivername" id="drivername" placeholder="Driver Name" class="form-control" required/>
                            </div>
                            <div class="col-md-1" style="margin-top:15px;">
                                <label>No. of Birds<font color="#FF0000"></font></label>
                                <input type="text" name="noofbirds" id="noofbirds" placeholder="No of Birds" class="form-control" required/>
                            </div>
                            <div class="col-md-1" style="margin-top:15px;">
                                <label>Total Wt.<font color="#FF0000"></font></label>
                                <input type="text" name="totalwt" id="totalwt" placeholder="Total Wt" class="form-control" required/>
                            </div>
                            <div class="col-md-1" style="margin-top:15px;">
                                <label>Avg.Bird Wt.<font color="#FF0000"></font></label>
                                <input type="text" name="avgbirdwt" id="avgbirdwt" placeholder="Avg Bird Wt" class="form-control " readonly="" required/>
                            </div>





                        </div> 
                        <div class="row">
                          <div class="col-md-2" style="margin-top:15px;">
                            <label> Shop/Cutting Unit <font color="#FF0000"></font></label>
                            <select class="form-control select" name="shopcutunit" id="shopcutunit">

                            </select>
                        </div>


                    </div>
                    <div class="row">
                       <div class="col-md-12" style="margin-top:15px;" >
                        <button type="submit" class="btn btn-info"><span class="fa fa-plus"></span>  Add</button>
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
                <table class="table " id="distributetable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Vehicle No.</th>
                            <th>Driver Name</th>
                            <th>No. of Birds</th>
                            <th>Total Wt.</th>
                            <th>Avg Birds Wt.</th>
                            <th>Shop/Cutting Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="distributerow">

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
<div class="col-md-12 cancelmodel" id="select_godawn">
  <div class="col-md-offset-4 col-md-4 modalbody" >

    <div class="modal-content">
      <div class="row" style=""> 
        <h3 style="color: #000;text-align: center"> Select Godawn <span class="close closemodel" style="float: right">&times;</span></h3>


    </div>
    <div class="form-group">
     <select name="" id="godawnmodel_select" class="form-control select">
        <option value="" >Select Godawn</option>
        @foreach($godawns as $g)
        <option value="{{$g->id}}" opening_birds="{{$g->opening_birds}}">{{$g->godawnname}}

        </option>
        @endforeach
    </select>
</div>

</div>

</div>

</div>
@stop
@section('js')
<script>
    $( document ).ready(function() {
        $("#godawnmodel_select").on('change',function()
        {
          var opening_birds=$("#godawnmodel_select option:selected").attr('opening_birds');
          $("#godawn_id").val($("#godawnmodel_select").val());
          $("#openingbirds").val(opening_birds);

      })
        $.ajax({
          type: "get",
          url: "{{Route('get_godawn_opening_birds')}}",
          data: {_token: CSRF_TOKEN}, 
          dataType:'json',
          success:function(data) {
            console.log(data);
            $("#user_id").val(data['user_id']);
            if(data['response']==1)
            {
              $("#select_godawn").show({
                height: 'toggle'
            });

          }   
          else
          {
           $("#godawn_id").val(data['godawns']);
           $("#openingbirds").val(data['opening_birds']);
           $("#user_id").val(data['user_id']);

       }  
   }
});
        $(".closemodel").click(function(){
          $("#select_godawn").hide();
      });


        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        shopcutunit();
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
        function shopcutunit()
        {
            $.ajax({
                type: "get",
                url: "{{Route('getshopnameid')}}",
                dataType:'json',
                success:function(data) {
                           // console.log(data);
                           $("#shopcutunit").empty(); 
                           $.each(data, function (a, b) {

                            $("#shopcutunit").append('<option value="'+b.id+'">'+b.shopname+'</option>');
                        });
                           $("#shopcutunit").selectpicker('refresh');
                       }
                   });
        }
        showdistribute();
        function showdistribute()
        {
            $.ajax({
                type: "get",
                url: "{{Route('getdistribute')}}",
                dataType:'json',
                success:function(data) {
                    $('#distributetable').DataTable().clear().destroy();
                    $.each(data, function (a, b) { 
                        let avgbirdwt=parseFloat(b.avgbirdwt).toFixed(3);
                        let totalwt=parseFloat(b.totalwt).toFixed(3);

                        $("#distributerow").append(
                            '<tr><td>'+b.id+'</td><td>'+b.date+'</td><td>'+b.time+'</td><td>'+b.vehno+'</td><td>'+b.drivername+'</td><td>'+b.noofbirds+'</td><td>'+totalwt+'</td><td>'+avgbirdwt+'</td><td>'+b.shopname+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
                            );
                                      //alert(data[j].fullname);
                                  });
                    createtable();


                }
            });                       


        }
        $('#distributetable tbody').on('click', '.delete', function () {
           var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('deletedistribute')}}",
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
        $('#distributetable tbody').on('click', '.editrecord', function () {
            var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('editdistribute')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
        //console.log(data);
        $("#inputmode").val('update');
        $("#updateid").val(data.id);
        $("#date").val(data.date);
        $("#time").val(data.time);
        $("#vehno").val(data.vehno);
        $("#drivername").val(data.drivername);
        $("#noofbirds").val(data.noofbirds);
        $("#totalwt").val(data.totalwt);
        $("#avgbirdwt").val(data.avgbirdwt);
        $("#shopcutunit").val(data.shopcutunit);
        $("#shopcutunit").selectpicker('refresh');

    }
});
});
        function createtable()
        {
            $("#distributetable").dataTable(
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

        $("#noofbirds").keyup(function(){          

          var noofbirds = $("#noofbirds").val();
          var totalwt = $("#totalwt").val();        
          var avgbirdwt=totalwt/noofbirds;
          $("#avgbirdwt").val(avgbirdwt);   

      });     
      $("#totalwt").keyup(function(){          

          var noofbirds = $("#noofbirds").val();
          var totalwt = $("#totalwt").val();        
          var avgbirdwt=totalwt/noofbirds;
          $("#avgbirdwt").val(avgbirdwt);   
                                  

      });             

    });
</script>
@stop