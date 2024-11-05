<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIVT.Волонтёр</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"  style="padding: 20px; margin: 10px;">
      <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
        <img src="http://vivt-volunteer.online.swtest.ru/icons/main_icon.png" width="300">
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto align-items-center">
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">
            <img src="http://vivt-volunteer.online.swtest.ru/icons/profile_icon.png" width="25" alt="Личный кабинет">
            <span>Личный кабинет</span>
        </a>
      </nav>
    </div>

@yield('content')

</body>
</html>