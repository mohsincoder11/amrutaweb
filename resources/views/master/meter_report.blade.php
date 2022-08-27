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


        <div>
            <div>
                <!-- END DEFAULT DATATABLE -->




                <div class="row">
                    <div class="col-md-12" style="margin-top:-15px;">


                        <div class="panel panel-default">






                            <h5 class="panel-title" style="color:#FFFFFF; background-color:#3c3c3d; width:100%; font-size:14px;" align="center"><i class="fa fa-dashboard"></i> Meter Reading of {{$name}}</h5>

                            <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                                <table class="table" id="deliveryboytable">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date & Time</th>
                                            <th>Vehicle Number</th>
                                            <th>Meter Reading</th>
                                            <th>File</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($report as $key=>$report )                                          
                                       
                                        <tr>
                                            <td>{{$report->id}}</td>
                                            <td>
                                            {{date('d/m/Y',strtotime($report->created_at))}} {{date('H:i A',strtotime($report->created_at))}}
                                            </td>
                                            <td>
                                                {{$report->vehicle_no}}
                                            </td>
                                            <td>
                                                {!!get_meter_reading($report->date,$report->user_id)!!}
                                              
                                            </td>
                                            <td>
                                                <a target="_blank"  href="{{asset('public/uploads/meter_reading/'.$report->file)}}"><img style="height:5vh;width:5vh;border-radius:5px;" src="{{asset('public/uploads/meter_reading/'.$report->file)}}" alt="Click to view image"> </a> 
                                            </td>
                                            <td>
                                                    <a href="#" class="btn btn-danger btn-xs rounded-circle"><i class="fa fa-trash"></i></a>
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
        $("#loader").hide();

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
                if ($("#mobile").val() != $("#existmobile").val()) {


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
                } else {
                    $("#mobileexist").text("");

                }
            } else {
                $("#mobileexist").text("");

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
    });
</script>

@stop