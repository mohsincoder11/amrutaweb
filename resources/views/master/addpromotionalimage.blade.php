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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#630947; width:100%; font-size:14px;" align="center"><i class="fa fa-image"></i> &nbsp;Add Promotional Images</h5>
        <?php $successcode = Session::get('successcode') ?>
        <input type="hidden" value="{{$successcode}}" id="successcode">



        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group">



            <form method="POST" action="{{url('insert_promo_image')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-12">
                <div class="form-group" style="margin-top:-10px;">


                  <div class="col-md-3" style="margin-top:15px;"></div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Name<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter Name" class="form-control" id="name" name="name" autofocus required />
                  </div>


                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Item Image<font color="#FF0000">*</font></label>
                    <input type="file" class="form-control" id="image" name="image" />

                  </div>


                  <div class="col-md-2" style="margin-top:3.1rem;" align="center">

                    <div class="input-group" style=" margin-bottom:15px;">

                      <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> <span id="inputlabel"> Add Image </span></button>
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



              <div class="col-md-2" style="margin-top:15px;"></div>

              <div class="col-md-8" style="margin-top:15px;">
                <h5 class="panel-title" style="color:#FFFFFF; background-color:#630947; width:100%; font-size:14px;" align="center"><i class="fa fa-image"></i>&nbsp; Added Promotional Images</h5>

                <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                  <table class="table" id="itemtable">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th> Name</th>
                        <th>Image</th>

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
      ]

    });

    $('#itemtable tbody').on('click', '.delete', function() {
      // Holds the product ID of the clicked element
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{Route('delete_promo_image')}}",
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
        url: "api/getallpromotion_api",
        dataType: 'json',
        success: function(data) {

          $('#itemtable').DataTable().clear().destroy();
          $.each(data, function(a, b) {

            $("#itemrow").append(
              '<tr><td>' + b.id + '</td><td>' + b.name + '</td><td><img class="itemimage" src="{{asset("public/images/promoimage")}}/' + b.image + '"></td><td><a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id=' + b.id + ' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
            );
            //alert(data[j].fullname);
          });
          createtable();

          $("#loader").hide();


        }
      });


    }


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
    $("#loader").hide();

  });
</script>

@stop