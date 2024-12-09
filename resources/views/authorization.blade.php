<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VIVT Volunteer</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
      body {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          margin: 0;
          background-color: #f9f9f9;
          font-family: 'Helvetica', sans-serif;
      }

      .container {
          width: 400px;
          background: white;
          padding: 40px;
          border-radius: 10px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          text-align: center;
      }

      h1 {
          font-size: 24px;
          font-weight: 600;
          color: #333;
          margin-bottom: 20px;
      }

      input[type="text"], input[type="password"] {
          width: 100%;
          padding: 12px;
          border: 1px solid #ddd;
          box-sizing: border-box;
          border-radius: 0;
      }

      input[type="text"] {
          border-top-left-radius: 15px;
          border-top-right-radius: 15px;
          border-bottom: none;
      }

      input[type="password"] {
          border-bottom-left-radius: 15px;
          border-bottom-right-radius: 15px;
      }

      input::placeholder {
          color: #aaa;
      }

      .btn-primary {
          width: 100%;
          padding: 12px;
          background: #1C4BAA;
          border: none;
          color: white;
          font-size: 16px;
          border-radius: 15px;
          cursor: pointer;
          transition: background-color 0.3s;
          margin-top: 20px;
      }

      .btn-primary:hover {
          background: #133477;
      }

      .btn-secondary {
          background: none;
          border: none;
          color: #1C4BAA;
          font-size: 14px;
          cursor: pointer;
          padding: 0;
      }

      .btn-group {
          display: flex;
          justify-content: space-between;
          margin-top: 10px;
      }

      .alert-danger {
        margin-top: 20px;
        padding: 10px;
        border-radius: 15px;
      }

  </style>
</head>
<body>
  <div class="container">
      <h1>VIVT Volunteer</h1>
      <form method="POST" action="{{ route('authorization') }}">
            @csrf
            <input type="text" id="email" name="email" placeholder="Почта" required>
            <input type="password" id="password" name="password" placeholder="Пароль" required>

            <!-- Кнопки "Регистрация" и "Забыли пароль?" -->
            <div class="btn-group">
                <a href="/registration" class="btn-secondary text-decoration-none">Регистрация</button>
                <a href="/" class="btn-secondary text-decoration-none">Забыли пароль?</button>
            </div>

            <!-- Кнопка "Войти" -->
            <button type="submit" class="btn-primary">Войти</button>
            <!-- Сообщения об успехе или ошибке -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif
      </form>
  </div>
</body>
</html>
