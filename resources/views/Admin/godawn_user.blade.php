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
  @include('Admin.admin_layout')



  <div class="page-content-wrap">  

    <div class="row">
      <div class="col-md-12" style="margin-top:-15px;">
       <!-- START DEFAULT DATATABLE -->
       <div class="panel panel-default">

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i> &nbsp;Godawn User</h5>


        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group"> 



           <form id="form" name="form">
            {{ csrf_field() }}   
            <input type="hidden" id="updateid">
            <div class="row" style="margin-top:10px;">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="form-group" >   

                 <div class="col-md-4" style="margin-top:15px;">
                  <label>Username<font color="#FF0000">*</font></label>
                  <input type="text" placeholder="Enter Username" class="form-control" required name="username" id="username" / >
                </div> 

                <div class="col-md-4" style="margin-top:15px;" id="passworddiv">
                  <label>Password<font color="#FF0000">*</font></label>
                  <input type="password" placeholder="Enter Password" class="form-control" required name="password" id="password" / >
                </div>  
                <div class="col-md-4" style="margin-top:15px;" id="passworddiv">
                  <label>Email<font color="#FF0000">*</font></label>
                  <input type="email" placeholder="Enter Email" class="form-control" required name="email" id="email" / >
                </div>
              </div> 
            </div> 
          </div>

          <div class="row">
            <div class="col-md-8 col-md-offset-2">
             <div class="form-group" style="margin-top:17px;">   

              <label style="padding-left: 10px;">Assign Roles<font color="#FF0000">*</font></label>
              <br>

              <div class="col-md-3">

                <div class="form-check">
                  <label class="form-check-label" for="grn"  style="padding-top: 4px;" >
                    <input type="checkbox" class="form-check-input " name="grn" value="0" id="grn">&nbsp;&nbsp;GRN</label>

                  </div>  
                </div>  
                <div class="col-md-3">
                 <label class="form-check-label" for="purchase" style="padding-top: 4px;"><input type="checkbox" class="form-check-input " name="purchase" value="0" id="purchase" /> &nbsp;&nbsp;Purchase Form</label>  
               </div>  
               <div class="col-md-3">
                 <label class="form-check-label" for="daily_supervision" style="padding-top: 4px;"><input type="checkbox" class="form-check-input " name="daily_supervision" value="0" id="daily_supervision" /> &nbsp;&nbsp;Daily Supervision</label>  
               </div>
               <div class="col-md-3">
                 <label class="form-check-label" for="distribute" style="padding-top: 4px;"><input type="checkbox" class="form-check-input " name="distribute" value="0" id="distribute" /> &nbsp;&nbsp;Distribute to Shop/Cutting Unit</label>  
               </div>        


             </div> 

           </div>
         </div>     
         <div class="row">
          <div class="col-md-8 col-md-offset-2">
           <div class="form-group" >   

            <br>
 <div class="col-md-3">
               <label class="form-check-label" for="dailyentry" style="padding-top: 4px;"><input type="checkbox" class="form-check-input " name="dailyentry" value="0" id="dailyentry" /> &nbsp;&nbsp;Daily entry for Shop</label>  
             </div>  
            <div class="col-md-3">

              <div class="form-check">
                <label class="form-check-label" for="gtog"  style="padding-top: 4px;" >
                  <input type="checkbox" class="form-check-input " name="gtog" value="0" id="gtog">&nbsp;&nbsp;Godawn to Godawn Transfer</label>

                </div>  
              </div>  
              <div class="col-md-3">
               <label class="form-check-label" for="stos" style="padding-top: 4px;"><input type="checkbox" class="form-check-input " name="stos" value="0" id="stos" /> &nbsp;&nbsp;Shop to Shop Transfer</label>  
             </div>  
             <div class="col-md-3">
               <label class="form-check-label" for="stog" style="padding-top: 4px;"><input type="checkbox" class="form-check-input " name="stog" value="0" id="stog" /> &nbsp;&nbsp;Shop to Godawn Transfer</label>  
             </div>
                  


           </div> 

         </div>
       </div> 





       <div class="row" style="padding-top: 2%;">
         <div class="form-group" style="margin-left:-5px;">
          <div class="col-md-12">
            <div class="col-md-5"></div>
            <button type="submit" class="btn btn-success col-md-2" id="addbutton"><span class="fa fa-user"></span><span id="addbuttonlabel"> Add User</span></button>
          </div></div>
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
    <div class="col-md-12" style="margin-top:1%;">


      <div class="panel panel-default">

       <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i>  &nbsp;Added Users</h5>


       <div class="col-md-2" style="margin-top:15px;"></div>

       <div class="col-md-8" style="margin-top:15px;">

        <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;" align="center">
          
          <table class="table" id="usertable" align="center">
            <thead>
              <tr>
                <th style="display: none;"></th>
                <th width=30%>Username</th>
                <th width=50%>Alloted Role</th>
                <th width=20%>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($godawn_user as $d)
              <tr>
                <td>{{$d->id}}</td>

                <td>{{$d->username}}</td>
                <td>
                  <strong>
                  @if($d->grn==1) 
                  GRN,
                  @endif
                  @if($d->purchase==1) 
                  Purchase Form,
                  @endif
                  @if($d->daily_supervision==1) 
                  Daily Supervision,
                  @endif
                   @if($d->distribute==1) 
                  Distribute to Shop/Cutting Unit,
                  @endif
                  @if($d->dailyentry==1) 
                  Daily Entry,
                  @endif
                 
                   @if($d->gtog==1) 
                  Godawn to Godawn,
                  @endif
                   @if($d->stos==1) 
                  Shop to Shop,
                  @endif
                  @if($d->stog==1) 
                  Shop to Godawn,
                  @endif
                 </strong>
                </td>
                <td><button class="btn btn-primary btn-xs rounded-circle editrecord" id="{{$d->user_id}}" data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id="{{$d->user_id}}" data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-2" style="margin-top:15px;"></div>

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
<!-- END PAGE CONTAINER -->
@stop

@section('js')
<script>
  $(document).ready( function () {


    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $( document ).on( "change", ":checkbox", function () {

      var id=$(this).attr('id');
      var val=$("#"+id).val();
      if(val==0)
      {
        $("#"+id).val(1);
      }
      if(val==1)
      {
        $("#"+id).val(0);
      }

//$("#resmake").val(0);
});

    $('#addbutton').on('click',function(e)
    {
     e.preventDefault();

     if($("#username").val().length<1 && $("#password").val().length<1)
     {
       return;
     }
     $.ajax({  	
      type: "get",
      url: "{{Route('add_godawn_user')}}",
      data: {_token: CSRF_TOKEN,updateid:$("#updateid").val(),username:$("#username").val(),email:$("#email").val(),password:$("#password").val(),gtog:$("#gtog").val(),stos:$("#stos").val(),stog:$("#stog").val(),grn:$("#grn").val(),dailyentry:$("#dailyentry").val(),daily_supervision:$("#daily_supervision").val(),purchase:$("#purchase").val(),distribute:$("#distribute").val()}, 
      dataType:'json',
      success:function(data) {
        if(data==1)
        {
          var x = document.getElementById("snackbarsuccess");
          x.className = "show";
          setTimeout(function(){ x.className = x.className.replace("show", "");
            location.reload(); }, 2500);
        }
        if(data==2)
        {
         var x = document.getElementById("snackbarupdate");
         x.className = "show";
         setTimeout(function(){ x.className = x.className.replace("show", ""); 
          location.reload();}, 2500);

       }


     }
   });
   });  


    $('#usertable').DataTable({
      "order": [[ 0, "desc" ]],
      "columnDefs": [
      {
        "targets": [ 0],
        "visible": false,
      }],

    });




    $('#usertable tbody').on('click', '.delete', function () {
  // Holds the product ID of the clicked element
  var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{Route('delete_godawn_user')}}",
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

    $('#usertable tbody').on('click', '.editrecord', function () {
  // Holds the product ID of the clicked element
  $("#passworddiv").hide();
  var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{Route('edit_godawn_user')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
    	console.log(data);
      $("#username").val(data.username);
      $("#email").val(data.email);
      $("#gtog").val(data.gtog);
      $("#stog").val(data.stog);
      $("#stos").val(data.stos);
       $("#grn").val(data.grn);
      $("#dailyentry").val(data.dailyentry);
      $("#daily_supervision").val(data.daily_supervision);
       $("#purchase").val(data.purchase);
      $("#distribute").val(data.distribute);
      $("#updateid").val(data.user_id);
      $("#addbuttonlabel").text('Update User');
      if(data.gtog==1)
      {
        $('#gtog').prop('checked', true);
      }
      if(data.stog==1)
      {
        $('#stog').prop('checked', true);
      }
      if(data.stos==1)
      {
        $('#stos').prop('checked', true);
      }
      if(data.daily_supervision==1)
      {
        $('#daily_supervision').prop('checked', true);
      }
      if(data.daily_entry==1)
      {
        $('#daily_entry').prop('checked', true);
      }
      if(data.purchase==1)
      {
        $('#purchase').prop('checked', true);
      }
      if(data.grn==1)
      {
        $('#grn').prop('checked', true);
      }
      if(data.distribute==1)
      {
        $('#distribute').prop('checked', true);
      }
   
      
      

    }
  });


});

    $("#form").validate({
      rules :{
        uniqueprefix: {
          required : true,
          minlength: 3,
          maxlength: 3,
        },

      },
      messages :{
        uniqueprefix: {
          required : 'Enter 3 Character Prefix'
        },      

      }
    });
    $("#loader").hide();  
  });


</script>

@stop