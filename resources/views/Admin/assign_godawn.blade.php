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

      <h5 class="panel-title" style="color:#FFFFFF; background-color:#ff0066; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i> &nbsp;Assign godawn</h5>


      <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
        <div class="form-group"> 



         <form id="form" name="form">
          {{ csrf_field() }}   
          <div class="row">
            <input type="hidden" id="updateid">
            <input type="hidden" id="inputmode" value="insert">
            <div class="col-md-2 col-md-offset-2">
              <div class="form-group" style="margin-top:-10px;">   

               <div class="col-md-12" style="margin-top:15px;">
                <label>Select User<font color="#FF0000">*</font></label>
               <select name="user_id" id="user_id" class="form-control select selectpicker">
                @foreach($godawn_user as $u)
                                 <option value="{{$u->id}}">{{$u->username}}</option>

                @endforeach
               </select>
                <label for="" id="usernamelabel" class="text-danger"></label>
              </div> 

            
            </div> 
          </div> 
          <?php $godown=App\Godawn::select('id','godawnname','assign_status')->get();
          ?>

          <div class="col-md-8">
            <div class="form-group" style="margin-top:7px;">   

              <label style="padding-left: 10px;">Assign Godawn<font color="#FF0000">*</font></label>
              <br>
              @foreach($godown as $g)  

              <div class="col-md-3">
                <div class="form-check"> 
                @if($g->assign_status==1)   
                  <input type="checkbox" class="form-check-input icheckboxs" disabled id="{{$g->id}}" value="{{$g->id}}" />
                                    &nbsp;&nbsp;
                  <label class="form-check-label" for="exampleCheck1"  style="margin-top:5px; color:#999999;" >{{ucfirst($g->godawnname)}}</label>

                  @else
                   <input type="checkbox" class="form-check-input icheckboxs" id="{{$g->id}}" value="{{$g->id}}" />
                                     &nbsp;&nbsp;
                  <label class="form-check-label" for="{{$g->id}}"  style="margin-top:5px;" >{{ucfirst($g->godawnname)}}</label>

                  @endif

                </div>   
              </div>  
                 

              @endforeach

            </div> 

          </div>        

        </div> 
        <div class="row" style="margin-top: -70px;">
         <div class="col-md-4"></div>
         <div class="col-md-8"><label for="" id="godawnarray" class="text-danger" style="font-weight: normal;"></label></div>
       </div>
       <div class="row" style="padding-top: 20px;">
         <div class="form-group" style="margin-left:-5px;">
          <div class="col-md-12">
            <div class="col-md-5"></div>
            <button type="submit" class="btn btn-success col-md-2" id="addbutton"><span class="fa fa-user"></span> <span id="addbuttonlabel"> Add User</span></button>
          </div></div></div>
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

       <h5 class="panel-title" style="color:#FFFFFF; background-color:#ff0066; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i>  &nbsp;Added Users</h5>


       <div class="col-md-2" style="margin-top:15px;"></div>

       <div class="col-md-8" style="margin-top:15px;">

        <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;" align="center">
          <table class="table" id="usertable" align="center">
            <thead>
              <tr>
                <th style="display: none;"></th>
                <th width=30%>Username</th>
                <th width=50%>Alloted Godawns</th>
                <th width=20%>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $b)
              <tr>
                <td>{{$b->id}}</td>
                <td>{{$b->username}}</td>
                <td>
                  <b>
                  <?php $arraydata=explode(",",$b->godawns);?>
                  @foreach($arraydata as $a)
                  <?php $godawnname=App\Godawn::select('godawnname')->where('id',$a)->first();
                  echo ucfirst($godawnname['godawnname']);?>, 

                  @endforeach
                  </b>
                </td>
                <td><button class="btn btn-primary btn-xs rounded-circle editrecord" id="{{$b->id}}" data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id="{{$b->id}}" data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td>
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
    
    $('#addbutton').on('click',function(e)
    {
     e.preventDefault();
     var idarray =[]; 

     -    $('.icheckboxs:checkbox:checked').each(function(){
      idarray.push($(this).val());
      
    });

     if(idarray.length==0)
     {
      $("#godawnarray").text('Please select atleast one checkbox');  
      return; 
    }
//alert($("#user_id").val());
    
    $.ajax({    
      type: "get",
      url: "{{Route('add_assign_godawn')}}",
      data: {_token: CSRF_TOKEN,idarray:idarray.toString(),user_id:$("#user_id").val(),updateid:$("#updateid").val()}, 
      dataType:'json',
      success:function(data) {
        console.log(data);
        $('#addbutton').addClass('disabled');
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
           location.reload(); }, 3000);

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
    url: "{{Route('delete_assign_godawn')}}",
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
  $(".icheckboxs").removeAttr('disabled');
  $(".form-check-label").css("color", "#000000");
  var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{Route('get_edit_assign_godawn')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
      //console.log(data);
      $('#form').trigger("reset");

      $("#inputmode").val('update');
      $("#user_id").val(data.id);
      $("#user_id").selectpicker('refresh');

      $("#updateid").val(data.id);
      $("#addbuttonlabel").text('Update User');
      var id;
      id=(data.godawns).split(",");
      $.each(id, function (a, b) { 
       $("#"+b).attr('checked',true);
     });

    }
  });


});

    $("#form").validate({
      rules :{
        username: {
          required : true,       
        },
        password: {
          required : true,       
        },

      },
      messages :{
        password: {
          required : 'Enter password'
        }, username: {
          required : 'Enter username'
        },      

      }
    });
    $("#loader").hide();  
  });


</script>

@stop