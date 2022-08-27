@extends('layout')
@section('css')
<style>
  .switch-label:before {
    content: attr(data-off);
    right: 11px;
    color: #fff;
    font-size: 11px;
    text-shadow: 0 1px rgba(255, 255, 255, 0.5);
  }
  .switch-label:after {
    content: attr(data-on);
    left: 15px;
    font-size: 11px;
    color: #FFFFFF;
    text-shadow: 0 1px rgba(0, 0, 0, 0.2);
    opacity: 0;
  }
</style>
@stop
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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#ba7f1a; width:100%; font-size:14px;" align="center"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;Add Time Slot</h5>
        <?php  $successcode=Session::get('successcode')?>
        <input type="hidden" value="{{$successcode}}" id="successcode">



        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">



          <form name="form" id="form">
            {{ csrf_field() }}   
            <input type="hidden" name="inputmode" id="inputmode" value="insert">
            <input type="hidden" name="updateid" id="updateid">
            <input type="hidden" id="day2">
            <div class="col-md-12">              
              <div class="row">        
               <div class="col-md-offset-2 col-md-2" style="margin-top:15px;">
                 <label>Select Day<font color="#FF0000">*</font></label>
                 <select name="day" id="day" class="form-control select">
                   <?php $day=App\Time_slot::select('day')->get();  ?>
                    <option value="{{date('l')}}">{{date('l')}}</option>
                   @foreach($day as $day)
                   @if($day->day!=date('l'))
                   <option value="{{$day->day}}">{{$day->day}}</option>
                  @endif
                   @endforeach




                 </select>
                 <b><label for="" class="text-danger" id="daylabel"></label></b>

               </div> 
             </div>
             <div class="row">
               <div class="col-md-offset-2 col-md-9">
                <div class="form-group" style="padding-left: 10px;padding-top: 10px;">   

                  <label style="margin-left: 8px;margin-right: 8px;">Assign Time Slot<font color="#FF0000"> *</font></label>

                  <br>
 <?php $totalslot=DB::table('serve_time')->select('id','start_time')->get();  ?>
                   @foreach($totalslot as $ts)

                  <div class="col-md-3">
                    <div class="form-check"> 

                      <input type="checkbox" class="form-check-input icheckboxs "  id="{{$ts->id}}" value="{{$ts->id}}" />
                      &nbsp;&nbsp;
                      <label class="form-check-label" for="{{$ts->id}}"  style="margin-top:5px; " >{{$ts->start_time}}</label>
                    </div>
                  </div>
                  @endforeach

                </div> 

              </div>

            </div>
            <div class="row">
              <div class="col-md-offset-2 col-md-2">
                <b>  <label for="" id="timearray" class="text-danger" ></label>

                </b>
              </div>
            </div>
            <div class="row" style="padding-top: 1%;">
             <div class="col-md-offset-5 col-md-2">

              <div class="form-group" > 

               <button type="submit" class="btn btn-primary col-md-12" id="addbutton"><span class="fa fa-plus"></span> <span id="inputlabel">  Add Time</span></button>
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



        <div class="col-md-1" style="margin-top:15px;"></div>

        <div class="col-md-10" style="margin-top:15px;">
          <h5 class="panel-title" style="color:#FFFFFF; background-color:#ba7f1a; width:100%; font-size:14px;" align="center"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;Added Time Slot</h5>

          <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
            <table class="table table-responsive " id="areatable" style="table-layout: fixed; width: 100%">
              <thead>
                <tr width="100%">
                  <th >id</th>
                  <th width="15%">Day</th>
                  <th width="65%">Time Slot</th>
                  <th width="13%">Status</th>
                  <th width="7%">Action</th>
                </tr>
              </thead>
              <tbody >
                @php $days=App\Time_slot::select('id','day','status')->orderby('id','asc')->get();
                @endphp
                @foreach($days as $day)
                <tr>
                  <td > {{$day->id}}</td>
                   <td>{{$day->day}}</td>
                  <td >
                    @php $time=DB::table('assign_times')->leftjoin('serve_time','serve_time.id','assign_times.time')->select('serve_time.start_time')->where('assign_times.day',$day->day)->orderby('serve_time.id','asc')->get();
                    @endphp
                    @foreach($time as $t)
                    <button style="padding-top: 5px;margin-bottom:  4px;" class="btn btn-success btn-sm timeslotlable">{{$t->start_time}}</button>
                    @endforeach
                  </td>
                  <td>

                    @if($day->status==0)
                    <label class="switchss">  <input class="switch-input closeday" type="checkbox" id="{{$day->id}}" value="1"/>  <span class="switch-label" data-on="Open" data-off="Closed" ></span>   <span class="switch-handle"></span> </label>  
                    @else
                    <label class="switchss"><input class="switch-input closeday" type="checkbox"  checked="" id="{{$day->id}}" value="0" />  <span class="switch-label" data-on="Open" data-off="Closed"></span>  <span class="switch-handle"></span> </label>
                    @endif                 
                  </td>
                  <td>
                    <button class="btn btn-warning editrecord" data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" id="{{$day->day}}"><i class="fa fa-edit"></i></button>
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
    $('#addbutton').on('click',function(e)
    {
     e.preventDefault();

     var idarray =[]; 
     $('.icheckboxs:checkbox:checked').each(function(){
      idarray.push($(this).val());

    });

     if(idarray.length==0)
     {
      $("#timearray").text('Please select atleast one slot');   
      return;
    }
    
    var day;
    if($("#day").val()==null)
    {
      day=$("#day2").val();
    }
    else
    {
      day=$("#day").val();
    }
    
    if($("#inputmode").val()=='insert' && $("#day").val()==null && $("#day2").val()=='')
    {
      //alert(1);
      $("#daylabel").text('All days are assingned. Chosse edit option.');
      return;
    }
    
    $('#addbutton').addClass('disabled');

    $.ajax({    
      type: "get",
      url: "{{Route('add_time_slot')}}",
      data: {_token: CSRF_TOKEN,updateid:$("#updateid").val(),time_assign:idarray.toString(),day:day}, 
      dataType:'json',
      success:function(data) {
        console.log(data);
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



    $('#areatable tbody').on('click', '.closeday', function () {

      $.ajax({
        type: "get",
        url: "{{url('day_status')}}",
        data: {_token: CSRF_TOKEN,id:$(this).attr('id'),status:$(this).attr('value')}, 
        dataType:'json',
        success:function(data) {
          setTimeout(function(){location.reload(); }, 1000);

        }
      });
    });
    
    

    $('.delete').on('click', function () {
  // Holds the product ID of the clicked element
  var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{Route('delete_time_slot')}}",
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

      

    $('.editrecord').on('click',  function () {
     var day = $(this).attr('id');
     $.ajax({
      type: "get",
      url: "{{url('edit_time_slot')}}",
      data: {_token: CSRF_TOKEN,day:day}, 
      dataType:'json',
      success:function(data) {
        $.each(data, function (a, b) { 
         $("#"+b.time).attr('checked',true);
       });
        $("#day").val(day);
        $("#day2").val(day);
        $("#day").selectpicker('refresh');
        $("#updateid").val(data.id);
        $("#inputlabel").text('Update Time');

      }
    });
   });
    createtable();
    function createtable()
    {
      $("#areatable").dataTable(
      {
        "info": true,
        "autoWidth": false,
        "pageLength": 10,

        
        "order": [[ 0, "asc" ]],
        "columnDefs": [
        {
          "targets": [ 0],
          "visible": false,
        }],
        responsive: true,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }

      });
    }
    $("#loader").hide();
  } );

</script>

@stop