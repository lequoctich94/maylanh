<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: times, arial, helvetica, sans-serif;
        }

        .sendMail-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: start;
            flex-direction: column;
        }

        .sendMail-containerImage {
            width: 100%;
            height: 100%;
        }

        .sendMail-containerImage img {
            width: 200px;
            height: 200px;
            border-radius: 3px;
            object-fit: cover;
        }

        .sendMail-containerBox {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sendMail-containerBoxTitle {
            font-size: 22px;
            color: black;
            font-weight: bold;
            line-height: 1.2;
        }

        .sendMail-containerBoxName {
            font-size: 18px;
            line-height: 1.2;
        }

        .sendMail-containerBoxDesc {
            font-size: 18px;
            line-height: 1.2;
        }

        .sendMail-containerBoxTime,
        .sendMail-containerBoxCode {
            color: rgb(49, 49, 49);
            font-weight: bold;
        }

        .nowrap {
            white-space: nowrap;
        }

    </style>

</head>

<body>
    <div class="sendMail-container">
        <div class="sendMail-containerImage">
            <img src="{{ asset('user/images/Logo.png') }}" alt="LogoPTPSTORE">
        </div>
        <div class="sendMail-containerBox">
            <span class="sendMail-containerBoxTitle"> {{ $data['title'] }} </span>
            <h5 class="sendMail-containerBoxName"> Hi {{ $data['full_name'] }},</h5>
            <span class="sendMail-containerBoxDesc nowrap"> Mã xác nhận của bạn là: <strong
                    class="sendMail-containerBoxCode">{{
                    $data['code'] }}</strong>
            </span>
            <span class="sendMail-containerBoxDesc">Mã xác nhận của bạn sẽ hết hạn lúc: <strong
                    class="sendMail-containerBoxTime">{{$data['date_time']}}</strong> </span>
        </div>
    </div>

</body>

</html>
