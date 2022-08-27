@extends('layout')
@section('content')

<div id="snackbarupdate">
  <div class="row">
    <div class="col-md-12"><label for=""><strong>Success!</strong> Record Updated Successfully.</label></div>

  </div>

</div>
<div class="page-content-wrap">
  @include('master/masterlayout')

  <!-- END DEFAULT DATATABLE -->




  <?php $successcode = Session::get('successcode') ?>
  <input type="hidden" value="{{$successcode}}" id="successcode">

  <div class="row" id="shopeditrow">
    <div class="col-md-12" style="margin-top:-15px;">
      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-bank"></i> &nbsp;Edit Shop</h5>
        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group">



            <form method="POST" action="{{url('updateshop')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="updateid" id="updateid">
              <div class="col-md-12">
                <div class="form-group" style="margin-top:0px;">



                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Shop Name<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Shop Name" class="form-control" id="shopname" name="shopname" autofocus required />
                  </div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Opening Birds<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Opening Birds" class="form-control" id="opening_birds" name="opening_birds" autofocus required />
                  </div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Birds Weight<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Weights" class="form-control" id="birds_weights" name="birds_weights" autofocus required />
                  </div>

                  <div class="col-md-3" style="margin-top:15px;">
                    <label>Address<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Shop Address" class="form-control" id="address" name="address" required />
                  </div>

                  <div class="col-md-3" style="margin-top:15px;">
                    <label>Latitude and Longitude<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Lat,Long" class="form-control" id="lat_long" name="lat_long" required />
                  </div>

                  <div class="col-md-1" style="margin-top:3.1rem;" align="center">

                    <div class="input-group" style=" margin-bottom:5px;">

                      <button type="submit" class="btn btn-primary"><span class="fa fa-upload"></span> <span id="inputlabel"> Update Shop</span></button>
                    </div>
                  </div>




                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">


      <div class="panel panel-default">


        <div class="col-md-2" style="margin-top:15px;"></div>

        <div class="col-md-8" style="margin-top:15px;">

          <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-bank"></i> Added Shop</h5>

          <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
            <table class="table" id="shoptable">
              <thead>
                <tr>
                  <th></th>

                  <th width="20%">Shop Name</th>
                  <th width="15%"> Opening Birds</th>
                  <th width="15%"> Weights</th>
                  <th width="40%">Address</th>
                  <th width="40%">Lat Long</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody id="shoprow">
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-2" style="margin-top:15px;"></div>

      </div>


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
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $(document).ready(function() {
    var x = document.getElementById("geolocation");
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }

    function showPosition(position) {
      var geolocation = position.coords.latitude + ',' + position.coords.longitude;
      $('#lat_lang').val(geolocation);
    }
    $('#shopeditrow').hide();

    if ($("#successcode").val() == 'update') {
      var x = document.getElementById("snackbarupdate");
      x.className = "show";
      setTimeout(function() {
        x.className = x.className.replace("show", "");
      }, 3000);
    }
    $('#shoptable').DataTable({
      "order": [
        [0, "desc"]
      ]

    });


    $('#shoptable tbody').on('click', '.delete', function() {
      // Holds the product ID of the clicked element
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{Route('deleteusermanage')}}",
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
    showshop();

    function showshop() {
      $.ajax({
        type: "get",
        url: "{{url('getallshop')}}",
        dataType: 'json',
        success: function(data) {
          //console.log(data);
          $('#shoptable').DataTable().clear().destroy();
          $.each(data, function(a, b) {
            $("#shoprow").append(
              '<tr><td>' + b.id + '</td><td>' + b.shopname + '</td><td>' + b.opening_birds + '</td><td>' + b.birds_weights + '</td><td>' + b.address + '</td><td>' + b.lat_long + '</td><td><button class="btn btn-primary btn-xs rounded-circle editrecord" id=' + b.id + ' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;</td></tr>'
            );
            //alert(data[j].fullname);
          });
          createtable();

          $("#loader").hide();

        }
      });


    }

    function createtable() {
      $("#shoptable").dataTable({
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
    $('#shoptable tbody').on('click', '.editrecord', function() {
      $('#shopeditrow').show();


      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{url('editshop')}}",
        data: {
          _token: CSRF_TOKEN,
          id: id
        },
        dataType: 'json',
        success: function(data) {
         // console.log(data);

          $("#address").val(data.address);
          $("#lat_long").val(data.lat_long);
          $("#shopname").val(data.shopname);
          $("#opening_birds").val(data.opening_birds);
          $("#birds_weights").val(data.birds_weights);

          $("#updateid").val(data.id);

        }
      });
    });
    $("#form").validate({
      rules: {
        uniqueprefix: {
          required: true,
          minlength: 3,
          maxlength: 3,
        },

      },
      messages: {
        uniqueprefix: {
          required: 'Enter 3 Character Prefix'
        },

      }
    });

  });
</script>

@stop