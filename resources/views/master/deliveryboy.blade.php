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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#3c3c3d; width:100%; font-size:14px;" align="center"><i class="fa fa-users"></i> &nbsp;Add Delivery Boy</h5>
        <?php $successcode = Session::get('successcode') ?>
        <input type="hidden" value="{{$successcode}}" id="successcode">



        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group">



            <form method="POST" action="{{url('insertdeliveryboy')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="inputmode" id="inputmode" value="insert"> 
              <input type="hidden" name="updateid" id="updateid">
              <input type="hidden" id="existmobile">
              <div class="col-md-12">
                <div class="form-group" style="margin-top:-10px;">
                  <div class="col-md-1"> </div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Full Name<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Name" class="form-control" name="name" id="name" autofocus="" required />
                  </div>

                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Mobile<font color="#FF0000">*</font></label>
                    <input type="number" placeholder="Enter Mobile" class="form-control" name="mobile" id="mobile" required />
                    <label for="" class="text-danger"><span id="mobileexist"></span></label>
                  </div>

                  <div class="col-md-4" style="margin-top:15px;">
                    <label>Address<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Addresss" class="form-control" name="address" id="address" required />
                  </div>



                  <div class="col-md-2" style="margin-top:3.1rem;" align="center">

                    <div class="input-group" style="margin-bottom:15px;">

                      <button type="submit" class="btn btn-primary submitbutton"><span class="fa fa-plus"></span> <span id="inputlabel">Add Delivery Boy</span></button>
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






              <h5 class="panel-title" style="color:#FFFFFF; background-color:#3c3c3d; width:100%; font-size:14px;" align="center"><i class="fa fa-users"></i> Added Delivery Boy</h5>

              <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                <table class="table" id="deliveryboytable">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Delivery Boy Name</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="deliveryboyrow">

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

    if ($("#successcode").val() == 'insert') {
      var x = document.getElementById("snackbarsuccess");
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    }
    if ($("#successcode").val() == 'update') {
      var x = document.getElementById("snackbarupdate");
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    }

    $("#mobile").blur(function() {
      
      if (($("#mobile").val()).length == 10) {
        if($("#mobile").val()!=$("#existmobile").val())
        {

       
        $.ajax({
          type: "get",
          url: "{{Route('check_deliveryboy_no')}}",
          data: {
            _token: CSRF_TOKEN,
            mobile: $("#mobile").val()
          },
          dataType: 'json',
          success: function(data) {
            console.log(data);
            if (data == 1) {
              $("#mobileexist").text("Mobile number already exist");
              $(".submitbutton").addClass('disabled');

            } else {
              $("#mobileexist").text("");
              $(".submitbutton").removeClass('disabled');
            }

          }
        });
      }
      else
      { $("#mobileexist").text("");

      }
      }
      else
      { $("#mobileexist").text("");

      }

    });

    $('#deliveryboytable tbody').on('click', '.delete', function() {
      // Holds the product ID of the clicked element
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{Route('deletedeliveryboy')}}",
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
    $("#form").validate({
      rules: {
        mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
        },

      },
      messages: {
        mobile: {
          required: 'Mobile Number Should Be 10 Digit.'
        },

      }
    });
    showdeliveryboy();

    function showdeliveryboy() {
      $.ajax({
        type: "get",
        url: "{{url('getalldeliveryboylist')}}",
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $('#deliveryboytable').DataTable().clear().destroy();
          $.each(data, function(a, b) {
            $("#deliveryboyrow").append(
              '<tr><td>' + b.id + '</td><td>' + b.name + '</td><td>' + b.mobile + '</td><td>' + b.address + '</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id=' + b.id + ' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id=' + b.id + ' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a>&nbsp;<a href="{{url("view_meter_report/")}}/'+b.id+'"  class="modal-effect btn btn-warning btn-xs rounded-circle" title="View Meter Reading" data-placement="top"><i class="fa fa-eye"></i></a></td></tr>'
            );
            //alert(data[j].fullname);
          });
          createtable();

          $("#loader").hide();

        }
      });


    }

    $('#deliveryboytable tbody').on('click', '.editrecord', function() {
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{url('editdeliveryboy')}}",
        data: {
          _token: CSRF_TOKEN,
          id: id
        },
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $("#name").val(data.name);
          $("#mobile").val(data.mobile);
          $("#address").val(data.address);
          $("#inputmode").val('update');
          $("#updateid").val(data.id);
          $("#existmobile").val(data.mobile);
          $("#inputlabel").text('Update Delivery Boy');
          

        }
      });
    });

    function createtable() {
      $("#deliveryboytable").dataTable({
        "info": true,
        "autoWidth": false,
        responsive: true,
        "pageLength": 10,

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
  });
</script>

@stop