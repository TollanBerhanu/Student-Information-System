
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>



    <!-- CSS only -->

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- <link href="../css/bootstrap.css" rel="stylesheet"> -->

</head>

<body>

@if (Session::get('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif


<center>

</center>
@if($check==0)


    <center>

        <div style="width: 90%;height:90%; position: absolute;margin-top: 5px;margin-left:5px; border: 3px solid black;"></div>

    </center>

@elseif($check==1)

    <div style="width: 90%;height:90%; position: absolute;margin-top: 5px; border: 3px solid black;">
        <div style="width: 45%; height:90%;float: left;border-right: 3px solid black;margin-top: 10px; padding: 10px;">

            @if(! $errors->has('stud_id'))
                <table style="row-gap:5px ;">
                    <tr>
                        <td>Serial :</td>
                        <td>{{$Pcinfo['serialNo']}}</td>
                    </tr>
{{--                    <tr>--}}
{{--                        <td>Program :</td>--}}
{{--                        <td>{{$stu_prog}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>company :</td>--}}
{{--                        <td> {{$Pc_company}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Color :</td>--}}
{{--                        <td>{{$Pc_color}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Serial No :</td>--}}
{{--                        <td>{{$Pc_serial}}</td>--}}
{{--                    </tr>--}}
                </table>

            @else

                <table style="row-gap:5px ;">
                    <tr>
                        <td>Name :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Program :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>company :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Color :</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Serial No :</td>
                        <td></td>
                    </tr>
                </table>

            @endif



        </div>
        <div style="float: right;height:300px;max-width: 45%;margin-top: 10px;">
            @error('stud_id')
            <center><img src="{{ asset('images/incorrect.png') }}" width=50% style="margin: auto;"></center>
            @enderror

            @if(! $errors->has('stud_id'))
                <center><img src="{{ asset('images/login_2.jpg') }}" width=50% style="margin: auto;"></center>
                <center><img src="{{ asset('images/correct.png') }}" width=50% style="margin: auto;"></center>

            @endif
        </div>


    </div>


@else
    <center>
        <p style="color: red">Error input</p>
    </center>
@endif



</body>

</html>
