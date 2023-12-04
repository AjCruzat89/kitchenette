<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--===============================================================================================-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--===============================================================================================-->
    <script   script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
</head>
<body>
    <div class="d-flex justify-content-center align-items-center w-100" style="background-color: black; display: flex !important; padding: 15px 0px;">
        <img style="width: 100px; height: 100px; margin: 0px auto;" src="https://scontent.fmnl22-1.fna.fbcdn.net/v/t39.30808-6/334561868_512679750821575_7965022427953609185_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeHUBKlEdhB--PNmiEXrjSSDfSIQjcfRYWZ9IhCNx9FhZv5PBzeUKVU2jd80sPeL5vSpceszX7VO3uOblH9d1zAh&_nc_ohc=wEq7bg6pe8sAX9VuCq6&_nc_ht=scontent.fmnl22-1.fna&oh=00_AfCyB07EBe6GXAVKjWpFDdrKfczdG0sdQqtdau3o2TPj7A&oe=656831D6" alt="" />
    </div>
    
    <div class="py-3"> 
      <h1>Dear {{ $username }},</h1>
      <p>Reset your password with the link provided</p>
      <a href="{{ route("resetPasswordPage", ['token' => $token]) }}">Reset Password</a>
    </div>
    
</body>
</html>
