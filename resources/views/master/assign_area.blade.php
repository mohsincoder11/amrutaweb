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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#909176; width:100%; font-size:14px;" align="center"><i class="fa fa-check" aria-hidden="true"></i> &nbsp;Assign Area</h5>
        <?php  $successcode=Session::get('successcode')?>
        <input type="hidden" value="{{$successcode}}" id="successcode">



        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group"> 



            <form  name="form" id="form">
              {{ csrf_field() }}   
              <input type="hidden" name="updateid" id="updateid">
              <input type="hidden" name="inputmode" id="inputmode" value="insert">
              <div class="class row">
               <?php $shop=App\Shop::select('id','shopname','assign_status')->get();
               ?>
               <div class="col-md-offset-2 col-md-3">
                 <div class="form-group" style="margin-top:10px;padding-left: 10px;">  
                   <label>Select Shop<font color="#FF0000">*</font></label>
<input type="hidden" name="shop_id2" id="shop_id2">
                   <select class="form-control select" name="shop_id" id="shop_id" required="">
                    @foreach($shop as $s)
                    @if($s->assign_status==1)
                    <option value="{{$s->id}}" disabled="" >{{$s->shopname}}</option>
                    @else
                                        <option value="{{$s->id}}">{{$s->shopname}}</option>

                    @endif
                    @endforeach
                  </select> 
                  <b><label for="" class="text-danger" id="shoplabel"></label></b>
                </div>
              </div>
            </div>

            <div class="class row">

              <div class="col-md-offset-2 col-md-9">
                <div class="form-group" >   

                  <label style="padding-left: 10px;">Assign Area<font color="#FF0000">*</font></label>
                  <br>
                  <?php $area=App\Area_master::get(); ?>
                  @foreach($area as $a)  
@if($a->shop_id>0) 
                  <div class="col-md-3">
                    <div class="form-check"> 
                        
                      <input type="checkbox" class="form-check-input icheckboxs "  name="shop_id" disabled id="{{$a->id}}" value="{{$a->id}}" />
                      &nbsp;&nbsp;
                      <label class="form-check-label" for="{{$a->id}}"  style="margin-top:5px; color:#999999;" >{{ucfirst($a->area)}}</label>
</div>
</div>
                      @else
                       <div class="col-md-3">
                    <div class="form-check"> 
                    
                      <input type="checkbox" class="form-check-input icheckboxs" name="shop_id" id="{{$a->id}}" value="{{$a->id}}" />
                      &nbsp;&nbsp;
                      <label class="form-check-label" for="{{$a->id}}"  style="margin-top:5px;" >{{ucfirst($a->area)}}</label>
 </div>   
                  </div>
                      @endif

                     


                  @endforeach

                </div> 

              </div> 
            </div>
            <div class="row">
              <div class="col-md-offset-2 col-md-2">
            <b>  <label for="" id="areaarray" class="text-danger" ></label>
              <label for="" id="areaarray2" class="text-danger" ></label>
</b>
            </div>
            </div>

            <div class="row">


              <div class="col-md-offset-2 col-md-2">

                <div class="input-group" style=" padding-top: 5%;margin-left: 10px;">

                 <button type="submit" class="btn btn-primary" id="addbutton"><span class="fa fa-plus"></span> <span id="inputlabel">  Assign Area</span></button>
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



          <div class="col-md-2" style="margin-top:15px;"></div>

          <div class="col-md-8" style="margin-top:15px;">
            <h5 class="panel-title" style="color:#FFFFFF; background-color:#909176; width:100%; font-size:14px;" align="center"><i class="fa fa-check" aria-hidden="true"></i> &nbsp;Assigned Area</h5>

            <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
              <table class="table" id="areatable">
                <thead>
                  <tr>
                    <th >id</th>
                    <th width="30%">Shop Name</th>
                    <th width="50%">Assign Area</th>

                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody id="arearow">
@foreach($assign_areas_data as $a)
<tr>
<td>{{$a->id}}</td>
<td>{{$a->shopname}}</td>
<td>
<?php $arraydata=explode(",",$a->assign_area);?>
                  @foreach($arraydata as $aa)
                  <?php $area=App\Area_master::select('area')->where('id',$aa)->first();
                  if($area)
                    echo ucfirst($area['area']);
                ?>, 

                  @endforeach</td>

<td>
  <button class="btn btn-primary btn-xs rounded-circle editrecord" id="{{$a->id}}" data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id="{{$a->id}}" data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a>
</td>
</tr>
@endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-3" style="margin-top:15px;"></div>


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

  $(document).ready( function () {
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    
   $("#loader").hide();
    $(".icheckboxs").on('click',function()
    {
      var areaid=$(this).attr('id');
$.ajax({    
      type: "get",
      url: "{{Route('check_area_assign')}}",
      data: {_token: CSRF_TOKEN,id:areaid}, 
      dataType:'json',
      success:function(data) {  
      
      if(data!=$("#shop_id2").val())
      {
        if(data!=0)
        {
          //alert('already assign area');
          $("#areaarray2").show();
                $("#areaarray2").text('This area is already assigned');  
                 setTimeout(function(){ $("#areaarray2").fadeOut(); }, 4000);
                $("#"+areaid).attr('checked',false); 

        }
         
      }


      }
    })

      })
$('#addbutton').on('click',function(e)
    {
     e.preventDefault();
     var idarray =[]; 

      $('.icheckboxs:checkbox:checked').each(function(){
      idarray.push($(this).attr('id'));
     
    });
     if(idarray.length==0)
     {
      $("#areaarray").text('Please select atleast one area');   
      return;
    }
    
    var shop_id;
    if($("#shop_id").val()==null)
    {
      shop_id=$("#shop_id2").val();
    }
    else
    {
shop_id=$("#shop_id").val();
    }
    if($("#inputmode").val()=='insert' && $("#shop_id").val()==null)
    {
      //alert(1);
$("#shoplabel").text('This field is required');
return;
    }
    
 $.ajax({    
      type: "get",
      url: "{{Route('insert_assign_area')}}",
      data: {_token: CSRF_TOKEN,updateid:$("#updateid").val(),assign_area :idarray.toString(),shop_id:shop_id}, 
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
$('#shop_id').on('change',function () {
  $('#shop_id2').val($(this).val());
  })
    $('#areatable tbody').on('click', '.delete', function () {
  // Holds the product ID of the clicked element
  var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{Route('delete_assign_area')}}",
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

    });

    

    $('#areatable tbody').on('click', '.editrecord', function () {
     var id = $(this).attr('id');
     $.ajax({
      type: "get",
      url: "{{url('get_single_assign_area')}}",
      data: {_token: CSRF_TOKEN,id:id}, 
      dataType:'json',
      success:function(data) {
        $(".icheckboxs").attr('disabled',false);
       // $("#"+data.shop_id).attr('disabled',false);
        $(".form-check-label").css("color", "#000000");
        $("#updateid").val(data.id);
        $("#inputmode").val('update');
        $("#shop_id2").val(data.shop_id);
        $("#shop_id").val(data.shop_id);
                $("#shop_id").selectpicker('refresh');
        $("#inputlabel").text('Update Assign Area');
        var id;
      id=(data.assign_area).split(",");
      $.each(id, function (a, b) { 
       $("#"+b).attr('checked',true);
     });


      }
    });
   });
   
      $("#areatable").dataTable(
      {
          "order": [[ 0, "desc" ]],
      "columnDefs": [
      {
        "targets": [ 0],
        "visible": false,
      }],
      "pageLength": 10,



      });
    

  } );

</script>

@stop