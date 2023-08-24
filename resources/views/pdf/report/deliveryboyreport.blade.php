<!DOCTYPE html>
<html>

<head>
    <title>Deliveryboy Report</title>
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
    <h3 style="text-align: center">Deliveryboy Report</h3>
    <p><strong>Delivery Boy: {{ ucfirst($deliveryboyid) }}</strong></p>
    <p><strong>From : {{ $fromdate }} &nbsp; To : {{ $todate }}</strong></p>
    <p><strong>Total Order : {{ $deliveryboyordercount }}</strong></p>
    <p><strong>Total Amount : {{ $totalAmount ?? 0 }}</strong></p>


    <table class="ordertable" style="margin-top: 20px;">
        <tr style="height: 40px;text-align: left">
            <th style="width:50px;text-align: left; padding-left: 10px;height: 40px;">Order NO</th>
            <th style="width:50px;text-align: left; padding-left: 10px;height: 40px;">Order Date</th>
            <th style="width:60px;text-align: left;padding-left:10px;height: 40px;">Item</th>
            <th style="width:10px;text-align: left;height: 40px;">Amount</th>
            <th style="width:10px;text-align: left;height: 40px;">Delivery Boy</th>
            <th style="width:10px;text-align: left;height: 40px;">Time Taken</th>
        </tr>

        @foreach ($deliveryboyorder as $t)
            <tr style="height: 40px; border-bottom: 1px solid black;text-align: left">
                <td style="width:50px;padding-left:10px;height: 40px;">{{ $t->orderno }}</td>
                <td style="width:50px;padding-left:10px;height: 40px;">{{ date('d-m-Y', strtotime($t->created_at)) }}
                </td>
                <td style="width:80px;padding-left:10px;">
                    {{ $t->items }}
                </td>

                <td style="width:10px;padding-left:10px;"> {{ $t->amount }}</td>
                <td style="width:10px;padding-left:10px;"> {{ $t->assignto }}</td>
                <td style="width:10px;padding-left:10px;"> {{ $t->timetaken }}</td>
            </tr>
        @endforeach

        @foreach ($apporder as $t)
            <tr style="height: 40px; border-bottom: 1px solid black;text-align: left">
                <td style="width:50px;padding-left:10px;height: 40px;">{{ $t->orderno }}</td>
                <td style="width:50px;padding-left:10px;height: 40px;">{{ date('d-m-Y', strtotime($t->created_at)) }}
                </td>
                <td style="width:80px;padding-left:10px;">
                    {{ $t->items }}
                </td>

                <td style="width:10px;padding-left:10px;"> {{ $t->amount }}</td>
                <td style="width:10px;padding-left:10px;"> {{ $t->assignto }}</td>
                <td style="width:10px;padding-left:10px;"> {{ $t->timetaken }}</td>
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
