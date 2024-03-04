<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Codify platform - Réinitialisation de mot de passe</title>
        <style>
        body{
            letter-spacing: 0.7px;
            background-color: #eee;
            width: 50%;
            height: 30%;
        }

        .container{
            margin-top: 120px;
            margin-bottom: 120px;
        }

        .btn-lg, a:focus, a:active {
            outline: none !important;
            box-shadow: none !important;
        }

        .card-1{
            box-shadow: 2px 4px 15px 0px #a41034;
        }

        p{
            font-size: 13px ;
        }

        .small{
            font-size: 9px !important;
        }

        .cursor-pointer{
            cursor: pointer;
        }

        .btn-round-lg {
            border-radius: 22.5px;
            background-color: #eee;
            color: #a41034;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.9px;
            padding: 8px 20px  8px  20px !important;
            border: 1px solid #fff;
        }

        .btn-round-lg:hover{
            background-color: #fff;
            color: #a41034;
            border: 1px solid #fff;
        }

        .btn-round-lg:focus{
            border: 1px solid #fff !important;
        }

        .card{
            background-color: #a41034 !important;
            color: white;
        }
    </style>
</head>
<body>
    <div class="col-12 container">
        <div class="alert bg-success mb-5 py-4" role="alert">
           <div class="d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                    <path d="M22 5.08V19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5.08a2 2 0 0 1 .293-1.105l9.023 8.724a1 1 0 0 0 1.353 0l9.023-8.724A2 2 0 0 1 22 5.08z"></path>
                </svg>
              <div class="px-3">
                 <h5 class="alert-heading">Réinitialisation de mot de passe</h5>
                 <p>Pour réinitialiser votre mot de passe,veillez cliquer sur le lien ci-aprés:</p>
                 <button type="button" class="btn btn-primary btn-round-lg btn-lg"><a href="{{ route('reset.password.get', $token) }}">Réinitialiser</a></button>
              </div>
           </div>
        </div>
     </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

</body>
</html>
