@extends('layout')
@section('content')


<div class="page-content-wrap">

  @include('Shop/shoplayout')

  <div class="row">
    <div class="col-md-12" style="margin-top:-15px;">


      <div class="panel panel-default">



        <div class="col-md-12" style="margin-top:15px;">
          <h5 class="panel-title" style="color:#FFFFFF; background-color:#ff0066; width:100%; font-size:14px;" align="center"><i class="fa fa-bank"></i> Shop Orders</h5>

          <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
            <table class="table" id="shoptable">
              <thead>
                <tr>
                  <th style="display: none;"></th>

                  <th>Order No.</th>
                  <th>Date</th>
                  <th>Item [ Weight-KG ]</th>
                  <th>Mobile</th>

                  <th>MOP</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($shop as $s)
                <tr>
                  <td style="display: none">{{$s['id']}}</td>

                  <td>{{$s->orderno}}</td>
                  <td>{{date('d-m-Y',strtotime($s->created_at))}}</td>
                  <td>
                    @foreach($orderlist as $o)
                    @if($s['orderid']==$o['orderid'])


                    {{$o['itemname']}} [ <strong>{{$o['weight']}}</strong>]<br>

                    @endif
                    @endforeach

                  </td>
                  <td><strong>{{$s->mobile}}</strong></td>
                  <td>{{$s->mop}}</td>
                  <td><strong style="color:#FF0000">{{$s->amount}}</strong></td>
                  <td>

                    <!--  <a href="{{url('editshoporder/'.$s->id)}}" class="btn btn-warning btn-just-icon edit" id="{{$s->id}}"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> -->

                    @if(Session::get('userdata')->role==1)
                    <a href="#" class="btn btn-danger btn-just-icon delete" id="{{$s->id}}"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                    @endif
                    <a href="{{url('printshoppdf/'.$s['id'])}}" target="_blank" class="btn btn-primary btn-just-icon print"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Print"></i>
                    </a>


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



    $('#shoptable').DataTable({
      "order": [
        [0, "desc"]
      ],
      "pageLength": 20,


    });
    $('#shoptable tbody').on('click', '.delete', function() {
      // Holds the product ID of the clicked element
      var id = $(this).attr('id');
      $.ajax({
        type: "get",
        url: "{{Route('deleteshoporder')}}",
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
    $("#loader").hide();
  });
</script>

@stop