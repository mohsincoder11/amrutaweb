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

     <h5 class="panel-title" style="color:#FFFFFF; background-color:#c93f18; width:100%; font-size:14px;" align="center"><i class="fa fa-male" aria-hidden="true"></i> &nbsp;Add Vendor</h5>
     <?php  $successcode=Session::get('successcode')?>
     <input type="hidden" value="{{$successcode}}" id="successcode">

    <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
      <div class="form-group"> 



        <form method="POST" action="{{url('insertvendor')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}      
          <input type="hidden" name="inputmode" value="insert" id="inputmode">                                
          <input type="hidden" name="updateid" id="updateid">                                
                                        <div class="col-md-12">
                                            <div class="form-group" style="margin-top:10px;">   
                                                          
                                               
                                               <div class="col-md-2"  style="margin-top:15px;">
                                                    <label>Name<font color="#FF0000">*</font></label>
                                                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" required/>                 
                                               </div>
                                                <div class="col-md-2" style="margin-top:15px;">
                                                  <label>Mobile No.<font color="#FF0000">*</font></label>
                                                    <input type="number" name="mobno" id="mobno" placeholder="Enter number" class="form-control" required/>
                                                </div> 
                                                
                                              <div class="col-md-2" style="margin-top:15px;">
                                                  <label>Address<font color="#FF0000">*</font></label>
                                                    <input type="text" name="address" id="address" placeholder="Enter Addresss" class="form-control" required/>
                                                </div>
                                                <div class="col-md-2" style="margin-top:15px;">
                                                    <label>E-mail<font color="#FF0000">*</font></label>
                                                    <input type="email" name="email" id="email" placeholder="Enter E-mail" class="form-control" required/>
                                                </div>
                                                <div class="col-md-2" style="margin-top:15px;">
                                                    <label>PAN<font color="#FF0000">*</font></label>
                                                    <input type="text" name="pan" id="pan" placeholder="Enter number" class="form-control" required/>
                                                </div>
                                                <div class="col-md-2" style="margin-top:15px;">
                                                    <label>Bank Name<font color="#FF0000">*</font></label>
                                                    <input type="text" name="bankname" id="bankname" placeholder="Enter Details" class="form-control" required/>
                                                </div> 
                                                <div class="col-md-2" style="margin-top:15px;">
                                                    <label>Account No.<font color="#FF0000">*</font></label>
                                                    <input type="text" name="accno" id="accno" placeholder="Enter Details" class="form-control" required/>
                                                </div>
                                                <div class="col-md-2" style="margin-top:15px;">
                                                    <label>IFSC code<font color="#FF0000">*</font></label>
                                                    <input type="text" name="ifsccode" id="ifsccode" placeholder="Enter Details" class="form-control" required/>
                                                </div>

                                                
                                                
                                                
                                                
                                                 <div class="col-md-2"  style="margin-top:15px;">
                                                    <label>Shed Size<font color="#FF0000">*</font></label>
                                                    <input type="number" name="shedsize" id="shedsize" placeholder="Enter Size" class="form-control" required/>                 
                                               </div>
                                               <div class="col-md-2"  style="margin-top:15px;">
                                                    <label>Capacity<font color="#FF0000">*</font></label>
                                                    <input type="text" name="capacity" id="capacity" placeholder="Enter Capacity" class="form-control" required/>                 
                                               </div>
                                               <div class="col-md-2"  style="margin-top:15px;">
                                                    <label>Distance<font color="#FF0000">*</font></label>
                                                    <input type="text" name="distance" id="distance" placeholder="Enter Distance" class="form-control" required/>                 
                                               </div>
                                               <div class="col-md-2"  style="margin-top:15px;">
                                                    <label>Geo Location<font color="#FF0000">*</font></label>
                                                    <input type="text" name="geolocation" id="geolocation" placeholder="Map" class="form-control" required/>                 
                                               </div>  
                                                <div class="col-md-offset-5 col-md-2 pt-2">
                         <button type="aubmit" class="btn btn-primary col-md-12" style="margin-top: 30px; margin-left: 20px; "><i class="fa fa-plus"></i><span id="inputlabel">Add Vendor</span></button>                

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




   <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">


     <div class="panel panel-default">






      <h5 class="panel-title" style="color:#FFFFFF; background-color:#c93f18; width:100%; font-size:14px;" align="center"><i class="fa fa-male" aria-hidden="true"></i> Added Vendor</h5>

      <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
       <table class="table" id="vendortable">
        <thead>
         <tr>
          <th>id</th>

          <th>Name</th>
          <th>Mob No</th>
          <th>Address</th>
          <th>Email</th>
          <th>Pan No</th>
          <th>Bank Name</th>
          <th>Acc No</th>
          <th>Shed Size</th>
          <th>Capacity</th>
          <th>Distance</th>
          <th>Geolocation</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="vendorrow">
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
  showvendor();
  function showvendor()
  {
    $.ajax({
      type: "get",
      url: "{{url('getvendor')}}",
      dataType:'json',
      success:function(data) {
        console.log(data);
        $('#vendortable').DataTable().clear().destroy();
        $.each(data, function (a, b) { 
          $("#vendorrow").append(
            '<tr><td>'+b.id+'</td><td>'+b.name+'</td><td>'+b.mobno+'</td><td>'+b.address+'</td><td>'+b.email+'</td><td>'+b.pan+'</td><td>'+b.bankname+'</td><td>'+b.accno+'</td><td>'+b.shedsize+'</td><td>'+b.capacity+'</td><td>'+b.distance+'</td><td>'+b.geolocation+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
            );
                                      //alert(data[j].fullname);
                                    });
        createtable();

 $("#loader").hide();

      }
    });                       


  }
  $('#vendortable tbody').on('click', '.delete', function () {
   var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{url('deletevendor')}}",
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
  $('#vendortable tbody').on('click', '.editrecord', function () {
   var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{url('editvendor')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
      $("#accno").val(data.accno);
      $("#ifsccode").val(data.ifsccode);
      $("#shedsize").val(data.shedsize);
      $("#distance").val(data.distance);
      $("#email").val(data.email);$("#address").val(data.address);
      $("#pan").val(data.pan);
      $("#name").val(data.name);
      $("#address").val(data.address);
      $("#mobno").val(data.mobno);
      $("#capacity").val(data.capacity);
      $("#geolocation").val(data.geolocation);
      $("#bankname").val(data.bankname);

      $("#inputmode").val('update');
      $("#updateid").val(data.id);
      $("#inputlabel").text('Update Vendor');

    }
  });
});
  function createtable()
  {
    $("#vendortable").dataTable(
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