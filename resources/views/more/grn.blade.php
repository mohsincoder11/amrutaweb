@extends('layout')
@section('content')
<?php $successcode = Session::get('successcode') ?>
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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;" align="center"><i class="fa fa-sticky-note-o"></i> &nbsp;GRN Form</h5>

        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <form role="form" method="post" action="{{url('insertgrn')}}">
            @csrf
            <input type="hidden" name="inputmode" id="inputmode" value="insert">
            <input type="hidden" name="updateid" id="updateid">
            <div class="form-group">
              <div class="col-md-12" style="margin-top:5px; margin-bottom:12px;">

                <table width="100%" border="0">

                  <tr>

                    <td style="padding:5px;" width="15%">
                      <label>Select Godawn<font color="#FF0000"></font></label>

                      <select class="form-control select" id="godawn" name="godawn">

                      </select>
                    </td>
                    <td style="padding: 5px;" width="15%">
                      <div class="input-group"> <label>Date of Purchase<font color="#FF0000"></font></label>

                        <input type="date" value="{{date('Y-m-d')}}" id="dateofpur" name="dateofpur" class="form-control " required="" style="z-index: 1">

                      </div>
                    </td>

                    <td style="text-align:left; padding: 5px;" width="15%"> <label>Select Vendor<font color="#FF0000"></font></label>

                      <select class="form-control select" name="vendor" id="vendor" required="">

                      </select>
                    </td>



                    <!-- </div> -->



                    <td style="text-align:left; padding: 5px;" width="15%"> <label>Vehicle No<font color="#FF0000"></font></label>

                      <input type="text" name="vehno" id="vehno" placeholder="Vehicle No" class="form-control" required="">
                    </td>


                    <td style="text-align:left; padding: 5px;" width="15%"> <label>Driver Name<font color="#FF0000"></font></label>

                      <input type="text" name="drivername" id="drivername" placeholder="Driver Name" class="form-control" required="">
                    </td>

                    <td style="text-align:left; padding: 5px;" width="25%"> <label style="margin-left: 110px;">Transact Mortality<font color="#FF0000"></font></label>
                      <div class="row">
                        <div class="col-md-6">
                          <input type="text" name="transmornos" id="transmornos" placeholder="Nos:" class="form-control" required="">

                        </div>
                        <div class="col-md-6">
                          <input type="text" name="transmorwt" id="transmorwt" placeholder="Wt." class="form-control" required="">

                        </div>
                      </div>
                    </td>
                    <td></td>
                  </tr>
                </table>
                <table width="100%" id="secondtable">
                  <tr>
                    <td style="padding:5px;" width="15%">
                      <label>Item<font color="#FF0000"></font></label>
                      <select class="form-control select" name="item" id="item">

                      </select>
                    </td>


                    <td style="text-align:left; padding: 5px;" width="15%">
                      <label>Rate/kgs.<font color="#FF0000"></font></label>
                      <input type="number" name="rate" id="rate" placeholder="Rate" class="form-control cal_total" required="">
                    </td>
                    <td style="text-align:left; padding: 5px;" width="15%">
                      <label>No. of Birds<font color="#FF0000"></font></label>
                      <input type="number" name="noofbird" value="1" id="noofbird" placeholder="NO of Birds" class="form-control cal_total" required="">
                    </td>
                    <td style="text-align:left; padding: 5px;" width="15%">
                      <label>Quantity(kgs.)<font color="#FF0000"></font></label>
                      <input type="text" name="quantity" value="1" id="quantity" placeholder="Quantity" class="form-control cal_total" required="">
                    </td>

                    <td style="text-align:left; padding: 5px;" width="15%">
                      <label>Avg. Body Wt.<font color="#FF0000"></font></label>
                      <input type="text" name="avgbodywt" id="avgbodywt" placeholder="Average Body Weight" class="form-control" readonly="" required="">
                    </td>
                    <td style="text-align:left; padding: 5px;" width="20%">
                      <div class="row">
                        <div class="col-md-6">
                          <label>Labour<font color="#FF0000"></font></label>
                          <input type="number" name="labor" value="1" id="labor" placeholder="Labor" class="form-control cal_total" required="">
                        </div>
                        <div class="col-md-6">
                          <label>Amount<font color="#FF0000"></font></label>
                          <input type="number" name="amount" id="amount" placeholder="Amount" class="form-control" required="">
                        </div>

                      </div>
                    </td>
                    <td></td>
                    <td style="text-align:left; padding: 5px;">
                      <div class="row">


                        <div class="col-md-6">

                          <button type="button" style="margin-top: 21px;" class="btn addmore" data-toggle="tooltip" data-placement="top" title="Add More"><i class="fa fa-plus" style="margin-left:2px;"></i>&nbsp;</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>
                <div class="row">
                  <table width="95%" class="table table-bordered" id="grnmorerow" style="margin-top: 5px">
                    <tbody id="appendbody">

                    </tbody>
                  </table>
                </div>
                <table>
                  <tr>
                    <td>
                      <input type="hidden" id="grnrefid" name="grnrefid">
                      <button style="margin-top: 10px;margin-left: 5px;" type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Submit"><i class="fa fa-plus" style="margin-left:2px;"></i>&nbsp;<span id="inputlabel"> Add</span>&nbsp;&nbsp;</button>

                    </td>
                  </tr>

                </table>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>





    <div class="row">
      <div class="col-md-12" style="margin-top:-15px;">




        <div class="col-md-2" style="margin-top:15px;"></div>

      </div>
      <div class="panel panel-default" style="margin-top:-15px;">



        <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
          <table class="table" id="purchaseformtable">
            <thead>
              <tr>
                <th>id</th>
                <th width="15%">GRN ID</th>
                <th width="10%">Godawn select</th>
                <th width="15%">Date of Porchase</th>
                <th width="10%">Vendor</th>
                <th width="10%">Vehicle No.</th>
                <th width="15%">Transact Mortality</th>
                <th width="10%">Driver Name</th>

                <th width="15%">Action</th>
              </tr>
            </thead>
            <tbody id="purchaseformrow">

            </tbody>
          </table>

          <!-- END DEFAULT DATATABLE -->


        </div>
      </div>



    </div>
    <!-- END PAGE CONTENT -->
  </div>

</div>
<div class="col-md-12 cancelmodel" id="myModal">
  <div class="col-md-offset-2 col-md-8 modalbody">

    <div class="modal-content">
      <div class="row" style="">
        <h3 style="color: #000;text-align: center"> GRN Id : <span id="grnidlabel"></span> <span class="close closemodel " style="float: right;color:red">&times;</span></h3>
        <table class="table pt-4">
          <thead>
            <tr>

              <th width="15%">Item</th>
              <th width="10%">Rate</th>
              <th width="15%">Quantity(kgs.)</th>
              <th width="10%">No. of Birds</th>
              <th width="10%">Avg. Body Wt.</th>
              <th width="15%">Amount</th>
              <th width="10%">Labour</th>

            </tr>
          </thead>
          <tbody id="viewmodalrow">

          </tbody>
        </table>
      </div>
      <hr>
      <div class="row"><button class=" btn btn-danger closemodel" style="float: right"><i class="fa fa-remove"></i>&nbsp;close</button></div>

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
<script>
  $(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    if ($("#successcode").val() == 1) {
      var x = document.getElementById("snackbarsuccess");
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    }
    if ($("#successcode").val() == 2) {
      var x = document.getElementById("snackbarupdate");
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    }
    showpurchaseform();
    getgodawn();

    function getgodawn() {

      $.ajax({
        type: "get",
        url: "{{Route('getgodawnnameid')}}",
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $('#godawn').empty();
          $.each(data, function(a, b) {
            $("#godawn").append(
              '<option value="' + b.id + '" selected>' + b.godawnname + '</option>'
            );
            //alert(data[j].fullname);
          });

          $("#godawn").selectpicker('refresh');
          $("#loader").hide();

        }
      });
    }
    getvendor();

    function getvendor() {

      $.ajax({
        type: "get",
        url: "{{Route('getvendornameid')}}",
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#vendor').empty();
          $.each(data, function(a, b) {
            $("#vendor").append(
              '<option value="' + b.id + '" selected>' + b.name + '</option>'
            );
            //alert(data[j].fullname);
          });

          $("#vendor").selectpicker('refresh');

        }
      });
    }
    getitem();

    function getitem() {

      $.ajax({
        type: "get",
        url: "{{Route('getitemnameid')}}",
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#item').empty();
          $("#item").append(
            '<option selected>Select Item</option>'
          );
          $.each(data, function(a, b) {
            $("#item").append(
              '<option value="' + b.id + '">' + b.itemname + '</option>'
            );
            //alert(data[j].fullname);
          });

          $("#item").selectpicker('refresh');


        }
      });
    }

    function showpurchaseform() {
      $("#loader").show();

      $.ajax({
        type: "get",
        url: "{{Route('getgrn')}}",
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#purchaseformtable').DataTable().clear().destroy();
          $.each(data, function(a, b) {
            $("#purchaseformrow").append(
              '<tr><td>' + b[0].id + '</td><td>' + b[0].grnid + '</td><td>' + b[0].godawnname + '</td><td>' + b[0].dateofpur + '</td><td>' + b[0].name + '</td><td>' + b[0].vehno + '</td><td>' + b[0].transmornos + ',' + b[0].transmorwt + '</td><td>' + b[0].drivername + '</td><td><button class="btn btn-warning btn-sm rounded-circle viewrecord" id=' + b[0].grnrefid + ' data-toggle="tooltip-primary" data-placement="top"  title="View Detail" ><i class="fa fa-eye"></i></button>&nbsp;<button class="btn btn-primary btn-sm rounded-circle editrecord" id=' + b[0].id + ' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-sm rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id=' + b[0].id + ' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
            );
            //alert(data[j].fullname);
          });
          createtable();
          $("#loader").hide();


        }
      });


    }
    $('.closemodel').on('click', function() {
      $("#myModal").hide();

    });
    $('.addmore').on('click', function() {

      $.ajax({
        type: "get",
        url: "{{Route('addmorerow')}}",
        data: {
          _token: CSRF_TOKEN,

          godawn: $("#godawn").val(),
          grnrefid: $("#grnrefid").val(),
          item: $("#item").val(),
          rate: $("#rate").val(),
          quantity: $("#quantity").val(),
          noofbird: $("#noofbird").val(),
          avgbodywt: $("#avgbodywt").val(),
          amount: $("#amount").val(),
          labor: $("#labor").val()
        },
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $("#appendbody").empty();
          $.each(data, function(a, b) {
            $("#appendbody").append('<tr ><td width="15%">' + b.itemname + '</td><td width="15%">' + b.rate + '</td><td width="15%">' + b.noofbird + '</td><td width="15%">' + b.quantity + '</td><td width="15%">' + b.avgbodywt + '</td><td width="10%">' + b.labor + '</td><td width="10%">' + b.amount + '</td><td width="5%"><button type="button" class="btn btn-danger btn-sm rounded-circle deletemorerow" id="' + b.id + '"   title="Delete " ><i class="fa fa-trash"></i></button></td></tr>');
            $("#grnrefid").val(b.grnrefid2);

          })
          $("#loader").hide();

        }

      });
    });

    $('#grnmorerow tbody').on('click', '.deletemorerow', function() {
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{Route('deletemorerow')}}",
        data: {
          _token: CSRF_TOKEN,
          id: id,
          godawn: $("#godawn").val(),
          grnrefid2: $("#grnrefid").val()
        },
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $("#appendbody").empty();
          $.each(data, function(a, b) {
            $("#appendbody").append('<tr ><td width="15%">' + b.itemname + '</td><td width="15%">' + b.rate + '</td><td width="15%">' + b.noofbird + '</td><td width="15%">' + b.quantity + '</td><td width="15%">' + b.avgbodywt + '</td><td width="10%">' + b.labor + '</td><td width="10%">' + b.amount + '</td><td width="5%"><button type="button" class="btn btn-danger btn-sm rounded-circle deletemorerow" id="' + b.id + '"   title="Delete " ><i class="fa fa-trash"></i></button></td></tr>');

          })
        }
      });
    });

    $('#purchaseformtable tbody').on('click', '.delete', function() {
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{Route('deletegrn')}}",
        data: {
          _token: CSRF_TOKEN,
          id: id
        },
        dataType: 'json',
        success: function(data) {
          swal("Deleted!", "Your record has been deleted!", "success");
          setTimeout(function() {
            location.reload();
          }, 1800)
        }
      });
    });



    $('#purchaseformtable tbody').on('click', '.viewrecord', function() {
      var grnrefid = $(this).attr('id');
      $("#myModal").show();
      $.ajax({
        type: "get",
        url: "{{Route('getgrnrow')}}",
        data: {
          _token: CSRF_TOKEN,
          grnrefid: grnrefid
        },
        dataType: 'json',
        success: function(data) {
          $("#viewmodalrow").empty();
          $.each(data, function(a, b) {
            $("#viewmodalrow").append('<tr ><td width="15%">' + b.itemname + '</td><td width="15%">' + b.rate + '</td><td width="15%">' + b.quantity + '</td><td width="15%">' + b.noofbird + '</td><td width="15%">' + b.avgbodywt + '</td><td width="10%">' + b.amount + '</td><td width="10%">' + b.labor + '</td></tr>');
            $("#grnidlabel").text(b.grnid);
          })
        }
      });
    });

    $('#purchaseformtable tbody').on('click', '.editrecord', function() {
      var id = $(this).attr('id');
      //alert(id);
      $.ajax({
        type: "get",
        url: "{{Route('editgrn')}}",
        data: {
          _token: CSRF_TOKEN,
          id: id
        },
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $("#inputmode").val('update');
          $("#inputlabel").text('Update GRN');
          $("#updateid").val(data.id);

          $("#dateofpur").val(data.dateofpur);
          $("#godawn").val(data.godawn);
          $("#vehno").val(data.vehno);
          $("#vendor").val(data.vendor);
          $("#drivername").val(data.drivername);
          $("#transmornos").val(data.transmornos);
          $("#transmorwt").val(data.transmorwt);
          $("#item").val(data.item);
          $("#rate").val(data.rate);
          $("#quantity").val(data.quantity);
          $("#noofbird").val(data.noofbird);
          $("#avgbodywt").val(data.avgbodywt);
          $("#amount").val(data.amount);
          $("#labor").val(data.labor);


          $("#vendor").selectpicker('refresh');
          $("#godawn").selectpicker('refresh');
          $("#item").selectpicker('refresh');

        }
      });
    });

    function createtable() {
      $("#purchaseformtable").dataTable({
        "info": true,
        "autoWidth": false,
        responsive: true,
        "order": [
          [0, "desc"]
        ],
        "columnDefs": [{
          "targets": [0],
          "visible": false,
        }],
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }

      });
    }


    $(".cal_total").keyup(function() {
      var noofbird = $("#noofbird").val();
      var quantity = $("#quantity").val();
      var avgbodywt = (quantity / noofbird).toFixed(3);
      $("#avgbodywt").val(avgbodywt);

      var rate = $("#rate").val();
      var labor = $("#labor").val();
      var total = Math.round((rate * quantity) + parseInt(labor));
      $("#amount").val(total);


    });




  });
</script>
@stop