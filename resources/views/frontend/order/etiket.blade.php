<html>

<head>


    <style type="text/css">
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 125mm;
            min-height: 176mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 0.5px #D3D3D3 solid;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            height: 215mm;
        }

        .subpage2 {
            padding: 1cm;
            height: 176mm;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 125mm;
                height: 176mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        th {
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage2">
                <div style="text-align: center;">
                    <img src="https://ik.imagekit.io/dxofqajmq/Tugas_Akhir/grabme_SoK01zAMY.png?updatedAt=1686616390540" width="150px">
                    <h2>Thank You!</h3>
                        <h6>Thank You for Believing on us.</h6>
                        <p>We have recived your order. We hope there will still be further orders.</p>
                </div>
                <div style="text-center">
                    <table class="table" style="margin:auto; text-align:center;">
                        <tr>
                            <th>
                                <div class="visible-print text-center">
                                    <img width="250px" src="data:image/png;base64, {!! $qrcode !!}">
                                </div>
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <td>This is your qr-code. Use this when you want to redeem physical tickets.</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
