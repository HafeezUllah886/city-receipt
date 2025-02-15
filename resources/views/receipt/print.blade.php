<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style>
        body{
            background: rgb(232, 232, 232);
            font-size: 15px;
            font-family: "Helvetica";
        }
        .main{
            width: 80mm;
            background: #fff;
            overflow: hidden;
            margin: 0px auto;
            padding: 10px;
        }
        .logo{
            width: 100%;
            overflow: hidden;
            height: 130px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo img{
            width:100%;
        }
        .header p{
            margin: 2px 0px;
        }
        .content{
            overflow: hidden;
            width: 100%;
        }
        .content table{
            width: 100%;
            border-collapse: collapse;
        }

        .bg-dark{
            background: black;
            color:#ffff;
        }

        .text-left{
            text-align: left !important;
        }
        .text-right{
            text-align: right !important;
        }
        .text-center{
            text-align: center !important;
        }
        .area-title{

            font-size: 18px;
        }
        tr.bottom-border {
            border-bottom: 1px solid #ccc; /* Add a 1px solid border at the bottom of rows with the "my-class" class */
        }
        .uppercase{
            text-transform: uppercase;
        }
        .capitalize {
  text-transform: capitalize;
}
    </style>
</head>
<body>
    <div class="main" id="main">
        <div class="logo">
            <table width="100%">
                <tr>
                    {{-- <td width="30%">
                        <img src="{{ asset('assets/images/mono.png') }}" alt="">
                    </td> --}}
                    <td>
                        <h2 style="margin: 0px">DR ABDUL BARI KAKAR</h2>
                        <h5 style="margin: 0px">MBBS MCPS FCPS (PAK)</h5>
                        <h5 style="margin: 0px">MRCSEd (Ophth), FRCS (UK)</h5>
                    </td>
                </tr>
            </table>
           
        </div>
        <div class="header">
            
            <p class="text-center" style="font-size: 40px;"><strong>Token # {{$receipt->token_number}}</strong></p>
            <p class="text-center" style="font-size: 20px;"><strong>Time - {{$receipt->event_time}}</strong></p>
            <div class="area-title">
                <p class="text-center bg-dark uppercase">{{$receipt->type}}</p>
            </div>
            <p class="text-center"><strong>
                Patient Copy
            </strong></p>
            <table>
                <tr>
                    <td width="25%">Receipt#</td>
                    <td width="25%"> {{$receipt->id}} </td>
                    <td width="20%">Date: </td>
                    <td width="30%"> {{date('d M Y', strtotime($receipt->date))}} </td>
                </tr>
                <tr>
                    <td> Patient: </td>
                    <td colspan="3"> {{$receipt->pName}} </td>
                </tr>
                <tr>
                    <td> Gender: </td>
                    <td colspan="3"> {{$receipt->gender}} </td>
                </tr>
                <tr>
                    <td> Contact: </td>
                    <td colspan="3"> {{$receipt->contact}} </td>
                </tr>
                <tr>
                    <td> CNIC #: </td>
                    <td colspan="3"> {{$receipt->cnic}} </td>
                </tr>
              {{--   <tr style="border-top:1px dotted black;">
                    <td> Consultant: </td>
                    <td colspan="3"> {{$receipt->consultant}} </td>
                </tr> --}}
            </table>
        </div>
        <div class="content">
            <table width="100%s">
                <thead class="bg-dark">
                    <th class="text-left" width="80%">Description</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    @foreach ($receipt->details as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                        <td class="text-right">{{number_format($item->fee)}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-right">Total</th>
                        <th class="text-right">{{number_format($receipt->details->sum('fee'))}}</th>
                    </tr>
                    <tr>
                        <th colspan="2" class="capitalize">Rupees {{$numberInWords}} Only</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <p>Notes: {{$receipt->desc}}</p>
        <p>Generated By: {{$receipt->user->name}}</p>
        <div class="footer">
            <hr>
            <h5 class="text-center"> برائے مہربانی کسی بھی شکایت/مشورے کے لیے سجاد صادق سے رابطہ کریں <br> </h5>
            <h5 class="text-center">For Query / Advice Please Contact Sajjad Sadiq Optometrist Contact # 0334-2424884, 081-2823558, 081-2843344 <br> </h5>
            <h5 class="text-center">نمبر لینے کیلے رابطہ کریں<br>  0321-8074408, 0332-2424484
                081-2823558</h5>
            <h5 class="text-center"> Thank You for Visiting Eye Department City International Hospital</h5>
            <hr>
            <h5 class="text-center">Software Developed By NexgenPakistan</h5>
        </div>
    </div>
</body>
</html>
<script src="{{ asset('src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
setTimeout(function() {
    window.print();
    }, 2000);

        setTimeout(function() {
            window.open('{{ url("receipt/print1/") }}/'+'{{$receipt->id}}', "_self");
    }, 5000);

</script> 