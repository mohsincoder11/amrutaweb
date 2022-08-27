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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#3b1540; width:100%; font-size:14px;" align="center"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;Add Area</h5>
        <?php  $successcode=Session::get('successcode')?>
        <input type="hidden" value="{{$successcode}}" id="successcode">



        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">



          <form method="POST" action="{{url('insert_area')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
            {{ csrf_field() }}   
            <input type="hidden" name="inputmode" id="inputmode" value="insert">
            <input type="hidden" name="updateid" id="updateid">

            <div class="col-md-12">              

              <div class="row">        
                      <div class="col-md-offset-2 col-md-6" style="margin-top:15px;">

                 <div class="form-group" >   


                 <label>Area Name<font color="#FF0000">*</font></label>
                 <input type="text" placeholder="Enter Area" class="form-control" id="area" name="area" autofocus required/>
               </div>            

             </div>
              <div class="col-md-2" style="padding-left: 3%;padding-top: 36px;">
                                            
                                            <div class="form-group" > 
                                             
                                               <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> <span id="inputlabel">  Add Area</span></button>
                                           </div>
                                       </div> 
              </div>
              
           </div>



         </form> 

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
              <h5 class="panel-title" style="color:#FFFFFF; background-color:#3b1540; width:100%; font-size:14px;" align="center"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;Added Area</h5>

              <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                <table class="table" id="areatable">
                  <thead>
                    <tr>
                      <th >id</th>
                      <th width="80%">Area Name</th>

                      <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody id="arearow">

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
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $(document).ready( function () {
    if($("#successcode").val()=='1')
    {
      var x = document.getElementById("snackbarsuccess");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
    if($("#successcode").val()=='2')
    {
      var x = document.getElementById("snackbarupdate");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
    $('#areatable').DataTable({
      "order": [[ 0, "desc" ]]

    });
    

    $('#areatable tbody').on('click', '.delete', function () {
  // Holds the product ID of the clicked element
  var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{Route('delete_area')}}",
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

    showitem();
    function showitem()
    {
      $.ajax({
        type: "get",
        url: "{{url('get_all_area')}}",
        dataType:'json',
        success:function(data) {
        //console.log(data);
        $('#areatable').DataTable().clear().destroy();
        $.each(data, function (a, b) { 
          $("#arearow").append(
            '<tr><td>'+b.id+'</td><td>'+b.area+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
            );
                                      //alert(data[j].fullname);
                                    });
        createtable();
        $("#loader").hide();


      }
    });                       


    }

    $('#areatable tbody').on('click', '.editrecord', function () {
     var id = $(this).attr('id');
     $.ajax({
      type: "get",
      url: "{{url('get_single_area')}}",
      data: {_token: CSRF_TOKEN,id:id}, 
      dataType:'json',
      success:function(data) {
        console.log(data);
        $("#area").val(data.area);

        $("#updateid").val(data.id);
        $("#inputlabel").text('Update Area');

      }
    });
   });
    function createtable()
    {
      $("#areatable").dataTable(
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