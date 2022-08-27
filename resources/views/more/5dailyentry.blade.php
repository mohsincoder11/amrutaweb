@extends('layout')
@section('content')
<?php  $successcode=Session::get('successcode')?>
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

            <h5 class="panel-title" style="color:#FFFFFF; background-color:#2fa890; width:100%; font-size:14px;" align="center"><i class="fa fa-home"></i> &nbsp;Daily Entry for Shop</h5>

            <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
                <div class="form-group"> 



                    <form role="form" method="post" action="{{url('insertdailyentry')}}">
                        @csrf
                        <input type="hidden" name="inputmode" id="inputmode" value="insert">
                        <input type="hidden" name="updateid" id="updateid">
                        <input type="hidden" name="shop_id" id="shop_id"> 
                        <input type="hidden" name="user_id" id="user_id" > 

                        <div class="col-md-12">
                            <div class="form-group" style="margin-top:-10px;">   

                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Date<font color="#FF0000"></font></label>
                                    <input type="date" name="date" id="date" value="{{date('Y-m-d')}}" placeholder="" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Time<font color="#FF0000"></font></label>
                                    <input type="time" name="time" id="time" placeholder="" class="form-control" required/>
                                </div>

                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Opening Birds<font color="#FF0000"></font></label>
                                    <input type="text" name="openingbirds" id="openingbirds" placeholder="Opening Birds" class="form-control" readonly="" required/>
                                </div>      
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Sale Birds<font color="#FF0000"></font></label>
                                    <input type="number" name="salegbird" id="salegbird" placeholder="Sale Birds" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Sale Wt.(Meat)<font color="#FF0000"></font></label>
                                    <input type="text" name="salegwt" id="salegwt" placeholder="Sale Weight" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Bill Qty. Wt.<font color="#FF0000"></font></label>
                                    <input type="text" name="billqtywt" id="billqtywt" placeholder="Bill Qty" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Mortality<font color="#FF0000"></font></label>
                                    <input type="text" name="mortality" id="mortality" placeholder="Mortality" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Wt.<font color="#FF0000"></font></label>
                                    <input type="text" name="wt" id="wt" placeholder="Weight" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Closing Birds<font color="#FF0000"></font></label>
                                    <input type="text" name="closingbird" id="closingbird" placeholder="Closing Birds" class="form-control" readonly="" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Total Sale Amt.<font color="#FF0000"></font></label>
                                    <input type="text" name="tsaleamt" id="tsaleamt" placeholder="Total Sale Amount" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Dis. Amount<font color="#FF0000"></font></label>
                                    <input type="text" name="disamt" id="disamt" placeholder="Dscount Amount" class="form-control" required/>
                                </div>
                                <div class="col-md-2" style="margin-top:15px;">
                                    <label>Salable Chicken<font color="#FF0000"></font></label>
                                    <input type="text" name="salablechick" id="salablechick" placeholder="Salable Chicken" class="form-control" required/>
                                </div>
                            </div> 
                            <div class="row">
                               <div class="col-md-12" style="margin-top:15px;" >
                                <button type="submit"  class="btn btn-info "><span class="fa fa-plus"> </span> Add</button>
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
                <table class="table" id="dailyentrytable">
                    <thead>
                        <tr>
                            <th >id</th>
                            <th width="5%">Date</th>
                            <th width="7%">Shop Name</th>
                            <th width="6%">Time</th>
                            <th width="7%">Opening Birds</th>
                            <th width="7%">Sale Birds</th>
                            <th width="7%">Sale Wt.(Meat)</th>
                            <th width="5%">Bill</th>
                            <th width="5%">Mortality</th>
                            <th width="5%">Wt.</th>
                            <th width="7%">Closing Birds</th>
                            <th width="7%">Total sale Amt.</th>
                            <th width="5%">Amount</th>
                            <th width="7%">Salable Chicken</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dailyentryrow">

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
<div class="loaderpage" id="loader">
   <div class="loader">
      <img src="{{asset('public/logo/cloader3.gif')}}" alt="">
  </div>
  <p class="loaderp">
    Loading........
</p>
</div>
<div class="col-md-12 cancelmodel" id="select_shop">
  <div class="col-md-offset-4 col-md-4 modalbody" >

    <div class="modal-content">
      <div class="row" style=""> 
        <h3 style="color: #000;text-align: center"> Select Shop <span class="close closemodel" style="float: right">&times;</span></h3>


    </div>
    <div class="form-group">
       <select name="" id="shopmodel_select" class="form-control select">
        <option value="" >Select shop</option>
        @foreach($shops as $g)
        <option value="{{$g->id}}" opening_birds="{{$g->opening_birds}}">{{$g->shopname}}

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

       $("#shopmodel_select").on('change',function()
       {
          var opening_birds=$("#shopmodel_select option:selected").attr('opening_birds');
          $("#shop_id").val($("#shopmodel_select").val());
          $("#openingbirds").val(opening_birds);

      })
       $.ajax({
          type: "get",
          url: "{{Route('get_shop_opening_birds')}}",
          data: {_token: CSRF_TOKEN}, 
          dataType:'json',
          success:function(data) {
            console.log(data);
            $("#user_id").val(data['user_id']);
            if(data['response']==1)
            {
              $("#select_shop").show({
                height: 'toggle'
            });

          }   
          else
          {
             $("#shop_id").val(data['id']);
             $("#openingbirds").val(data['opening_birds']);
             $("#user_id").val(data['userid']);

         }  
     }
 });
       $(".closemodel").click(function(){
          $("#select_shop").hide();
      });
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
    showdailyentry();
    function showdailyentry()
    {
        $.ajax({
            type: "get",
            url: "{{Route('getdailyentry')}}",
            dataType:'json',
            success:function(data) {
                           // console.log(data);
                           $('#dailyentrytable').DataTable().clear().destroy();
                           $.each(data, function (a, b) { 
                            var shopname;
                            if(b.shopname==null)
                            {
                                shopname='Admin'
                            }
                            else
                            {
                             shopname=b.shopname; 
                         }
                         $("#dailyentryrow").append(
                            '<tr><td>'+b.id+'</td><td>'+b.date+'</td><td>'+shopname+'</td><td>'+b.time+'</td><td>'+b.openingbirds+'</td><td>'+b.salegbird+'</td><td>'+b.salegwt+'</td><td>100</td><td>'+b.mortality+'</td><td>'+b.wt+'</td><td>'+b.closingbird+'</td><td>'+b.tsaleamt+'</td><td>'+b.disamt+'</td><td>'+b.salablechick+'</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id='+b.id+' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id='+b.id+' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
                            );
                                      //alert(data[j].fullname);
                                  });
                           createtable();


                       }
                   });                       


    }
    $('#dailyentrytable tbody').on('click', '.delete', function () {
       var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('deletedailyentry')}}",
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
    $('#dailyentrytable tbody').on('click', '.editrecord', function () {
        var id = $(this).attr('id');
  //alert(id);
  $.ajax({
    type: "get",
    url: "{{Route('editdailyentry')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
        //console.log(data);
        $("#inputmode").val('update');
        $("#updateid").val(data.id);
        $("#date").val(data.date);
        $("#time").val(data.time);
        $("#openingbirds").val(data.openingbirds);
        $("#salegbird").val(data.salegbird);
        $("#salegwt").val(data.salegwt);
        $("#billqtywt").val(data.billqtywt);
        $("#mortality").val(data.mortality);
        $("#wt").val(data.wt);
        $("#closingbird").val(data.closingbird);
        $("#disamt").val(data.disamt);
        $("#salablechick").val(data.salablechick);
        $("#tsaleamt").val(data.tsaleamt);

    }
});
});
    function createtable()
    {
        $("#dailyentrytable").dataTable(
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

    $("#salegbird").keyup(function(){  
          var openingbirds = $("#openingbirds").val();
          var salegbird = $("#salegbird").val();        
          var mortality = $("#mortality").val();        
          var closingbird=openingbirds-salegbird-mortality;
          $("#closingbird").val(closingbird); 
       });   

       $("#mortality").keyup(function(){  
          var openingbirds = $("#openingbirds").val();
          var salegbird = $("#salegbird").val();        
          var mortality = $("#mortality").val();        
          var closingbird=openingbirds-salegbird-mortality;
          $("#closingbird").val(closingbird); 
       });                     

});
</script>
@stop