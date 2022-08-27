@extends('layout')
@section('content')


<div class="page-content-wrap">

 
  @include('Shop/shoplayout')

                                    <div class="row">
                                      <div class="col-md-12" style="margin-top:-15px;">


                                        <div class="panel panel-default">



                                          <div class="col-md-12" style="margin-top:15px;">
                                            <h5 class="panel-title" style="color:#FFFFFF; background-color:#373a40; width:100%; font-size:14px;" align="center"><i class="fa fa-print"></i> Print Recipt</h5>

                                            <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                                              <table class="table" id="shoptable">
                                                <thead>
                                                  <tr>
                                                    <th style="display: none;"></th>

                                                    <th>Delivery Boy</th>
                                                    <th>Order Date</th>
                                                    <th>Order Time</th>
                                                    <th>Order No</th>
                                                    <th>Print</th>

                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($deliveryboyorder as $s)
                                                  <tr>                                                        <td style="display: none">{{$s['id']}}</td>

                                                    <td>
                                                      @foreach($deliveryboy as $d)
                                                      <?php 
                                                      if($s['name']==$d['id'])
                                                      {
                                                        echo $d['name'];
                                                      } 
                                                      ?>                                                          
                                                      @endforeach
                                                    </td>                                                    <td>{{date('d-m-Y',strtotime($s->created_at))}}</td> 
                                                    <td>{{date('H:i:s',strtotime($s->created_at))}}</td>

                                                    <td>
                                                      {{$s->orderno}}
                                                    </td>


                                                    <td>

                                                      <a href="{{url('printreceiptpdf')}}/{{$s->id}}" class="btn btn-warning btn-just-icon printreceipt" id="{{$s->id}}"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Print"></i></a>             

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
                            @stop
                            @section('js')
                                                          @include('Shop/count_script')


                            <script>
                              var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                              $(document).ready( function () {
                               $('#notification').hide();

                       
                                $('#shoptable').DataTable({
                                  "order": [[ 0, "desc" ]]

                                });
         

                                $(".delete").click(function(){
  // Holds the product ID of the clicked element
  var id = $(this).attr('id');
  $.ajax({
    type: "get",
    url: "{{Route('deleteshoporder')}}",
    data: {_token: CSRF_TOKEN,id:id}, 
    dataType:'json',
    success:function(data) {
     swal("Deleted!", "Your record has been deleted!", "success");
     setTimeout(function(){
      location.reload();
    }, 1800)  

   }
 });

});

                              } );

                            </script>

                            @stop