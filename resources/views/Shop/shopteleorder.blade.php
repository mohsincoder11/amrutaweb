@extends('layout')
@section('content')

<div class="page-content-wrap">

  @include('Shop/shoplayout')
  <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">


      <div class="panel panel-default">


        <div class="row" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;">
          <div class="col-md-6">
            <h5 class="panel-title" style="color: #fff;float: right;margin-top: 4px;margin-right: 20px;"><i class="fa fa-phone"></i> Telecaller Orders</h5>
          </div>
          <div class="col-md-6">
            <form action="{{url('printmultitelepdf')}}" method="post" name="form">
              @csrf

              <input type="hidden" name="checkboxids" id="checkboxids">
              <input type="hidden" value="0" name="assignno" id="assignno">
              <select name="assignto" data-live-search="true" id="assignto" class="select">
                <option value="">Assign Delivery Boy</option>


              </select>
              <button style="background-color:#009900; border:2px solid #fff; max-height:30px; margin-top:5px; margin-bottom:5px; margin-right:15px;padding-top: 3px;" type="submit" class="btn btn-info printdel"><i class="fa fa-print" style="margin-left:5px;"></i>Print Delivery Boy Receipt</button>


            </form>

          </div>
        </div>
        <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
          <table class="table" id="shopteletable">
            <thead>

              <tr width="100%">
                <th style="display: none;"></th>

                <th width="4%">#</th>
                <th width="7%">Order No.</th>
                <th width="9%">Customer Name</th>
                <th width="6%">Mobile</th>
                <th width="10%">Address</th>
                <th width="10%">Item [ Weight-KG ]</th>
                <th width="10%">Order Specification</th>
                <th width="6%">MOP</th>
                <th width="6%">Time</th>
                <th width="6%">Total</th>
                <th width="6%">Status</th>
                <th style="min-width: 11%">Collection</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 0; ?>
              @foreach($shop as $s)
              <tr>
                <td style="display: none">{{$s['id']}}</td>

                <td>
                  <?php if ($s['assignto'] == 'null' && $s['paidstatus'] != -1) {
                  ?>

                    <input type="checkbox" class="checkbox" id="{{$s['id']}}">
                  <?php

                  }
                  ?>

                </td>
                <td>{{$s['orderno']}}</td>
                <td>{{$s['custname']}}</td>
                <td>{{$s['mobile']}}</td>
                <td>{{$s['address']}}</td>
                <td> @foreach($teleorderlist as $tl)
                  <?php
                  if ($s['orderid'] == $tl['orderid']) {
                  ?>
                    {{$tl['itemname']}} [<strong>{{$tl['weight']}}</strong>] <br>
                  <?php

                  } ?>


                  @endforeach
                </td>
                <td><strong>{{$s['details']}}</strong></td>
                <td>{{$s['mop']}}</td>
                <td>
                  <?php if ($s['timestatus'] == 1) {
                  ?>
                    <button class="btn btn-success">
                      {{$s['timetaken']}}
                    </button>
                  <?php
                  } else {
                  ?><button class="btn btn-warning btn-md">
                      {{$ordertime[$i]}}

                    </button>
                    <input type="hidden" value="{{$ordertime[$i]}}" id="time{{$s['id']}}">
                  <?php
                  }
                  ?>
                </td>
                <td><strong style="color:#FF0000">{{$s['amount']}}</strong></td>
                <td>
                  <strong style="color:#FF0000">
                    <?php
                    if ($s->assignto == 'null' && $s->paidstatus != -1) {
                      echo '<label style="color:#bec41b">Processing...<label>';
                    }
                    if ($s->paidstatus == 0 && $s->status == 1) {
                      echo '<label style="color:#4d4acf">Assigned to ' . $s->assignto . '<label>';
                    }
                    if ($s->paidstatus == 0 && $s->assignto != 'null' && $s->status == 2) {
                      echo '<label style="color:#4d4acf">Collected by ' . $s->assignto . '<label>';
                    }
                    if ($s->paidstatus == 1) {
                      echo
                      '<label style="color:#229e1b">Delivered by ' . $s->assignto . '<label>';
                    }
                    if ($s->paidstatus == -1) {
                      echo
                      '<label style="color:#fc0f0f">Order Cancelled<label>';
                    }
                    ?>
                  </strong>
                </td>
                <td>
                  <?php
                  if ($s['paidstatus'] == 1) {
                    echo '<label style="color:#229e1b;padding-right:5px;">' . $s['collectedcash'] . '</label>';
                  }
                  if ($s['paidstatus'] == -1) {
                    echo '<label style="color:#229e1b;padding-right:5px;">0</label>';
                  }
                  if ($s['paidstatus'] == 0) {
                  ?>
                    <form action="{{url('updatemoney')}}" method="post" name="form">
                      @csrf
                      <div class="row">
                        <div class="col-md-8">
                          <input type="number" placeholder="Amount" name="collectedcash" class="form-control" required="" min="0">
                          <input type="hidden" name="timetaken" value="{{$ordertime[$i]}}">
                        </div>
                        <div class="col-md-3" style="margin-left:0px;"> <button type="submit" style="background-color:#006699; color:#FFFFFF;margin-left:-5px;" class="btn btn-just-icon rupee"><i class="fa fa-rupee" data-toggle="tooltip" data-placement="top" title="Collect Amount"></i></button>
                        </div>
                        <div class="col-md-3" style="margin-left: -10px;"> <?php
                                                                          }

                                                                            ?>

                        </div>
                      </div>
                      <input type="hidden" name="routname" value="shopteleorder">

                      <input type="hidden" name="paidstatus" value="1">
                      <input type="hidden" name="id" value="{{$s['id']}}">
                    </form>


                </td>
                <td>
                  <a href="{{url('printtelepdf/'.$s['id'])}}" target="_blank" class="btn btn-primary btn-just-icon print"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Print"></i>
                  </a>
                  <?php
                  if ($s['paidstatus'] == 0) {
                  ?>

                    <button type="button" class="btn btn-danger btn-just-icon remove cancelbutton" id="{{$s['id']}}"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Cancel Order"></i>
                    </button>

                  <?php
                  } ?>
                </td>
              </tr>
              <?php $i++; ?>
              @endforeach



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
<div class="col-md-12 cancelmodel" id="cancelmodeldiv">
  <div class="col-md-offset-4 col-md-4 modalbody">

    <div class="modal-content">
      <div class="row">
        <h3 style="color: #000;text-align: center"> Reason For Cancel Order <span class="close closemodel" style="float: right">&times;</span></h3>


      </div>
      <form action="{{url('cancelorder')}}" method="post">
        @csrf
        <input type="hidden" id="canceltimetaken" name="canceltimetaken">
        <input type="hidden" name="routename" value="shopteleorder">

        <input type="hidden" id="cancelid" value="" name="cancelid">
        <div class="row" style="padding-top: 10px;padding-bottom: 10px;">
          <div class="form-group">
            <input type="text" class="form-control" name="reason" placeholder="Enter Cancel Reason" required autocomplete="off">
          </div>
        </div>
        <div class="row" style="padding-bottom: 10px;">
          <button type="submit" class="btn btn-danger col-md-12">Cancel Order</button>
        </div>
      </form>

    </div>

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
@stop

@section('js')
@include('Shop/count_script')

<script>
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $(document).ready(function() {

    $("#cancelmodeldiv").hide();
    $('#notification').hide();

    setTimeout(function() {
      window.location.reload(1);
    }, 180000);
    var deliverycount = 0;
    $('#assignto').on('change', function() {
      deliverycount = 1;
      $('#assignno').val(deliverycount);

    });
    $('#shopteletable').DataTable({
      "order": [
        [0, "desc"]
      ],
      "pageLength": 20,


    });
    var j = 0;
    var i = 0;
    var checkboxid = [];
    var k = 0;

    $('#shopteletable tbody').on('click', '.checkbox', function() {
      // Holds the product ID of the clicked element
      var id = $(this).attr('id');
      //alert(id);

      if ($.inArray(id, checkboxid) > -1) {
        checkboxid = jQuery.grep(checkboxid, function(value) {
          return value != id;
        });
      } else {

        checkboxid[j] = id;
        //alert(checkboxid);

      }

      j++;
    });
    $.ajax({
      type: "GET",
      dataType: "json",
      url: 'getalldeliveryboy',
      success: function(data) {

        $.each(data, function(a, b) {
          //alert(address);                  
          $("#assignto").append(
            '<option value="' + b.id + '  "data-subtext="' + b.mobile + '">' + b.name + '</option>'
          );
          //alert(data[j].fullname);
        });
        $("#assignto").selectpicker("refresh");



      }
    });

    $('#shopteletable tbody').on('click', '.cancelbutton', function() {
      var id = $(this).attr('id');
      var time = $('#time' + id).val();


      $('#canceltimetaken').val(time);
      $('#cancelid').val(id);
      $("#cancelmodeldiv").show({
        height: 'toggle'
      });
    });
    $(".closemodel").click(function() {
      $("#cancelmodeldiv").hide();
    });
    var modal = document.getElementById("cancelmodeldiv");
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }


    $(".printdel").click(function() {
      if ($('.checkbox').is(":checked")) {

        for (i = 0; i < checkboxid.length; ++i) {
          var checkboxread = $("#checkboxids").val();
          if (checkboxread.length == 0) {
            $("#checkboxids").val(checkboxid);

          } else {
            $("#checkboxids").val(checkboxid);

          }



        }
      } else {
        alert('Select at least 1 Checkbox');
      }
      if (deliverycount == 0) {
        alert('Select Delivery Boy');

      }
      if (deliverycount == 1) {
        //alert(checkboxread);
        window.setTimeout(function() {
          //        $.ajax({
          //     type:"GET",
          //     dataType: "json",
          //     url: '{{url('sendmsg')}}',
          //     success : function(data) {
          //      // alert(data);
          //       location.reload();
          //   }
          // });
          location.reload();
        }, 3000)


      } else {
        window.setTimeout(function() {
          location.reload()
        }, 1500)
      }
    });
    $("#loader").hide();

  });
</script>

@stop