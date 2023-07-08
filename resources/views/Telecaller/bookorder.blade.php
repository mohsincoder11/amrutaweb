@extends('layout')
@section('content')

<div class="page-content-wrap">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="col-md-12" align="center" style="margin-top:-12px;">
              <h5 style="color:#000; background-color:#FFCC00; width:15%; min-height:25px; padding-top:5px;" align="center"><span class="fa fa-user"></span> <strong>Telecaller Dashboard</strong></h5>
            </div>


            <div class="col-md-12" style="margin-bottom:-5px;" align="center">
              <a href="{{route('bookorder')}}"><button type="button" class="btn btn-danger active"><i class="fa fa-list"></i>Book Orders</button></a> &nbsp;
              <a href="{{route('teleorder')}}"> <button type="button" class="btn active" style="background-color:#006699; color:#FFFFFF"><i class="fa fa-phone"></i>Telecaller Orders</button></a>
              &nbsp;
              <a href="{{route('tele_app_orders')}}" style="padding-right: 5px"><button type="button" class="btn active" style="background-color:#521a43; color:#FFFFFF"><i class="fa fa-mobile" aria-hidden="true"></i>App Orders</button></a>


            </div>



          </div>
        </div>
      </div>



    </div>
  </div>



  <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">
      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-list"></i> &nbsp;Book Orders</h5>
        <div class="row">
          <?php $successcode = Session::get('successcode');
          ?>
          <input type="hidden" value="{{$successcode}}" id="successcode">
          <div class="col-sm-8"></div>
          <div id="snackbarsuccess">
            <div class="row">
              <div class="col-md-12"><label for=""><strong>Success!</strong> Order Placed Successfully.</label></div>

            </div>

          </div>

        </div>
        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">

          <div class="form-group">
            <form name="form" id="form">
              @csrf
              <input type="hidden" name="orderid" id="orderid">
              <div class="col-md-12">
                <div class="row">
                  <div class="form-group" style="margin-top:-10px;">

                    <div class="col-md-6">
                      <div class="col-md-12" style="margin-bottom:12px; margin-top:25px; float:left; ">
                        <table width="100%" border="1" id="ordertable">
                          <tr style="background-color:#f0f0f0; font-size:12px; height:30px;">
                            <th width="50%" style="text-align:center">Select Item</th>
                            <th width="20%" style="text-align:center">Weight (KG)</th>
                            <th width="22%" style="text-align:center">Rate</th>
                            <th width="8%" style="text-align:center">More</th>
                          </tr>
                          <tr>
                            <td style="padding:5px;">
                              <select class="form-control select itemnamec" name="itemname" id="itemname" data-live-search="true">
                                @foreach($item as $i)
                                <option value="{{$i['id']}}" <?php if ($i['stock'] == 0) echo 'disabled'; ?>>{{$i['itemname']}}
                                </option>

                                @endforeach

                              </select>
                              <input type="hidden" name="itemname2" id="itemname2">
                            </td>
                            <td style="padding:5px;">
                              <input style="background-color:#FFFFFF" type="number" placeholder="Enter Weight" class="form-control" name="weight" id="weight" required min="0.1" />
                            </td>
                            <td style="padding:5px;">
                              <input style="background-color:#FFFFFF;color:#555" type="number" placeholder="Enter Amount" name="rate" id="amount" class="form-control" readonly="" required />
                              <input type="hidden" name="actualamount" id="actualamount" />
                            </td>
                            <td style="text-align:center"><button type="button" class="addorderrow"><i class="glyphicon glyphicon-plus"></i></button></td>
                          </tr>

                        </table>

                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table style="border: 1px solid black;width: 100%;">
                            <tr>
                              <th style="width: 100%;padding-left: 10px;height: 30px;">Added Item</th>

                            </tr>

                          </table>
                          <table class="addrow" style="border: 1px solid black;width: 100%;">


                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row" align="left" style="margin-top:25px;margin-left: -12px">
                        <div class="col-md-3">
                          <div class="row">
                            <div class="col-md-3">
                              <input type="radio" class="radio" name="customertype" id="retailcheckbox" value="retail" checked="">
                            </div>
                            <div class="col-md-9"><label for="">Order For Retail</label>
                            </div>
                          </div>

                        </div>
                        <div class="col-md-3">
                          <div class="row">

                            <div class="col-md-3">

                              <input type="radio" class="radio" name="customertype" value="hotel" id="hotelcheckbox">
                            </div>
                            <div class="col-md-9">

                              <label for="">Order For Hotel</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4" align="left" style="margin-top:15px;">

                          <label>Order Date</label>
                          <div class="input-group">
                            <div class="input-group date" data-provide="datepicker">
                              <input type="text" class="form-control" value="{{date('d/m/Y')}}" name="orderdate" id="orderdate">
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Order No.<font color="#FF0000">*</font></label>
                          <input type="text" class="form-control" name="orderno" id="orderno" value="{{$randno}}" readonly="" style="color: #000;font-size: 14px;">
                        </div>
                        <input type="hidden" id="custpresent" name="custpresent">
                        <div class="col-md-4" style="margin-top:15px;">
                          <label style="float:left">Select Customer<font color="#FF0000">*</font></label>
                          <select class="form-control" data-live-search="true" name="custselect" id="custselect" data-show-subtext="true">
                            <option>Select Customer</option>
                          </select>


                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Customer Name<font color="#FF0000">*</font></label>
                          <input type="text" placeholder="Customer Name" class="form-control" id="fullname" name="fullname" required />
                          <label for="" class="text-danger"> <span id="fullnameerror"></span></label>
                        </div>
                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Mobile<font color="#FF0000">*</font></label>
                          <input type="number" placeholder="Mobile" class="form-control" id="mobile" name="mobile" required="">
                          <label for="" id="mobilepresent" style="color: red"></label>
                          <label for="" class="text-danger"> <span id="mobileerror"></span></label>
                        </div>
                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Alternate Mobile</label>
                          <input type="number" placeholder="Mobile" class="form-control" id="altmobile" name="altmobile" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <label>Address<font color="#FF0000">*</font></label>
                          <input type="text" name="address" id="address" placeholder="Address" class="form-control" required />
                          <label for="" class="text-danger"> <span id="addresserror"></span></label>
                        </div>
                        <div class="col-md-4">
                          <label>Order Specification<font color="#FF0000">*</font></label>
                          <input type="text" placeholder="Order Details" value="NA" name="details" id="details" class="form-control" required />
                        </div>

                        <div class="col-md-4">
                          <label>Select Shop<font color="#FF0000">*</font></label>
                          <select class="form-control select" name="shopname" id="shopname" data-live-search="true">
                            @foreach($shop as $i)
                            <option value="{{$i['id']}}">{{$i['shopname']}}</option>
                            @endforeach
                          </select>
                        </div>

                      </div>
                      <div class="row">

                        <div class="col-md-4" style="margin-top:15px;">
                          <label>MOP<font color="#FF0000">*</font></label>
                          <select class="form-control select" name="mop" id="mop">
                            <option value="CASH">Cash</option>
                            <option value="ONLINE">Online</option>
                          </select>
                        </div>

                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Delivery Charges<font color="#FF0000">*</font></label>
                          <input type="number" placeholder="Delivery Charges" class="form-control" id="delivery_charge" value="10" name="delivery_charge" style="font-size: 18px;color:#555" readonly="" autocomplete="off" />
                        </div>

                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Total Amount<font color="#FF0000">*</font></label>
                          <input type="number" placeholder="Total Amount" class="form-control" id="totalamount" value="0" name="totalamount" style="font-size: 18px;color:#555" readonly="" autocomplete="off" />
                        </div>

                        <div class="col-md-4" style="margin-top:25px;" align="left">
                          <button type="button" style="background-color:#00cc00; border:none; min-width:150px; max-height:35px; margin-top:12px;" class="btn btn-info bookorderbutton" data-toggle="tooltip" data-placement="top" title="Make Sure For Correct Information" form="#form"><i class="fa fa-thumbs-up" style="margin-left:5px;"></i>Book Order</button>
                        </div>

                      </div>

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

  $(document).ready(function() {
    var Successcode = $('#successcode').val();
    customertype = 'retail';
    if (Successcode == 'success') {
      var x = document.getElementById("snackbarsuccess");
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    }

    var getallcustomer = getallcustomer();

    function getallcustomer() {
      $.ajax({
        type: "GET",
        dataType: "json",
        url: 'getallcustomer',
        success: function(data) {
          //alert(data);

          $.each(data, function(a, b) {
            var mobile = (b.mobile).substr(0, 10);
            //alert(address);                  
            $("#custselect").append(
              '<option value="' + b.id + '  "data-subtext="' + mobile + '">' + b.fullname + '</option>'
            );
            //alert(data[j].fullname);
          });
          $("#custselect").selectpicker("refresh");



        }
      });
    }


    $(".radio").click(function() {
      customertype = $(this).attr('id');
      $.ajax({
        type: "GET",
        data: {
          orderid: $("#orderid").val()
        },
        dataType: "json",
        url: 'deleteallteleorderrow',
        success: function(data) {
          $("#totalamount").val(0);
        }
      });

      var id = $("#itemname").val();

      $.ajax({
        type: "GET",
        dataType: "json",
        url: 'getamount/' + id,
        success: function(data) {
          if (customertype == 'hotelcheckbox') {
            $("#amount").val(data.hotelrate);
            $("#actualamount").val(data.hotelrate);
            $("#retailcheckbox").val('hotel');

            $('.addrow').empty();



          }
          if (customertype == 'retailcheckbox') {
            $("#amount").val(data.retailrate);
            $("#actualamount").val(data.retailrate);
            $('.addrow').empty();
            $("#retailcheckbox").val('retail');



          }
          $("#weight").val('1.000');

        }
      });

      if (customertype == "hotelcheckbox") {
        $.ajax({
          type: "GET",
          dataType: "json",
          url: 'getallhotel',
          success: function(data) {

            $("#custselect").empty();
            $("#custselect").append(
              '<option readonly>Select Customer</option>'
            );
            $.each(data, function(a, b) {
              var mobile = (b.mobile).substr(0, 10);
              //alert(address);
              $("#custselect").append(
                '<option value="' + b.id + '  "data-subtext="' + mobile + '">' + b.fullname + '</option>'
              );
              //alert(data[j].fullname);
            });
            $("#custselect").selectpicker("refresh");
            $("#retailcheckbox").val('hotel');



          }
        });
      }
      if (customertype == "retailcheckbox") {
        $.ajax({
          type: "GET",
          dataType: "json",
          url: 'getallcustomer',
          success: function(data) {

            $("#custselect").empty();
            $("#custselect").append(
              '<option readonly>Select Customer</option>'
            );
            $.each(data, function(a, b) {
              var mobile = (b.mobile).substr(0, 10);
              //alert(address);
              $("#custselect").append(
                '<option value="' + b.id + '  "data-subtext="' + mobile + '">' + b.fullname + '</option>'
              );
              //alert(data[j].fullname);
            });
            $("#custselect").selectpicker("refresh");
            $("#retailcheckbox").val('retail');



          }
        });
      }


    });





    getitemdetail();

    function getitemdetail() {
      var id = $("#itemname").val();
      $.ajax({
        type: "GET",
        dataType: "json",

        url: 'getamount/' + id,
        success: function(data) {
          $("#weight").val('1.000');
          if ($("#retailcheckbox").val() == 'retail') {
            $("#amount").val(data.retailrate);

            $("#actualamount").val(data.retailrate);

          }
          if ($("#retailcheckbox").val() == 'hotel') {
            $("#amount").val(data.hotelrate);

            $("#actualamount").val(data.hotelrate);

          }

          // $("#totalamount").val(data.rate);
          $("#itemname2").val(data.itemname);

        }
      });
    }




    $("#weight").keyup(function() {
      var weight = $("#weight").val();
      var actualamount = $("#actualamount").val();
      var amount = $("#amount").val();
      var total = Math.round(weight * actualamount);
      $("#amount").val(total);

    });

    $("#fullname").keyup(function() {
      $("#custpresent").val(0);
      $("#mobile").val('');
      $("#altmobile").val('');
      $("#address").val('');
      var fullname = ($("#fullname").val()).length;
      if (fullname > 0) {
        $("#fullnameerror").text('');
      } else {
        $("#fullnameerror").text('Please fill valid name');

      }

    });
    $("#mobile").keyup(function() {
      var mobile = ($("#mobile").val()).length;
      if (mobile == 10) {
        $("#mobileerror").text('');
      } else {
        $("#mobileerror").text('Please fill Valid Number');
      }

    });
    $("#address").keyup(function() {
      var address = ($("#address").val()).length;
      if (address > 1) {
        $("#addresserror").text('');
      } else {
        $("#addresserror").text('Please fill Valid address');
      }

    });


    $('.itemnamec').on('change', function() {
      getitemdetail();

    });

    $('#custselect').on('change', function() {
      var id = $("#custselect").val();
      //alert(id);
      $.ajax({
        type: "GET",
        dataType: "json",
        url: 'getcustomer/' + id,
        success: function(data) {
          if (data != null) {
            $("#address").val(data.address);
            $("#mobile").val(data.mobile);
            $("#altmobile").val(data.altmobile);
            $("#fullname").val(data.fullname);
            $("#custpresent").val(1);

          } else {
            alert('customer not present');

          }


        }

      });

    });


    $("#mobile").keyup(function() {
      var mobile = $("#mobile").val();
      if (mobile.length == 10) {
        $.ajax({
          type: "GET",
          dataType: "json",
          data: {
            _token: CSRF_TOKEN,
            mobile: mobile
          },

          url: 'checkmobileno/',
          success: function(data) {
            //alert(data);
            if (data != null) {
              $('#mobilepresent').text('Mobile No Already Present');
              $("#address").val(data.address);
              $("#mobile").val(data.mobile);
              $("#altmobile").val(data.altmobile);
              $("#fullname").val(data.fullname);
              $("#custpresent").val(1);
            } else {
              $('#mobilepresent').text('');

            }
          }
        });
      }
    });

    $(".addorderrow").click(function() {
      var itemname = $("#itemname2").val();
      var weight = $("#weight").val();
      var rate = $("#amount").val();
      var orderid = $("#orderid").val();
      var totalamountafteradd = 0;
      $.ajax({
        type: "get",
        url: "{{Route('addteleorderrow')}}",
        data: {
          _token: CSRF_TOKEN,
          orderid: orderid,
          itemname: itemname,
          weight: weight,
          rate: rate
        },
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $('.addrow').empty();

          $.each(data, function(a, b) {

            $('.addrow').append('<tr style="width:100%;height:40px;margin-top:5%;border:1px solid black;"><td style="width:70%;padding-left:5px;">' + b.itemname + '</td><td style="width:20%;">' + b.weight + '</td><td style="width:20%;">' + b.rate + '</td><td style="width:10%;"> <a class="btn btn-danger btn-just-icon deleterow" id="' + b.id + '" style="margin-right:5px"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" ></i></a>  </td></tr>');
            $("#orderid").val(b.orderid);
            totalamountafteradd = totalamountafteradd + parseInt(b.rate);
            $("#totalamount").val(totalamountafteradd);
          });
          $("#totalamount").val(totalamountafteradd + parseInt($("#delivery_charge").val()));
          getitemdetail();
        }
      });
    });


    $(".addrow").on('click', '.deleterow', function() {
      var deleteid = $(this).attr('id');
      var deleteid = $(this).attr('id');
      totalamountafterdelete = 0;
      $.ajax({
        type: "get",
        url: "{{Route('deleteteleorderrow')}}",
        data: {
          _token: CSRF_TOKEN,
          id: deleteid,
          orderid: $("#orderid").val()
        },
        dataType: 'json',
        success: function(data) {
          $('.addrow').empty();

          $.each(data, function(a, b) {

            $('.addrow').append('<tr style="width:100%;height:40px;margin-top:5%;border:1px solid black;"><td style="width:70%;padding-left:5px;">' + b.itemname + '</td><td style="width:20%;">' + b.weight + '</td><td style="width:20%;">' + b.rate + '</td><td style="width:10%;"> <a class="btn btn-danger btn-just-icon deleterow" id="' + b.id + '" style="margin-right:5px"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" ></i></a>  </td></tr>');
            $("#orderid").val(b.orderid);
            totalamountafterdelete = parseInt(totalamountafterdelete) + parseInt(b.rate);
          });
          $("#totalamount").val(totalamountafterdelete + parseInt($("#delivery_charge").val()));
          getitemdetail();
        }
      });
    });


    $(".bookorderbutton").on('click', function() {
      var condition_amount = parseInt($("#delivery_charge").val()) + parseInt(1);

      if ($("#totalamount").val() < condition_amount) {
        $("#form").validate();

        alert('Please Add Some Order.');
      } else {
        var fullname = ($("#fullname").val()).length;
        var address = ($("#address").val()).length;
        var mobile = ($("#mobile").val()).length;
        if (fullname > 0) {
          if (mobile > 9 && mobile < 11) {
            if (address > 0) {
              $(".bookorderbutton").prop("disabled", true);
              $.ajax({
                type: "get",
                url: "{{Route('insertteleorder')}}",
                data: {
                  _token: CSRF_TOKEN,
                  orderdate: $("#orderdate").val(),
                  custpresent: $("#custpresent").val(),
                  orderno: $("#orderno").val(),
                  fullname: $("#fullname").val(),
                  mobile: $("#mobile").val(),
                  altmobile: $("#altmobile").val(),
                  address: $("#address").val(),
                  details: $("#details").val(),
                  mop: $("#mop").val(),
                  shopname: $("#shopname").val(),
                  orderid: $("#orderid").val(),
                  amount: $("#totalamount").val(),
                  delivery_charge: $("#delivery_charge").val(),
                },
                dataType: 'json',
                success: function(data) {
                  var x = document.getElementById("snackbarsuccess");
                  x.className = "show";
                  setTimeout(function() {
                    x.className = x.className.replace("show", "");
                    location.reload();
                  }, 2500);


                }
              });
            } else {
              $("#addresserror").text('Please fill valid address');

            }
          } else {
            $("#mobileerror").text('Please fill valid number');

          }
        } else {
          $("#fullnameerror").text('Please fill valid name');

        }

      }
    });
    $("#loader").hide();





  });
</script>

@stop