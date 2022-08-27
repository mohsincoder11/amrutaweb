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

        <h5 class="panel-title" style="color:#FFFFFF; background-color:#0b4208; width:100%; font-size:14px;" align="center"><i class="fa fa-percent"></i> &nbsp;Add Coupon</h5>
        <?php $successcode = Session::get('successcode') ?>
        <input type="hidden" value="{{$successcode}}" id="successcode">
        <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
          <div class="form-group">



            <form method="POST" action="{{url('insert_coupon')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="updateid" id="updateid">
              <div class="col-md-12">
                <div class="form-group" style="margin-top:-10px;">

                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Title<font color="#FF0000">*</font></label>
                    <input type="text" placeholder="Enter coupon title" class="form-control" name="title" autofocus="" id="title" required />
                  </div>


                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Coupon Code<font color="#FF0000">*</font></label>
                    <input type="text" style="text-transform:uppercase;" placeholder="Enter coupon code" class="form-control" name="coupon_code" autofocus="" id="coupon_code" required />
                  </div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Discount(Percent)<font color="#FF0000">*</font></label>
                    <input type="number" placeholder="Enter coupon discount" class="form-control" name="discount_percent" autofocus="" id="discount_percent" required />
                  </div>
                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Minimum Amount<font color="#FF0000">*</font></label>
                    <input type="number" placeholder="Enter minimum amount" class="form-control" name="min_amount" id="min_amount" required />
                  </div>

                  <div class="col-md-2" style="margin-top:15px;">
                    <label>Maximum Discount(in rupees) <font color="#FF0000">*</font></label>
                    <input type="number" placeholder="Enter max discount" class="form-control" name="max_discount" id="max_discount" required />
                  </div>





                  <div class="col-md-2" style="margin-top:3.1rem;" align="center">

                    <div class="input-group" style=" margin-bottom:15px;">

                      <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> <span id="inputlabel"> Add Coupon</span></button>
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






              <h5 class="panel-title" style="color:#FFFFFF; background-color:#0b4208; width:100%; font-size:14px;" align="center"><i class="fa fa-percent"></i> Added Coupon</h5>

              <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                <table class="table" id="customertable3">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Coupon Code</th>
                      <th>Discount Percent</th>
                      <th>Min Amount</th>
                      <th>Max Discount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($coupon as $c )
                    <tr>
                      <td>{{$c->title}}</td>
                      <td>{{$c->coupon_code}}</td>
                      <td><b> {{$c->discount_percent}}%</b></td>
                      <td>{{$c->min_amount}}</td>
                      <td>{{$c->max_discount}}</td>
                      <td width="30%"> 
                        <a>   <label class="switchss" style="display:inline-block"> 
                           <input @if($c->status==1) checked value="0" @else value="1" @endif class="switch-input outofstock" type="checkbox" id="{{$c->id}}"  />  <span class="switch-label" data-on="Live" data-off="Disabled"></span>   <span class="switch-handle"></span> </label></a>
                   
                        <a class="btn btn-warning edit_record" id="{{$c->id}}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger delete_record" id="{{$c->id}}"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
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

    $('#customertable3 tbody').on('click', '.outofstock', function() {
      $.ajax({
        type: "get",
        url: "{{url('update_coupon_status')}}",
        data: {
          _token: CSRF_TOKEN,
          id: $(this).attr('id'),
          status: $(this).attr('value')
        },
        dataType: 'json',
        success: function(data) {
          setTimeout(function() {
            location.reload();
          }, 1000);
        }
      });
    });


    $('#customertable3 tbody').on('click', '.delete_record', function() {
      var id = $(this).attr('id');
      //alert(id);
      $.ajax({
        type: "get",
        url: "{{url('delete_coupon')}}",
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


    $('#customertable3 tbody').on('click', '.edit_record', function() {
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{url('edit_coupon')}}",
        data: {
          _token: CSRF_TOKEN,
          id: id
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);          
          $("#discount_percent").val(data.discount_percent);
          $("#title").val(data.title);
          $("#min_amount").val(data.min_amount);
          $("#max_discount").val(data.max_discount);
          $("#coupon_code").val(data.coupon_code);
          $("#updateid").val(data.id);
          $("#inputlabel").text('Update Coupon');

        }
      });
    });
    $("#custtype").append(
      '<option value="Person">Person</option><option value="Hotel">Hotel</option>'
    );
    $("#custtype").selectpicker("refresh");


    $("#form").validate({

    });
    $("#loader").hide();

  });
</script>

@stop