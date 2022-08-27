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

     <h5 class="panel-title" style="color:#FFFFFF; background-color:#267a75; width:100%; font-size:14px;" align="center"><i class="fa fa-viacoin" aria-hidden="true"></i> &nbsp;Add Unit</h5>
     <?php  $successcode=Session::get('successcode')?>
     <input type="hidden" value="{{$successcode}}" id="successcode">



     <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
      <div class="form-group"> 



        <form method="POST" action="{{url('insertunit')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}      
          <input type="hidden" name="inputmode" value="insert" id="inputmode">                                
          <input type="hidden" name="updateid" id="updateid">                                

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6">                    
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" >   
                      <label> Type of Unit <font color="#FF0000"></font></label>
                      <input type="text" name="unittype" id="unittype" placeholder="Enter Type Of Unit" class="form-control" required/>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" style="margin-top: 22px;margin-left: 10px;">  
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i><span id="inputlabel">Add Unit</span></button>          
                    </div> 
                  </div>
                </div>

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
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="panel panel-default">

            <h5 class="panel-title" style="color:#FFFFFF; background-color:#267a75; width:100%; font-size:14px;" align="center"><i class="fa fa-viacoin" aria-hidden="true"></i> Added Unit</h5>

            <div class="panel-body" style="margin-top:10px; margin-bottom:-15px;">
             <table class="table" id="unittable">
              <thead>
               <tr>
                <th>id</th>

                <th>Type Of Unit</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="unitrow">
            </tbody>
          </table>
        </div>
      </div>
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
   if($("#successcode").val()=='success')
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
  showunit();
  function showunit()
  {
    $.ajax({
      type: "get",
      url: "{{url('getunit')}}",
      dataType:'json',
      success:function(data) {
        //console.log(data);
        $('#unittable').DataTable().clear().destroy();
        $.each(data, function (a, b) { 
          $("#unitrow").append(
            '<tr><td>'+b.id+'</td><td>'+b.unittype+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
            );
                                      //alert(data[j].fullname);
                                    });
        createtable();
         $("#loader").hide();



      }
    });                       


  }
  $('#unittable tbody').on('click', '.delete', function () {
   var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{url('deleteunit')}}",
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
  $('#unittable tbody').on('click', '.editrecord', function () {
   var id = $(this).attr('id');
   $.ajax({
    type: "get",
    url: "{{url('editunit')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {

      $("#unittype").val(data.unittype);
      $("#inputmode").val('update');
      $("#updateid").val(data.id);
      $("#inputlabel").text('Update Unit');

    }
  });
 });
  function createtable()
  {
    $("#unittable").dataTable(
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