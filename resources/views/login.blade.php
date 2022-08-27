<!DOCTYPE html>
<html>
<html lang="en">

<head>
  <title>Amruta Chicken</title>
  <link rel="icon" href="{{asset('public/logo/avatar.jpg')}}" type="image/x-icon" />

  <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/logincss.css')}}">
  <style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
      -webkit-text-fill-color: white;
      -webkit-box-shadow: 0 0 0px 1000px transparent inset;
      font-size: 16px;

      transition: background-color 5000s ease-in-out 0s;
    }
  </style>
</head>

<body>
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-8"></div>
      <div class="col-sm-4">
        <div class="alert alert-danger alert-dismissible" role="alert" id="errormsg">
          <strong>Error!</strong> Check Username or Password.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="login-box">
    <?php $error = Session::get('error'); ?>
    <input type="hidden" name="error" id="error" value="{{$error ?? '0'}}">
    <h2> Amruta's Chicken</h2>
    <form action="{{url('checklogin')}}" method="post" name="form" autocomplete="off">
      @csrf

      <div class="user-box">
        <input type="text" name="username" id="username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" id="password" name="password" required="">
        <label>Password</label>
      </div>
      <button type="submit">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit
      </button>
    </form>
  </div>
  <script src="{{asset('public/css/jquery.min.js')}}"></script>
  <script src="{{asset('public/css/bootstrap.min.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      //$('#errormsg').hide()
      var err = $("#error").val();
      if (err == 1) {
        $('#errormsg').fadeOut(4000);
      }
      if (err == 0) {
        $('#errormsg').hide();
      }

    });
  </script>
</body>

</html>