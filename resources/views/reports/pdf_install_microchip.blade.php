<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certifies {{ $install->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
</head>
<body>
    <table style="line-height:12px;">
        <tr>
            <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td>
            <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td>
            <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td>
            <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td> <td style="border: 0px;"></td>
            <td style="text-align:center; border: 0px;">
                <span style="font-size: 20px; font-weight: bold;">Microchip Number</span><br>
                <div style="font-weight: bold;">
                    {{ $install->install_microchip_no }}
                </div><br>
                <div>
                    <img src="{{asset('image/install_pdf.jpg')}}" height="100px"><br>{{ $install->created_at->format('M d, Y') }}
                </div>
            </td>
        </tr>
    </table>

    <table style="line-height:5px;">
        <tr>
            <td style="border: 0px; font-size: 22px; font-weight: bold; line-height:10px;">This certifies that</td>
        </tr>
        <tr>
            <td style="border: 0px;"><b>Breed (สายพันธ์)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $install->install_microchip_breed }}</td>
        </tr>
        <tr>
            <td style="border: 0px;"><b>Sex (เพศ)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 {{ $install->install_microchip_sex }}</td>
        </tr>
        <tr>
            <td style="border: 0px;"><b>Birth (วันเกิด)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 {{ $install->install_microchip_birth_date }}</td>
        </tr>
        <tr>
            <td style="border: 0px;"><b>Color (สี)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 {{ $install->install_microchip_color }}</td>
        </tr>
    </table><br>
    <table style="line-height:5px;">
        <tr>
            <td style="border: 0px; font-size: 22px; font-weight: bold;">The registered holder of the said animal is</td>
        </tr>
        <tr>
            <td style="border: 0px;"><b>Owner (เจ้าของ)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $install->install_microchip_owner_name }}</td>
        </tr>
        <tr>
            <td style="border: 0px;"><b>Address (ที่อยู่เจ้าของ)</b>
                &nbsp;&nbsp;
                    เลขที่
                    {{$install->install_microchip_owner_house_no}}
                    หมู่ที่
                    {{$install->install_microchip_owner_village_no}}
                    ซ.
                    {{$install->install_microchip_owner_lane}}
                    ถ.
                    {{$install->install_microchip_owner_road}}
                    จ.
                    {{$install->install_microchip_owner_province}}
                    อ.
                    {{$install->install_microchip_owner_amphures}}
                    @if ($install->install_microchip_owner_districts != null)
                    ต.
                    {{$install->install_microchip_owner_districts}}
                    @endif
                    {{$install->install_microchip_owner_post_no}}    
            </td>
        </tr>
        <tr>
            <td style="border: 0px;"><b>Tel. (เบอร์ติดต่อ)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $install->install_microchip_owner_tel_no }}</td>
        </tr>
    </table> 

    

</body>
</html>