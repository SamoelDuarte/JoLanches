<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Festa de Aniversário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/upload/feijoada.jpg');
            /* Substitua 'background-image.jpg' pelo caminho da sua imagem de plano de fundo. */
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 22px 51px 0px 27px;
            color: #fff;
        }

        h1 {
            text-align: center;
            font-size: 2em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            font-size: 1.5em;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            font-size: 1.2em;
            background-color: #333;
            color: #fff;
            margin-right: 20px;
            /* Margem à direita dos campos de entrada */
        }

        #convidados {
            margin-top: 10px;
        }

        .convidado-input {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 1.2em;
            background-color: #333;
            color: #fff;
            margin-right: 20px;
            /* Margem à direita dos campos de entrada */
        }

        .add-convidado {
            background-color: #ffd700;
            color: #000;
            border: none;
            padding: 15px;
            cursor: pointer;
            font-size: 1.2em;
        }

        .image-preview {
            max-width: 100%;
            margin-top: 10px;
        }

        @import url('https://fonts.googleapis.com/css?family=Poppins:900i');

        * {
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            display: flex;
            justify-content: center;
        }

        .cta {
            display: flex;
            padding: 10px 45px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-size: 40px;
            color: white;
            background: #6225E6;
            transition: 1s;
            box-shadow: 6px 6px 0 black;
            transform: skewX(-15deg);
        }

        .cta:focus {
            outline: none;
        }

        .cta:hover {
            transition: 0.5s;
            box-shadow: 10px 10px 0 #FBC638;
        }

        .cta span:nth-child(2) {
            transition: 0.5s;
            margin-right: 0px;
        }

        .cta:hover span:nth-child(2) {
            transition: 0.5s;
            margin-right: 45px;
        }

        span {
            transform: skewX(15deg)
        }

        span:nth-child(2) {
            width: 20px;
            margin-left: 30px;
            position: relative;
            top: 12%;
        }

        /**************SVG****************/

        path.one {
            transition: 0.4s;
            transform: translateX(-60%);
        }

        path.two {
            transition: 0.5s;
            transform: translateX(-30%);
        }

        .cta:hover path.three {
            animation: color_anim 1s infinite 0.2s;
        }

        .cta:hover path.one {
            transform: translateX(0%);
            animation: color_anim 1s infinite 0.6s;
        }

        .cta:hover path.two {
            transform: translateX(0%);
            animation: color_anim 1s infinite 0.4s;
        }

        /* SVG animations */

        @keyframes color_anim {
            0% {
                fill: white;
            }

            50% {
                fill: #FBC638;
            }

            100% {
                fill: white;
            }
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #ff6600;
        }

        p {
            font-size: 18px;
            color: #000
        }

        .whatsapp-button {
            background-color: #25d366;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 20px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
       {!! $text !!}
      
       
    </div>

    <!-- Inclua o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclua a biblioteca Inputmask -->
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.js"></script>

    <script>
      
    </script>

</body>

</html>
