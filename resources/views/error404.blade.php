<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="{{asset('public/logo/avatar.jpg')}}" type="image/x-icon" />

  <title>404 | Page Not Found</title>
  <style>
    body {
      background-color: #dce6e0;
      overflow: hidden;
    }

    .bug {
      margin-left: -100px;
      transform: rotate(-360deg);
      width: 100px;
      height: 50px;
      position: absolute;
      animation: bee 8s linear infinite both;
    }

    .bee1 {
      width: 40px;
      height: 40px;
      border-radius: 20px;
      background-color: #FFC107;
      position: absolute;
      left: 50px;
      top: 50px;
      z-index: 6;
    }

    .bee2 {
      width: 40px;
      height: 40px;
      border-radius: 20px 18px 20px 18px;
      background-color: #FFC107;
      position: absolute;
      left: 30px;
      top: 50px;
      z-index: 4;

    }

    .black {
      width: 40px;
      height: 40px;
      border-radius: 20px 18px 20px 18px;
      background-color: black;
      position: absolute;
      left: 40px;
      top: 50px;
      z-index: 5;

    }

    .eye {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background-color: black;
      position: absolute;
      right: 10px;
      top: 10px;
      z-index: 6;
      animation: eye 0.5s 2.2s 2 linear;
    }

    .wing {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #BBDEFB;
      position: absolute;
      right: 10px;
      top: -15px;
      z-index: 2;
      border: 0.5px solid #90CAF9;
      animation: wings 1s linear infinite;
    }

    .wing2 {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #BBDEFB;
      position: absolute;
      right: 0;
      top: -15px;
      border: 0.5px solid #90CAF9;
      z-index: 1;
      animation: wings2 1s linear infinite;
    }

    @keyframes bee {
      0% {
        transform: rotate(0deg);
        margin-left: -100px;
        margin-top: 50px;
      }

      10% {
        transform: rotate(-10deg);
        margin-left: 100px;
        margin-top: 80px;
      }

      20% {
        transform: rotate(-20deg);
        margin-left: 200px;
        margin-top: 80px;
      }

      50% {
        margin-left: 500px;
        margin-top: 50px;
        transform: rotate(-360deg);
      }

      60% {
        margin-left: 600px;
        margin-top: 60px;
        transform: rotate(-360deg);
      }

      100% {
        margin-left: 900px;
        margin-top: 80px;
      }
    }

    @keyframes wings {
      20% {
        right: 12px;
      }

      30% {
        right: 8px;
      }

      40% {
        right: 12px;
      }

      50% {
        right: 8px;
      }

      60% {
        right: 12px;
      }

      70% {
        right: 8px;
      }

      80% {
        right: 12px;
      }

      90% {
        right: 8px;
      }
    }

    @keyframes wings2 {
      20% {
        right: -2px;
      }

      30% {
        right: 2px;
      }

      40% {
        right: -2px;
      }

      50% {
        right: 2px;
      }

      60% {
        right: -2px;
      }

      70% {
        right: 2px;
      }

      80% {
        right: -2px;
      }

      90% {
        right: 2px;
      }
    }

    @keyframes eye {
      0% {
        width: 5px;
        height: 5px;
      }

      10% {
        width: 0;
        height: 0;
      }

      40% {
        width: 5px;
        height: 5px;
      }

      50% {
        width: 5px;
        height: 5px;
      }

      100% {
        width: 5px;
        height: 5px;
      }
    }

    .p1 {
      font-family: "Lucida Console", Courier, monospace;
      font-size: 90px;
      font-weight: bold;
      letter-spacing: 10px;
      color: #454746;
      display: block;
    }

    .p2 {
      font-size: 30px;
      font-weight: bold;
      letter-spacing: 2px;
      color: #454746;
      display: block;
    }

    .p3 a {
      border: 1px solid #000;
      border-radius: 5%;
      padding: 10px 30px;
      text-decoration: none;
      font-weight: bold;
      font-size: 14px;
      letter-spacing: 1px;
      transition: transform .9s ease-out;
      color: #e3ae0e;


    }

    .p3 a:hover {
      background-color: #323333;
      color: #fff;
      transform: scale(1.02);
      transition: transform .9s ease-out;

    }
    .subcontainer{
      padding-top: 20%;
      text-align: center;
      display: block;
  margin: auto;
   }
  </style>

</head>

<body>
  <div class="bug">
    <div class="bee1">
      <div class="eye"></div>
    </div>
    <div class="bee2">
      <div class="wing"></div>
      <div class="wing2">

      </div>
    </div>
    <div class="black"></div>
  </div>

  <div class="subcontainer">
    <p class="p1">404</p>
    <p class="p2">Page Not Found</p>
    <p class="p3"><a href="{{ url()->previous() }}"> Home</a></p>

  </div>
</body>

</html>