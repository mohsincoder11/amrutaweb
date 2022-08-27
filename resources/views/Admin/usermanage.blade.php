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
<?php  $successcode=Session::get('successcode')?>
<input type="hidden" value="{{$successcode}}" id="successcode">


<div class="page-content-wrap">
  @include('Admin.admin_layout')


<div class="page-content-wrap">  

  <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">
     <!-- START DEFAULT DATATABLE -->
     <div class="panel panel-default">

      <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i> &nbsp;User Management</h5>


      <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
        <div class="form-group"> 



         <form method="POST" action="{{url('addusermanagement')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}   
          <div class="row">
            <div class="col-md-12">
              <div class="form-group" style="margin-top:-10px;">   


               <div class="col-md-2" style="margin-top:15px;">
                <label>Select User Type<font color="#FF0000">*</font></label>
                <select class="form-control select" name="usertype" required="" id="usertype">
                  <option value="3">Telecaller</option>
                  <option value="2">Shop</option>
                </select>
              </div>  
               <div class="col-md-2" style="margin-top:15px;">
                <label>Username<font color="#FF0000">*</font></label>
                <input type="text" placeholder="Enter Username" class="form-control" required name="username"/ >
              </div> 
              <div class="col-md-2" style="margin-top:15px;">
               <label>Unique Prefix (3 char)<font color="#FF0000">*</font></label>
               <input type="text" placeholder="Enter Unique Prefix" name="uniqueprefix" id="uniqueprefix" class="form-control" autocomplete="off" required/>
               <label for="" id="prefixerror" style="color: red"></label>
             </div>
             <input type="hidden" value="0" id="prefixcount" name="prefixcount">

             <div class="col-md-2" style="margin-top:15px;">
              <label>Password<font color="#FF0000">*</font></label>
              <input type="text" placeholder="Enter Password" class="form-control" required name="password"/ >
            </div>

            <div class="col-md-2" style="margin-top:15px;">
              <label>Email<font color="#FF0000">*</font></label>
              <input type="email" placeholder="Enter email" class="form-control" required name="email"/ >
            </div> 
            

      </div> 


    </div>  
  </div> 

  <div class="row">


            <div class="col-md-12">
              <div class="form-group" style="margin-top:-10px;">   
 <div id="shopfield">
   <div class="col-md-2" style="margin-top:15px;">
                <label>Shop Name<font color="#FF0000">*</font></label>
                <input type="text" placeholder="Enter Shop Name" class="form-control" required name="shopname"/ >
              </div> 
              <div class="col-md-2" style="margin-top:15px;">
               <label>Shop Address<font color="#FF0000">*</font></label>
               <input type="text" placeholder="Enter Address" name="address" id="address" class="form-control" autocomplete="off" required/>
             </div>
              <div class="col-md-2" style="margin-top:15px;">
               <label>Opening Birds<font color="#FF0000">*</font></label>
               <input type="integer" placeholder="Enter Opening Birds" name="opening_birds" id="opening_birds" class="form-control" autocomplete="off" required/>
             </div>
              <div class="col-md-2" style="margin-top:15px;">
               <label>Weight<font color="#FF0000">*</font></label>
               <input type="text" placeholder="Enter Weight" name="birds_weights" id="birds_weights" class="form-control" autocomplete="off" required/>
             </div>
 </div>
                
             <div class="col-md-6" style="padding-top:35px;">
               <table>
              <tr>
                <td style="padding-right:5px;">
                 <label class="check"><input type="checkbox" class="icheckbox" checked="checked" name="master" value="1" /> Master Settings</label>
               </td>

               <td style="padding-right:5px;">
                <label class="check"><input type="checkbox" class="icheckbox" checked="checked" name="telecaller" value="1"/> Telecaller Panel</label>
              </td>

              <td style="padding-right:5px;">
                <label class="check"><input type="checkbox" class="icheckbox" checked="checked" name="shop" value="1" /> Shop Panel</label>
              </td>

              <td style="padding-right:5px;">
                <label class="check"><input type="checkbox" class="icheckbox" checked="checked" name="report" value="1"/> Reports</label>
              </td>

            </tr>
          </table>
                  </div>

            

      </div> 


    </div>  
  </div>


 
  <div class="row" style="padding-top: 10px;">
   <div class="form-group" style="margin-left:-5px;">
    <div class="col-md-12">
      <div class="col-md-5"></div>
      <button type="submit" class="btn btn-success col-md-2" id="addbutton"><span class="fa fa-user"></span> Add User</button>
    </div></div></div>
  </form>

</div>
</div>
</div>
</div>
</div>



  <!-- END DEFAULT DATATABLE -->









  <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">


      <div class="panel panel-default">

       <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i> Added Users</h5>


       <div class="col-md-1" style="margin-top:15px;"></div>

       <div class="col-md-10" style="margin-top:15px;">

        <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;" align="center">
          <table class="table" id="usertable" align="center">
            <thead>
              <tr>
                <th style="display: none;"></th>
                <th>Username</th>
                <th>Prefix</th>
                <th>User Type</th>
                <th>Email</th>
                <th>Alloted Rights</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($user as $u)
              <tr>
                <td style="display: none">{{$u['id']}}</td>

                <td>{{$u['username']}}</td>
                <td>{{$u['uniqueprefix']}}</td>
                <td>
                  <?php if (  $u['role']==2): echo "Shop"; ?>

                  <?php endif ?>
                  <?php if ( $u['role']==3): echo "Telecaller";?>

                  <?php endif ?>
                  
                </td>
                <td>{{$u['email']}}</td>
                <td> <?php 
                if($u['master']!=null)
                {
                  echo 'Master/ ';
                }
                if($u['telecaller']!=null)
                {
                  echo ' Telecaller/ ';
                }
                if($u['shop']!=null)
                {
                  echo ' Shop/ ';
                }
                if($u['report']!=null)
                {
                  echo 'Report';
                }
                ?>
              </td>
              <td>
               <a href="{{url('editusermanage/'.$u['id'])}}" class="btn btn-warning btn-just-icon edit" id="{{$u['id']}}"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>

               <a href="#" class="btn btn-danger btn-just-icon delete" id="{{$u['id']}}"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>

             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
   </div>
 </div>

</div>
</div>                                

</div>

</div>            
<!-- END PAGE CONTENT -->

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
          $('#shopfield').hide();
                                         $('#usertype').on('change', function() {
                                          var usertype=$('#usertype').val();
                                          if(usertype=='2')
                                          {
                                                      $('#shopfield').show();
                                          }
                                          else
                                          {
                                                      $('#shopfield').hide();
                                          }

});

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var successcode=$('#successcode').val();
if(successcode=='success')
{
  var x = document.getElementById("snackbarsuccess");
              x.className = "show";
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);


}
if(successcode=='update')
{    
  var x = document.getElementById("snackbarupdate");
              x.className = "show";
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

}


  
  $("#uniqueprefix").keyup(function(){
    var value=$("#uniqueprefix").val();


    $.ajax({
      type: "get",
      url: "{{Route('checkuniqueprefixuser')}}",
      data: {_token: CSRF_TOKEN,value:value}, 
      dataType:'json',
      success:function(data) {
      //alert(data);
      if(value==data.uniqueprefix) 
      {
              $('#prefixerror').text("This Prefix Already Exist. Try Another One.");
        $('#addbutton').addClass('disabled');
      }  
      else
      {
                      $('#prefixerror').text("");

        $('#addbutton').removeClass('disabled');

      } 
    }
  });                    });
  $('#usertable').DataTable({
    "order": [[ 0, "desc" ]]

  });

       $('#usertable tbody').on('click', '.delete', function () {
  // Holds the product ID of the clicked element
  var id = $(this).attr('id');
  
  $.ajax({
    type: "get",
    url: "{{Route('deleteusermanage')}}",
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