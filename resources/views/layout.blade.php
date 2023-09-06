<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META SECTION -->
  <title>Amruta's Fresh Farm Chicken</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="UTF-8" />

  <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

  <link rel="icon" href="{{asset('public/logo/avatar.jpg')}}" type="image/x-icon" />
  <!-- END META SECTION -->

  <!-- CSS INCLUDE -->
  <link rel="stylesheet" type="text/css" id="theme" href="{{asset('public/css/theme-default.css')}}" />

  <link rel="stylesheet" type="text/css" id="theme" href="{{asset('public/css/notification.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
  <link href="{{asset('public/css/snackalert.css')}}" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.css"/>
  

  <!-- EOF CSS INCLUDE -->
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      font-size: 100%;
      line-height: 1.5;
      font-family: "Roboto Condensed", sans-serif;
    }

    .homepage_card .dashboard_icon:hover {
      transform: scale(1.5);
    }

    .homepage_card {
      padding: 2% 2% 0 2%;
      border-radius: 10px;
      box-shadow: rgba(100, 100, 111, 0.4) 0px 7px 29px 0px;
      transition: all 0.8s ease-in-out;

    }

    .homepage_card:hover {
      transform: scale(1.05);
      transition: all 0.8s ease-in-out;

      border: 1px solid #d4d4d4;
      box-shadow: rgba(0, 0, 0, 0.3) 0px 15px 15px; 
    
    }

    .category_name {
      font-size: 0.5em;
      display: block;
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
      font-weight: bold;
    }

    .dashboard_icon {
      transition: all 0.8s ease-in-out;
      font-size: 0.9em !important;
    }

    .project_count {
      font-size: 0.5em;
      font-weight: 900;
      margin: 0;
      display: inline-block;

    }

    .benefitiary_card {
      background-image: linear-gradient(#a0299c, #721b6f, #5e155b);
    }

    .app_card {
      background-image: linear-gradient(#5b82ff, #2947a7, #0d2d93);
    }

    .hdfc_card {
      background-image: linear-gradient(#5bdfd6, #38aba3, #158d85);
    }

    .agri_card {
      background-image: linear-gradient(#e6624e, #e3462d, #be3823);

    }

    .marketting_card {
      background-image: linear-gradient(#f1f135, #c9c92c, #8b8b1a);
    }

    .dairy_card {
      background-image: linear-gradient(#58e039, #3eb324, #2e8f19);
    }

    .poultry_card {
      background-image: linear-gradient(#4ca392, #30665b, #176959);
    }

    .jys_card {
      background-image: linear-gradient(#3456dd, #2942a6, #1d307a);
    }

    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }

    .group {
      &:after {
        content: "";
        display: table;
        clear: both;
      }
    }


    img {
      max-width: 100%;
      height: auto;
      vertical-align: baseline;
    }

    a {
      text-decoration: none;
    }

    .max(@maxWidth;

      @rules) {
      @media only screen and (max-width: @maxWidth) {
        @rules();
      }
    }

    .min(@minWidth;

      @rules) {
      @media only screen and (min-width: @minWidth) {
        @rules();
      }
    }

    .container {
      max-width: 400px;
      margin: 1em auto;
      padding: 1em;
    }

    fieldset {
      border: 1px solid #999;
      background: #ddd;
      display: block;
      padding: 16px;
      margin: 10px 10px 0 10px;
    }

    input {
      padding: 8px;
      border-radius: 2px;
      border: 1px solid #999;
    }

    input[type="submit"] {
      background-image: linear-gradient(#333 0%, #222 100%);
      color: #fff;
      border: 1px solid #222;
      margin-left: 10px;
    }

    .xm-fieldset:first-of-type a {
      display: none;
    }

    .decommission {
      color: tomato;
      display: inline-block;
      line-height: 1;
      vertical-align: baseline;
    }

    a#factory {
      border: 1px solid #000;
      padding: 8px 16px;
      margin: 16px;
      display: table;
      color: white;
      background: #333;
      border-radius: 3px;

      &:hover {
        background-image: linear-gradient(#444 0%, #222 100%);
        box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.45);
      }

      &:active {
        background-image: linear-gradient(#222 0%, #444 100%);
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.45);
      }
    }

    .cancelmodel {
      display: none;
      position: fixed;
      z-index: 1;
      padding-top: 100px;
      left: 0;
      top: 0;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      padding-bottom: 8vh;
      border: 1px solid #888;
      width: 100%;
      border-radius: 4px;

    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    .notification {
      color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .notification::after {
      min-width: 20px;
      height: 20px;
      content: attr(data-count);
      background-color: #ed657d;
      font-family: monospace;
      font-weight: bolt;
      font-size: 14px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      position: absolute;
      top: -16px;
      left: 7px;
      transition: .3s;
      opacity: 0;
      transform: scale(.5);
      will-change: opacity, transform;
    }

    .notification.show-count::after {
      opacity: 1;
      transform: scale(1);
    }

    .notification::before {
      content: "\f0f3";
      font-family: "FontAwesome";
      display: block;
    }

    .notification.notify::before {
      animation: bell 1s ease-out;
      transform-origin: center top;
    }

    @keyframes bell {
      0% {
        transform: rotate(35deg);
      }

      12.5% {
        transform: rotate(-30deg);
      }

      25% {
        transform: rotate(25deg);
      }

      37.5% {
        transform: rotate(-20deg);
      }

      50% {
        transform: rotate(15deg);
      }

      62.5% {
        transform: rotate(-10deg)
      }

      75% {
        transform: rotate(5deg)
      }

      100% {
        transform: rotate(0);
      }
    }


    /*loader*/

    .loader {
      position: fixed;
      left: 45%;
      top: 45%;
      width: 200px;
      height: 200px;
      z-index: 9999;

    }

    .loaderp {
      position: fixed;
      left: 46%;
      color: #fff;
      top: 54%;
      font-size: 17px;
      color: #464747;
    }

    .loaderpage {
      position: fixed;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      background: rgba(255, 255, 255, 01);
      z-index: 10;
    }

    .itemimage {
      height: 40px;
      width: 50px;
      transition:1s ease-in-out;
    }  
    
    .itemimage:hover {
    transform:scale(4);
    transition:0.5 ease-in-out;
    }

    .timeslotlable {
      color: #2e2d2d;
      font-weight: bold;
      letter-spacing: 0px;
      font-size: 12px;
    }


    .loader2 {
  width: 60px;
  margin-left: 30%; 

}

.loader-wheel {
  animation: spin 1s infinite linear;
  border-top: 8px solid blue;
  border-right: 8px solid green;
  border-bottom: 8px solid red;
  border-left: 8px solid rgb(252, 241, 18);
    border-radius: 50%;
    margin-bottom: 10px;
    width: 50px;
    height: 50px;
    /* position: absolute;
    top: 75%;*/
}

.loader-text {
  color: #fff;
  font-family: arial, sans-serif;
}

.loader-text:after {
  content: 'Loading';
  animation: load 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes load {
  0% {
    content: 'Loading';
  }
  33% {
    content: 'Loading.';
  }
  67% {
    content: 'Loading..';
  }
  100% {
    content: 'Loading...';
  }
}
  </style>
  <style>
    .switchss {
      position: relative;
      display: block;
      vertical-align: top;
      width: 100px;
      height: 30px;
      padding: 3px;
      margin: 0 10px 10px 0;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
      border-radius: 18px;
      box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
      cursor: pointer;
      box-sizing: content-box;
    }

    .switch-input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      box-sizing: content-box;
    }

    .switch-label {
      position: relative;
      display: block;
      height: inherit;
      font-size: 10px;
      text-transform: uppercase;
      background: #db4932;
      border-radius: inherit;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
      box-sizing: content-box;
    }

    .switch-label:before,
    .switch-label:after {
      position: absolute;
      top: 50%;
      margin-top: -.5em;
      line-height: 1;
      -webkit-transition: inherit;
      -moz-transition: inherit;
      -o-transition: inherit;
      transition: inherit;
      box-sizing: content-box;
    }

    .switch-label:before {
      content: attr(data-off);
      right: 11px;
      color: #fff;
      font-size: 7px;
      text-shadow: 0 1px rgba(255, 255, 255, 0.5);
    }

    .switch-label:after {
      content: attr(data-on);
      left: 11px;
      color: #FFFFFF;
      text-shadow: 0 1px rgba(0, 0, 0, 0.2);
      opacity: 0;
    }

    .switch-input:checked~.switch-label {
      background: #2db01c;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .switch-input:checked~.switch-label:before {
      opacity: 0;
    }

    .switch-input:checked~.switch-label:after {
      opacity: 1;
    }

    .switch-handle {
      position: absolute;
      top: 4px;
      left: 4px;
      width: 28px;
      height: 28px;
      background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
      background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
      border-radius: 100%;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    }

    .switch-handle:before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -6px 0 0 -6px;
      width: 12px;
      height: 12px;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
      border-radius: 6px;
      box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
    }

    .switch-input:checked~.switch-handle {
      left: 74px;
      box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
    }

    /* Transition
========================== */
    .switch-label,
    .switch-handle {
      transition: All 0.6s ease;
      -webkit-transition: All 0.6s ease;
      -moz-transition: All 0.6s ease;
      -o-transition: All 0.6s ease;
    }

    .form-control[disabled],
    .form-control[readonly] {
      color: #333;
      font-size: 13px;
    }
    .buttons-excel{
      margin:1rem 0.5rem 1rem 0 !important;
      background-color:#0d6efd!important;
      color: #fff !important;
      border-radius:3px !important;
      border: 1px solid #0d6efd !important;
    }
    .buttons-pdf{
      margin:1rem 0 !important;
      background-color:#ffc107!important;
      color: #fff !important;
      border-radius:3px !important;
      border: 1px solid #ffc107 !important;

    }
    .d-none{
      display: none;
    }
  </style>
  @yield('css')
 
</head>

<body>
  <!-- START PAGE CONTAINER -->
  <div class="page-container page-navigation-top">
    <!-- PAGE CONTENT -->
    <div class="page-content">
      @php $userdata=Session::get('userdata');
      @endphp

      <!-- START X-NAVIGATION VERTICAL -->
      <ul class="x-navigation x-navigation-horizontal">
        <li class="xn-logo" style="margin-right:30px;">
          <a href="{{route('home')}}"> <img src="{{asset('public/logo/logo.png')}}" alt="" style="margin-top:-15px;" /></a>
          <a href="#" class="x-navigation-control"></a>
        </li>




        @if($userdata['role']==1)

        <li class="xn-openable">
          <a href="{{route('home')}}" title="Admin Dashboard"><span class="fa fa-home"></span>Home</a>
        </li>

        @endif
        @if($userdata['master']!=0 || $userdata['role']==1)

        <li class="xn-openable">
          <a href="{{route('addcustomer')}}" title="Master Entries"><span class="fa fa-list"></span>Masters</a>
        </li>
        @endif
        @if($userdata['role']==1)

        <li class="xn-openable">
          <a href="{{route('usermanage')}}" title="Users Management"><span class="fa fa-user"></span>User Management</a>
        </li>
        @endif
        @if($userdata['telecaller']!=0 || $userdata['role']==1)

        <li class="xn-openable">
          <a href="{{route('bookorder')}}" title="Telecaller's Panel"><span class="fa fa-phone"></span>Telecaller Panel</a>
        </li>
        @endif
        @if($userdata['shop']!=0 || $userdata['role']==1)

        <li class="xn-openable">
          <a href="{{route('shoporder')}}" title="Shop's Panel"><span class="fa fa-bank"></span>Shop Panel</a>
        </li>
        @endif
        @if($userdata['report']!=0 || $userdata['role']==1)

        <li class="xn-openable">
          <a href="{{route('allorderreport')}}" title="Various Reports"><span class="fa fa-file"></span>Reports</a>
        </li>
        @endif
        <!--  @if($userdata['role']==1 || $userdata['role']==5)
                  
                      <li class="xn-openable">
                        <a href="{{route('gtognew')}}" title="Various Reports"><span class="fa fa-exchange"></span>Live Bird Transfer</a>
                    </li>
                    @endif -->
        @if($userdata['role']==1 || $userdata['role']==5)


        <li class="xn-openable">
          <a href="{{route('grn')}}" title="Various Reports"><span class="fa fa-plus-square-o"></span>Godawn</a>
        </li>
        @endif





        <li class="xn-openable " style="padding-right: 100px;float: right">
          <a href="#" title="Out Patient Department"><span class="fa fa-user"></span><strong>
              {{ucfirst($userdata['username'])}}

            </strong>
          </a>
          <ul>
            <li>
              <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Log Out</a>
            </li>
            <li>
              <a href="{{url('changepassword')}}"><span class="fa fa-file-text"></span>Change Password</a>
            </li>
            @if($userdata['role']==1)
            <li>
              <a href="{{url('databackup')}}"><span class="fa fa-database"></span>Backup Data</a>
            </li>
            @endif

          </ul>
        </li>

      </ul>
      <!-- END X-NAVIGATION -->

      @yield('content')

      <!-- PAGE CONTENT WRAPPER -->


      <!-- MESSAGE BOX-->
      <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
          <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
              <p>Are you sure you want to log out?</p>
              <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
              <div class="pull-right">
                <a href="{{route('logout')}}" class="btn btn-success btn-lg">Yes</a>
                <button class="btn btn-default btn-lg mb-control-close">No</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- END MESSAGE BOX-->

  <!-- START PRELOADS -->
  <audio id="audio-alert" src="{{asset('public/audio/alert.mp3')}}" preload="auto"></audio>
  <audio id="audio-fail" src="{{asset('public/audio/fail.mp3')}}" preload="auto"></audio>
  <!-- END PRELOADS -->

  <!-- START SCRIPTS -->
  <script type="text/javascript" src="{{asset('public/js/plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/jquery/jquery-ui.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
  <!-- END PLUGINS -->

  <!-- THIS PAGE PLUGINS -->
  <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>



  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/bootstrap/bootstrap-timepicker.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/bootstrap/bootstrap-colorpicker.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>


  <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>


  <script type="text/javascript" src="{{asset('public/js/plugins/dropzone/dropzone.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/fileinput/fileinput.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins/filetree/jqueryFileTree.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/plugins.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/js/actions.js')}}"></script>
  <!-- END TEMPLATE -->

  <script src="{{asset('public/css/sweetalert.min.js')}}"></script>
  <script src="{{asset('public/js/jquery.validate.min.js')}}"></script>
   <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
   <script scr="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
  <script>
    $(document).ready(function() {



      $(function() {
        $("#file-simple").fileinput({
          showUpload: false,
          showCaption: false,
          browseClass: "btn btn-danger",
          fileType: "any"
        });
        $("#filetree").fileTree({
          root: '/',

          expandSpeed: 100,
          collapseSpeed: 100,
          multiFolder: false
        }, function(file) {
          alert(file);
        }, function(dir) {
          setTimeout(function() {
            page_content_onresize();
          }, 50);
        });
      });
    });
  </script>
  @yield('js')
</body>

</html>