@extends('layout')
@section('content')
<div id="snackbarsuccess">
<div class="row">
  <div class="col-md-12"><label for=""><strong>Success!</strong> Record Created Successfully.</label></div>

</div>               

</div>
<div id="snackbarupdate">
<div class="row">
  <div class="col-md-12"><label for=""><strong>Success!</strong> Record Updated Successfully.</label></div>

</div>                   

</div>
<div class="page-content-wrap">
	
	 @include('master/masterlayout')


  <div class="row">
   <div class="col-md-12" style="margin-top:-15px;">
    <!-- START DEFAULT DATATABLE -->
    <div class="panel panel-default">

     <h5 class="panel-title" style="color:#FFFFFF; background-color:#849429; width:100%; font-size:14px;" align="center"><i class="fa fa-building" aria-hidden="true"></i> &nbsp;Add Godawn</h5>
     <?php  $successcode=Session::get('successcode')?>
     <input type="hidden" value="{{$successcode}}" id="successcode">     
  
    <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
      <div class="form-group"> 



        <form method="POST" action="{{url('insertgodawn')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}      
          <input type="hidden" name="inputmode" value="insert" id="inputmode">                                
          <input type="hidden" name="updateid" id="updateid">                                
             <div class="col-md-12">
            <div class="row" style="margin-top:10px;">   

            


             <div class="col-md-2 col-md-offset-2" >
              <label>Address<font color="#FF0000">*</font></label>
              <textarea  class="form-control" name="address" id="address" rows="1"  required></textarea> 
            </div>
            <div class="col-md-2"  >
              <label>Geo Location<font color="#FF0000">*</font></label>
              <input type="text" name="geolocation" id="geolocation" placeholder="current location" class="form-control" required/>                 
            </div>
 <div class="col-md-2"  >
              <label>Godawn Name<font color="#FF0000">*</font></label>
              <input type="text" name="godawnname" id="godawnname" placeholder="Godawn Name" class="form-control" required/>                 
            </div>

            <div class="col-md-2" >
              <label>Name of Person <font color="#FF0000">*</font></label>
              <input type="text" placeholder="Enter Name" id="pername" name="pername" class="form-control" required/>
            </div> 

            
          </div> 
          <div class="row" style="padding-top: 1%;">
            <div class="col-md-2 col-md-offset-2"  >
              <label >Mobile No.<font color="#FF0000">*</font></label>
              <input  type="number" placeholder="Enter Mobile Number" id="mobno" name="mobno" class="form-control" required/>
            </div>

            <div class="col-md-2"  >
              <label>Live Bird Capacity<font color="#FF0000">*</font></label>
              <input type="number" placeholder="Enter Capacity" name="capacity" id="capacity" class="form-control" required/>                 
            </div>
            <div class="col-md-2 " >
              <label>Opening Birds<font color="#FF0000">*</font></label>
              <input type="number" placeholder="Enter Opening Birds" id="opening_birds" name="opening_birds" class="form-control" required/>
            </div>

            <div class="col-md-2"  >
              <label>Birds Weight<font color="#FF0000">*</font></label>
              <input type="number" placeholder="Enter Weight" name="birds_weights" id="birds_weights" class="form-control" required/>                 
            </div>
          </div>
          <div class="row" style="padding-top: 2%;">
            <div class="col-md-offset-5 col-md-2 pt-4">
             <button type="aubmit" class="btn btn-primary col-md-12" ><i class="fa fa-plus"></i><span id="inputlabel">Add Godawn</span>
             </button></div>
                                       

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




   <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">


     <div class="panel panel-default">






      <h5 class="panel-title" style="color:#FFFFFF; background-color:#849429; width:100%; font-size:14px;" align="center"><i class="fa fa-building" aria-hidden="true"></i> Added Godawn</h5>

      <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
       <table class="table" id="godawntable">
        <thead>
         <tr>
          <th>id</th>

          <th width="10%">Address</th>
          <th width="10%">Geolocation</th>
          <th width="10%">Godawn Name</th>
          <th width="10%">Person Name</th>
          <th width="10%">Mobile Number</th>
          <th width="10%">Live Birds Capacity</th>
          <th width="10%">Opening Birds</th>
          <th width="5%">Action</th>
        </tr>
      </thead>
      <tbody id="godawnrow">
      </tbody>
    </table>
  </div>
</div>


</div>
</div>            





</div>                                
</div>
<!-- PAGE CONTENT WRAPPER -->   
</div>            
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

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
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $(document).ready( function () {

    var x = document.getElementById("geolocation");
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }

    function showPosition(position) {  
     var geolocation=position.coords.latitude+','+position.coords.longitude;
     $('#geolocation').val(geolocation);
   }
   if($("#successcode").val()=='insert')
    {
      var x = document.getElementById("snackbarsuccess");
              x.className = "show";
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
    if($("#successcode").val()=='update')
    {
      var x = document.getElementById("snackbarupdate");
              x.className = "show";
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
  $('#customertable').DataTable({
    "order": [[ 0, "desc" ]],


  });

  $("#form").validate({

  });
  showgodawn();
  function showgodawn()
  {
    $.ajax({
      type: "get",
      url: "{{url('getgodawn')}}",
      dataType:'json',
      success:function(data) {
        console.log(data);
        $('#godawntable').DataTable().clear().destroy();
        $.each(data, function (a, b) { 
          $("#godawnrow").append(
            '<tr><td>'+b.id+'</td><td>'+b.address+'</td><td>'+b.geolocation+'</td><td>'+b.godawnname+'</td><td>'+b.pername+'</td><td>'+b.mobno+'</td><td>'+b.capacity+'</td><td>'+b.opening_birds+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
            );
                                      //alert(data[j].fullname);
                                    });
        createtable();
 $("#loader").hide();

      }
    });                       


  }
  $('#godawntable tbody').on('click', '.delete', function () {
   var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{url('deletegodawn')}}",
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
  $('#godawntable tbody').on('click', '.editrecord', function () {
   var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{url('editgodawn')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
      $("#address").val(data.address);
      $("#geolocation").val(data.geolocation);
      $("#godawnname").val(data.godawnname);
      $("#pername").val(data.pername);
      $("#mobno").val(data.mobno);
      $("#capacity").val(data.capacity);
      $("#opening_birds").val(data.opening_birds);
      $("#birds_weights").val(data.birds_weights);
      $("#inputmode").val('update');
      $("#updateid").val(data.id);
      $("#inputlabel").text('Update Godawn');

    }
  });
});
  function createtable()
  {
    $("#godawntable").dataTable(
    {
      "info": true,
      "autoWidth": false,
      responsive: true,
      "pageLength": 10,

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
} );

</script>

@stop