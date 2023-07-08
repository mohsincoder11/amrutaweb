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


  <div class="row" style="margin-top:4%">
    <div class="col-md-12" style="margin-top:-15px;">
      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#ff0066; width:100%; font-size:14px;" align="center"><i class="fa fa-users"></i> &nbsp;Add Item</h5>
        <?php $successcode = Session::get('successcode') ?>
        <input type="hidden" value="{{$successcode}}" id="successcode">



        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group">



            <form method="POST" action="{{url('insertitem')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="inputmode" id="inputmode" value="insert">
              <input type="hidden" name="updateid" id="updateid">
              <div class="col-md-12">
                <div class="form-group" style="margin-top:-10px;">


                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Select Item Type<font color="#FF0000">*</font></label>
                    <select class="form-control select" name="type" id="type" required="">

                    <option value="1">Regular Item</option>
                    <option value="2">Offer Item</option>
                    <option value="3">B Grade Item</option>
                    <option value="4">Pet Food Item</option>


                    </select>
                  </div>

                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Item Name<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Item Name" class="form-control" id="itemname" name="itemname" autofocus required />
                  </div>

                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Item Rate [For Retail]<font color="#FF0000">*</font></label>
                    <input type="number" placeholder="Enter Rate" class="form-control" id="retailrate" name="retailrate" required />
                  </div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Item Rate [For Hotel]<font color="#FF0000">*</font></label>
                    <input type="number" placeholder="Enter Rate" class="form-control" id="hotelrate" name="hotelrate" required />
                  </div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Item Image<font color="#FF0000">*</font></label>
                    <input type="file" class="form-control" id="image" name="image" />

                  </div>


                  <div class="col-md-2" style="margin-top:3.1rem;" align="center">

                    <div class="input-group" style=" margin-bottom:15px;">

                      <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> <span id="inputlabel"> Add Item</span></button>
                    </div>
                  </div>
                  <div class="col-md-3" style="margin-top:15px;"></div>




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
                <h5 class="panel-title" style="color:#FFFFFF; background-color:#ff0066; width:100%; font-size:14px;" align="center"><i class="fa fa-users"></i> Added Items</h5>

                <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                  <table class="table" id="itemtable">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Item Name</th>
                        <th>Image</th>
                        <th>Retail Rate</th>
                        <th>Hotel Rate</th>
                        <th>Type</th>
                        <th>Stock</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="itemrow">

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
    $('#itemtable').DataTable({
      "order": [
        [0, "desc"]
      ],
      "pageLength": 10,


    });

    $('#itemtable tbody').on('click', '.delete', function() {
      // Holds the product ID of the clicked element
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{Route('deleteitem')}}",
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

    });

    showitem();

    function showitem() {
      $.ajax({
        type: "get",
        url: "{{url('getallitemlist')}}",
        dataType: 'json',
        success: function(data) {
          // console.log('%c hello','color:orange;font-weight:bold;font-size:30px;');
          //console.table(data);

          $('#itemtable').DataTable().clear().destroy();
          $.each(data, function(a, b) {
            let type;
            b.type==1 ? type='Regular Item' : '';
            b.type==2 ? type='Offer Item' : '';
            b.type==3 ? type='B Grade Item' : '';
            var label = '<label class="switchss"><input class="switch-input outofstock" type="checkbox"  checked="" id="' + b.id + '" value="0" />  <span class="switch-label" data-on="In Stock" data-off="Out of Stock"></span>  <span class="switch-handle"></span> </label>'
            if (b.stock == 0) {
              label = '<label class="switchss">  <input class="switch-input outofstock" type="checkbox" id="' + b.id + '" value="1" />  <span class="switch-label" data-on="In Stock" data-off="Out Of Stock"></span>   <span class="switch-handle"></span> </label>';
            }
            $("#itemrow").append(
              '<tr><td>' + b.id + '</td><td>' + b.itemname + '</td><td><img class="itemimage" src="{{asset("public/images/itemimage")}}/' + b.image + '"></td><td>' + b.retailrate + '</td><td>' + b.hotelrate + '</td><td>' + type + '</td><td>' + label + '</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id=' + b.id + ' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id=' + b.id + ' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
            );
            //alert(data[j].fullname);
          });
          createtable();

          $("#loader").hide();


        }
      });


    }

    $('#itemtable tbody').on('click', '.editrecord', function() {
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{url('edititem')}}",
        data: {
          _token: CSRF_TOKEN,
          id: id
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $("#itemname").val(data.itemname);
          $("#retailrate").val(data.retailrate);
          $("#hotelrate").val(data.hotelrate);
          $("#type").val(data.type);
          $("#type").selectpicker('refresh');
          $("#inputmode").val('update');
          $("#updateid").val(data.id);
          $("#inputlabel").text('Update Item');
    $('html, body').animate({
        scrollTop: $("#form").offset().top
    }, 700);

        }
      });
    });
    $('#itemtable tbody').on('click', '.outofstock', function() {
      $.ajax({
        type: "get",
        url: "{{url('update_stock')}}",
        data: {
          _token: CSRF_TOKEN,
          id: $(this).attr('id'),
          stock: $(this).attr('value')
        },
        dataType: 'json',
        success: function(data) {
          setTimeout(function() {
            location.reload();
          }, 1000);
        }
      });
    });

    function createtable() {
      $("#itemtable").dataTable({
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

  });
</script>

@stop