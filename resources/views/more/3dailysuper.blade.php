@extends('layout')
@section('content')      

@php $successcode=Session::get('successcode');

@endphp






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

      <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i> &nbsp;Daily Supervision</h5>

      <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
        <div class="form-group"> 



         <form role="form" method="post" action="{{url('insertdailysuper')}}">
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
                <input type="text" name="openingbirds" id="openingbirds" placeholder="Opening Birds"  class="form-control" readonly="" required/>
              </div>                       

              <div class="col-md-2" style="margin-top:15px;">
                <label>Feed Consumption (In kgs)<font color="#FF0000"></font></label>
                <input type="text" name="feedconsumption" id="feedconsumption" placeholder="Feed Consumption" class="form-control" required/>
              </div>
             
              <div class="col-md-1" style="margin-top:15px;">
                <label>Mortality<font color="#FF0000"></font></label>
                <input type="text" name="mortality" id="mortality" placeholder="Mortality" class="form-control" required/>
              </div> 
              <div class="col-md-1" style="margin-top:15px;">
                <label>Avg. Bird Wt.<font color="#FF0000"></font></label>
                <input type="text" name="avgbirdwt" id="avgbirdwt" placeholder="Avg Bird wt" class="form-control" required/>
              </div>
              <div class="col-md-2" style="margin-top:15px;">
                <label>Closing Birds<font color="#FF0000"></font></label>
                <input type="text" name="closingbird" id="closingbird" placeholder="Closing Bird" class="form-control" readonly="" required/>
              </div>                                     

            </div> 
            <div class="row">
             <div class="col-md-2" style="margin-top:15px;">
              <button  type="submit" class="btn btn-info  "><i class="fa fa-plus"></i>Add</button>
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
        <table class="table " id="dailysupertable">
          <thead>
            <tr>
              <th>id</th>
              <th width="10%">Date</th>
              <th  width="10%">Time</th>
              <th  width="10%"> Opening Birds</th>
              <th  width="10%">Feed Consumption</th>
              <th  width="10%">Average Bird Wt.</th>
              <th  width="10%">Mortality</th>
              <th  width="10%">Closing Birds</th>
              <th  width="10%">Action</th>
            </tr>
          </thead>
          <tbody id="dailysuperrow">

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

<!-- END PAGE CONTAINER -->
<!-- MESSAGE BOX-->
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
         <option value="{{$g->id}}" opening_birds="{{$g->opening_birds}}" >{{$g->godawnname}}

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
     $("#select_godawn").hide();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
    showdailysuper();
    function showdailysuper()
    {
      $.ajax({
        type: "get",
        url: "{{Route('getdailysuper')}}",
        dataType:'json',
        success:function(data) {
                            //console.log(data);
                            $('#dailysupertable').DataTable().clear().destroy();
                            $.each(data, function (a, b) { 
                              $("#dailysuperrow").append(
                                '<tr><td>'+b.id+'</td><td>'+b.date+'</td><td>'+b.time+'</td><td>'+b.openingbirds+'</td><td>'+b.feedconsumption+'</td><td>'+b.avgbirdwt+'</td><td>'+b.mortality+'</td><td>'+b.closingbird+'</td><td><button class="btn btn-primary btn-sm rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-sm rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
                                );
                                      //alert(data[j].fullname);
                                    });
                            createtable();


                          }
                        });                       


    }

    $("#godawnmodel_select").on('change',function()
    {
      var opening_birds=$("#godawnmodel_select option:selected").attr('opening_birds');
      $("#godawn_id").val($("#godawnmodel_select").val());
      $("#openingbirds").val(opening_birds);
                                          
    })


    $('#dailysupertable tbody').on('click', '.delete', function () {
     var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('deletedailysuper')}}",
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
    $('#dailysupertable tbody').on('click', '.editrecord', function () {
      var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('editdailysuper')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
       // console.log(data);
       $("#inputmode").val('update');
       $("#updateid").val(data.id);
       $("#date").val(data.date);
       $("#time").val(data.time);
       $("#openingbirds").val(data.openingbirds);
       $("#feedconsumption").val(data.feedconsumption);
       $("#avgbirdwt").val(data.avgbirdwt);
       $("#mortality").val(data.mortality);
       $("#closingbird").val(data.closingbird);

     }
   });
});
    function createtable()
    {
      $("#dailysupertable").dataTable(
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

    $("#mortality").keyup(function(){ 
     var openingbirds = $("#openingbirds").val();
     var mortality = $("#mortality").val();
     var total=Math.round(openingbirds-parseInt(mortality));
     $("#closingbird").val(total);                              

   });                 

  });
</script>
@stop