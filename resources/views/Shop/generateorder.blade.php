@extends('layout')
@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  @include('Shop/shoplayout')



  <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">
      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-list"></i> &nbsp;Generate Orders</h5>
        <div class="row">

          <div class="col-sm-8"></div>
          <div id="snackbarsuccess">
            <div class="row">
              <div class="col-md-12"><label for=""><strong>Success!</strong> Order Placed Successfully.</label></div>

            </div>

          </div>


        </div>
        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group">



            <form name="form" id="form" autocomplete="off">
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
                                <option value="{{$i->id}}" type="{{$i->type}}">{{$i->itemname}}</option>
                                @endforeach

                              </select>
                              <input type="hidden" name="itemname2" id="itemname2">
                            </td>
                            <td style="padding:5px;">
                              <input style="background-color:#FFFFFF;" type="number" placeholder="Enter Weight" class="form-control" name="weight" id="weight" required min="0.1" />
                            </td>
                            <td style="padding:5px;">
                              <input style="background-color:#FFFFFF;color: #555" type="number" placeholder="Enter Amount" name="rate" id="rate" class="form-control" readonly="" required />
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
                          <label>Mobile<font color="#FF0000">*</font></label>
                          <input type="text" placeholder="Mobile" class="form-control" id="mobile" name="mobile" required />
                          <label for="" class="text-danger"> <span id="mobileerror"></span></label>
                        </div>

                      </div>

                      <div class="row">


                        <div class="col-md-4">
                          <label>Address</label>
                          <input type="text" name="address" id="address" placeholder="Address" class="form-control" />
                        </div>
                        <div class="col-md-4">
                          <label>Order Specification<font color="#FF0000">*</font></label>
                          <input type="text" placeholder="Order Details" value="NA" name="details" id="details" class="form-control" required />
                        </div>



                        <div class="col-md-4">
                          <label>MOP<font color="#FF0000">*</font></label>
                          <select class="form-control select" name="mop" id="mop">
                            <option value="CASH">Cash</option>
                            <option value="ONLINE">Online</option>
                          </select>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Discount<font color="#FF0000">*</font></label>
                          <input type="number" placeholder="Discount" class="form-control" id="discount" name="discount" value="0" required />
                        </div>
                        <div class="col-md-4" style="margin-top:15px;">
                          <label>Total Amount<font color="#FF0000">*</font></label>
                          <input type="number" placeholder="Total Amount" class="form-control" id="totalamount" name="totalamount" value="0" readonly="" required style="font-size: 18px;color: #555" />
                          <input type="hidden" id="totalamount2" name="totalamount2">
                        </div>
                        <div class="col-md-4" style="margin-top:25px;" align="left">
                          <button type="button" style="background-color:#00cc00; border:none; min-width:150px; max-height:35px; margin-top:12px;" class="btn btn-info generateorderbutton" data-toggle="tooltip" data-placement="top" title="Make Sure For Correct Information"><i class="fa fa-thumbs-up" style="margin-left:5px;"></i>Generate Order</button>
                        </div>

                        <!-- <button style="margin-top:5%" class="btn btn-primary" id="machine_order_btn">check machine order</button> -->
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
@include('Shop/count_script')

<script>
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $(document).ready(function() {
    $('#notification').hide();
    // $("#machine_order_btn").click(function() {
    //   console.log('hello there');
    //   var formData = {
    //     "mobile": "7385078839",
    //     "address": "Amravati",
    //     "spec": "NA",
    //     "mop": "MOP",
    //     "disc": "131",
    //     "totalamount": "36002",
    //     "data": [{
    //         "id": 17,
    //         "name": "CHICKEN CURRY PIECE ( SMALL)",
    //         "weight": "0.33",
    //         "rate": "200",
    //         "masterid": "31"
    //       },
    //       {
    //         "id": 17,
    //         "name": "CHICKEN CURRY PIECE ( SMALL)",
    //         "weight": "0.385",
    //         "rate": "200",
    //         "masterid": "31"
    //       }
    //     ]
    //   };
    //   $.ajax({
    //     type: "post",
    //     url: "{{url('api/generate_shop_order')}}",
    //     data: {
    //       formData: JSON.stringify(
    //         formData)
    //     },
    //     processData: true,
    //     dataType: 'json',
    //     success: function(data) {
    //       console.log(data);
    //     }
    //   });

    // })


    getitemdetail();

    function getitemdetail() {
      var id = $("#itemname").val();
      //alert(id);
      $.ajax({
        type: "GET",
        dataType: "json",

        url: 'getamount/' + id,
        success: function(data) {
          // console.log(data);
          $("#rate").val(data.retailrate);
          $("#weight").val('1.000');
          $("#actualamount").val(data.retailrate);
          // $("#totalamount").val(data.retailrate);
          $("#itemname2").val(data.itemname);

        }
      });
    }



    $("#weight").keyup(function() {
      var weight = $("#weight").val();
      var actualamount = $("#actualamount").val();
      var amount = $("#amount").val();
      var total = Math.round(weight * actualamount);
      $("#rate").val(total);
    });

    $("#mobile").blur(function() {
      if (($("#mobile").val()).length == 10) {
        $("#mobileerror").text('');
      } else {
        $("#mobileerror").text('Please fill Valid Number');

      }

    });

    $("#discount").keyup(function() {
      var discount = $("#discount").val();
      var amount = $("#totalamount2").val();

      var total = (amount - discount);
      $("#totalamount").val(total);

    });
    $('.itemnamec').on('change', function() {
      getitemdetail();

    });


    $(".generateorderbutton").on('click', function() {

      if ($("#totalamount").val() < 1) {
        alert('Please Add Some Order.');
      } else {
        var mobile = ($("#mobile").val()).length;
        if (mobile == 10) {
          $(".generateorderbutton").prop('disabled',true);
          $.ajax({
            type: "get",
            url: "{{Route('insertshoporder')}}",
            data: {
              _token: CSRF_TOKEN,
              orderid: $("#orderid").val(),
              address: $("#address").val(),
              orderdate: $("#orderdate").val(),
              orderno: $("#orderno").val(),
              mobile: $("#mobile").val(),
              details: $("#details").val(),
              discount: $("#discount").val(),
              mop: $("#mop").val(),
              amount: $("#totalamount").val(),
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
          //alert('Please fill all required field properly.');
          $("#mobileerror").text('Please fill Valid Number');
        }
      }
    });


    $(".addorderrow").click(function() {

      var itemname = $("#itemname2").val();
      var weight = $("#weight").val();
      var rate = $("#rate").val();
      var orderid = $("#orderid").val();
      var type = $("#itemname option:selected").attr('type');
      var totalamountafteradd = 0;
      if (parseFloat(weight) >= 10) {
        swal({
            title: "Are you sure?",
            text: "You want to add " + weight + " KG chicken order?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((confirm) => {
            if (confirm) {
              add_item();
              $("#weight").val('1.000');
            } else {
              return;
            }
          });
      } else {
        add_item();
      }

      function add_item() {
        $.ajax({
          type: "get",
          url: "{{Route('addshoporderrow')}}",
          data: {
            _token: CSRF_TOKEN,
            orderid: orderid,
            itemname: itemname,
            weight: weight,
            rate: rate,
            type: type
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
              $("#totalamount2").val(totalamountafteradd)
            });
            getitemdetail();
          }
        });
      }
    });

    $(".addrow").on('click', '.deleterow', function() {
      var deleteid = $(this).attr('id');
      totalamountafterdelete = 0;
      $.ajax({
        type: "get",
        url: "{{Route('deleteorderrow')}}",
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
          $("#totalamount").val(totalamountafterdelete);
          $("#totalamount2").val(totalamountafterdelete);
          getitemdetail();
        }
      });

    });

    $("#loader").hide();


  });
</script>

@stop