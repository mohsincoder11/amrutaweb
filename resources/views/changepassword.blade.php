@extends('layout')
@section('content')
<div class="col-sm-12" style="padding-top: 20px;">
	            <?php $successcode=Session::get('successcode') ?>

            <input type="hidden" id="error" value="{{$successcode ?? '0'}}">
            <div id="snackbarsuccess">
                                              <div class="row">
                                                <div class="col-sm-2"><img src="{{asset('public/logo/success3.gif')}}" alt=""></div>
                                                <div class="col-sm-10"><label for=""><strong>Success!</strong> Password Changed Successfully.</label></div>

                                              </div>               

                                            </div> 
                                            <div id="snackbarupdate">
                                              <div class="row">
                                                <div class="col-sm-2"><img src="{{asset('public/logo/infoicon.gif')}}" alt=""></div>
                                                <div class="col-sm-10"><label for=""><strong>Warning !</strong> Old Password Does Not Matched.</label></div>

                                              </div>               

                                            </div>

        </div>
<div class="page-content-wrap">

 


<div class="page-content-wrap">

<div class="row">
  <div class="col-md-12" style="margin-top:-15px;">
   <!-- START DEFAULT DATATABLE -->
   <div class="panel panel-default">

    <h5 class="panel-title" style="color:#FFFFFF; background-color:#A43F3E; width:100%; font-size:14px;" align="center"><i class="fa fa-user"></i> &nbsp;Change Password </h5>

    <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
      <div class="form-group"> 



       <form method="POST" action="{{url('updatepassword')}}" class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
        {{ csrf_field() }}   
        <div class="row">


          <div class="col-md-12">
            <div class="form-group" style="margin-top:-10px;">   


             <div class=" col-md-offset-3 col-md-2" style="margin-top:15px;">
              <label>Old Password<font color="#FF0000">*</font></label>
              <input type="text" placeholder="Enter Old Password" class="form-control" required name="oldpassword"/ >
            </div> 
             
                                            
            <div class="col-md-2" style="margin-top:15px;">
              <label>New Password<font color="#FF0000">*</font></label>
              <input type="password" placeholder="Enter New Password" class="form-control" required name="password" id="pass1" / >
            </div>

            <div class="col-md-2" style="margin-top:15px;">
              <label>Confirm Password<font color="#FF0000">*</font></label>
              <input type="password" placeholder="Confirm Password" class="form-control" required id="pass2" / >
              <label id="warningtext" style="color:red;"></label>
            </div> 
          

      </div> 


    </div>  
  </div> 
  <div class="row" >
     <div class="form-group" style="margin-left:-5px;">
    <div class="col-md-12">
<div class="col-md-5"></div>
<button type="submit" class="btn btn-success col-md-2" id="disbalebutton">Update Password</button>
  </div></div></div>
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
<!-- END PAGE CONTENT -->
</div>
</div>

<!-- END PAGE CONTAINER -->
@stop

@section('js')

<script>
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$(document).ready( function () {


		$("#pass2").keyup(function(){  
			var pass1 = $("#pass1").val();
			var pass2 = $("#pass2").val();   
			if(pass1!=pass2)
			{
				$('#warningtext').text('Password Does Not Match');
				$('#disbalebutton').addClass('disabled');

			}
			else
			{
								$('#disbalebutton').removeClass('disabled');

				$('#warningtext').text('');

			}
			

		});
		 var err = $("#error").val();
		 if(err=='error')
        {
        var x = document.getElementById("snackbarupdate");
                             x.className = "show";
                             setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);


     }
      if(err=='success')
      {
       var x = document.getElementById("snackbarsuccess");
                             x.className = "show";
                             setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

     }
    
     
     

		

	} );

</script>
@stop