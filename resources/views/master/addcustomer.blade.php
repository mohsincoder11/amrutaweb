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

     <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;" align="center"><i class="fa fa-users"></i> &nbsp;Add Customers</h5>
     <?php  $successcode=Session::get('successcode')?>
     <input type="hidden" value="{{$successcode}}" id="successcode">
    <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
      <div class="form-group"> 



        <form method="POST" action="{{url('insertcustomer')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}    
          <input type="hidden" name="inputmode" value="insert" id="inputmode">                                   
          <input type="hidden" name="updateid" id="updateid">                                   
          <div class="col-md-12">
           <div class="form-group" style="margin-top:-10px;">   


            <div class="col-md-2"  style="margin-top:15px;">
             <label>Select Customer Type<font color="#FF0000">*</font></label>              
             <select class="form-control select" name="custtype" id="custtype">
             
            </select>
          </div> 

          <div class="col-md-2" style="margin-top:15px;">
           <label>Full Name<font color="#FF0000">*</font></label>
           <input type="text" placeholder="Enter Name" class="form-control" name="fullname" autofocus="" id="fullname" required/>
         </div> 

         <div class="col-md-2" style="margin-top:15px;">
           <label>Mobile<font color="#FF0000">*</font></label>
           <input type="number" placeholder="Enter Mobile Number" class="form-control" name="mobile" id="mobile" required/>
         </div>  
         <div class="col-md-2" style="margin-top:15px;">
           <label>Alternate Mobile</label>
           <input type="number" placeholder="Enter Mobile Number" class="form-control" name="altmobile" id="altmobile" />
         </div> 

         <div class="col-md-2" style="margin-top:15px;">
           <label>Address<font color="#FF0000">*</font></label>
           <input type="text" placeholder="Enter Addresss" class="form-control" id="address" name="address" required/>
         </div> 



         <div class="col-md-2" style="margin-top:3.1rem;" align="center">

           <div class="input-group" style=" margin-bottom:15px;">

            <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> <span id="inputlabel">  Add Customer</span></button>
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






      <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;" align="center"><i class="fa fa-users"></i> Added Customers</h5>

      <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
       <table class="table" id="customertable3">
        <thead>
         <tr>
          <th>id</th>
          <th>Customer Type</th>
          <th>Customer Name</th>
          <th>Mobile</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="customerrow">
        
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
    
    $('#customertable3 tbody').on('click', '.delete', function () {
     var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('deletecustomer')}}",
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
showcustomer();
  function showcustomer()
  {
        var table = $('#customertable3').DataTable({
        serverSide: true,
        ajax: "{{ route('getallcustomerlist') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'custtype', name: 'custtype'},
            {data: 'fullname', name: 'fullname'},
            {data: 'mobile', name: 'mobile'},
            {data: 'address', name: 'address'},
            {data: 'action', name: 'action', 
            orderable: false, 
            searchable: true,
        },
        ],   
        "order": [
                        [0, "desc"]
                    ],
                    "columnDefs": [{
                        "targets": [0],
                        "visible": false,
                    }],
                    "pageLength": 10,


                    responsive: true,
    });
                             


  }

  $('#customertable3 tbody').on('click', '.editrecord', function () {
   var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{url('editcustomer')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
      console.log(data);
      $("#custtype").empty();
      if(data.custtype=='Person')
      {
        $("#custtype").append(
        '<option value="'+data.custtype+'" selected="">'+data.custtype+'</option><option value="Hotel">Hotel</option>'
        );
      }
      if(data.custtype=='Hotel')
      {
        $("#custtype").append(
        '<option value="'+data.custtype+'" selected="">'+data.custtype+'</option><option value="Person">Person</option>'
        );
      }

      $("#custtype").selectpicker("refresh");

      $("#address").val(data.address);
      $("#fullname").val(data.fullname);
      $("#altmobile").val(data.altmobile);
      $("#mobile").val(data.mobile);
      $("#inputmode").val('update');
      $("#updateid").val(data.id);
      $("#inputlabel").text('Update Customer');

    }
  });
});
  $("#custtype").append(
        '<option value="Person">Person</option><option value="Hotel">Hotel</option>'
        );
      $("#custtype").selectpicker("refresh");

  
    $("#form").validate({
      rules :{
        mobile: {
          required : true,
          minlength: 10,
          maxlength: 10,
        },       

      },
      messages :{
        mobile: {
          required : 'Mobile Number Should Be 10 Digit.'
        }, 
        

      }
    });
    $("#loader").hide();

  } );

</script>

@stop