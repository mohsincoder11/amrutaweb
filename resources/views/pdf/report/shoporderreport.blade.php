<!DOCTYPE html>
<html>

<head>
    <title>Shop Order Report</title>
    <style type="text/css">
        body {
            font-size: 12px;
        }

        .ordertable {
            border-collapse: collapse;
            width: 1024px;
            text-align: center;
            background-color: #c3f7d8;
        }

        h2 {
            text-align: center;
        }


        .ordertable td {
            background-color: #fff;
            border-bottom: 1px solid #c3c9c6;
            padding-top: 2px;
            padding-bottom: 10px;
        }

        p {
            color: #454443;
        }

        .headertable {
            border-collapse: collapse;
            width: 1024px;
        }

        .headertable td {
            background-color: #fff;
            border: 1px solid #c3c9c6;
            padding-left: 10px;
        }
    </style>


</head>

<body id="contentss">
    <table class="headertable">
        <tr>
            <td style="float: left;width: 350px;"><img src="{{ asset('public/logo/avatar.jpg') }}"
                    style="height: 120px;width: 120px;"></td>
            <td>
                <p>Address :Dastur Nagar</p>
                <p>Mobile :9887788554</p>
                <p>Address :Dastur Nagar</p>
            </td>
        </tr>
    </table>
    <h3 style="text-align: center">Shop Order Report</h3>
    <p><strong>Shop: {{ ucfirst($shopname) }}</strong></p>
    <p><strong>From : {{ $fromdate }} &nbsp; To : {{ $todate }}</strong></p>
    <p><strong>Total Order : {{ $totalshoporder }}</strong></p>
    <p><strong>Total Weight : {{ $totalweight }}</strong></p>
    <p><strong>Total Amount : {{ number_format($totalAmount) }}</strong></p>


    <table class="ordertable" style="margin-top: 20px;">
        <tr style="height: 40px;text-align: left">
            <th style="width:50px;text-align: left; padding-left: 10px;height: 40px;">Order NO</th>
            <th style="width:50px;text-align: left; padding-left: 10px;height: 40px;">Order Date</th>
            <th style="width:60px;text-align: left;padding-left:10px;height: 40px;">Item</th>
            <th style="width:60px;text-align: left;padding-left:10px;height: 40px;">Weight</th>
            <th style="width:10px;text-align: left;height: 40px;">Amount</th>
        </tr>

        @foreach ($shoporder as $t)
            <tr style="height: 40px; border-bottom: 1px solid black;text-align: left">
                <td style="width:50px;padding-left:10px;height: 40px;">{{ $t->orderno }}</td>
                <td style="width:50px;padding-left:10px;height: 40px;"> {{ date('d-m-Y', strtotime($t->created_at)) }}
                </td>
                <td style="width:80px;padding-left:10px;">
                    @if (isset($t->shopOrderLists))
                        @foreach ($t->shopOrderLists as $teleorderlist1)
                            {{ $teleorderlist1->items }}
                        @endforeach
                    @endif
                </td>
                <td style="width:80px;padding-left:10px;">
                    @if (isset($t->shopOrderLists))
                        @foreach ($t->shopOrderLists as $teleorderlist1)
                            {{ $teleorderlist1->weights }} KG
                        @endforeach
                    @endif

                </td>

                <td style="width:10px;padding-left:10px;"> {{ $t->amount }}</td>
            </tr>
        @endforeach


    </table>
    <script type="text/javascript" src="{{ asset('public/js/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var printContents = document.getElementById('contentss').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        });
    </script>
</body>

</html>
