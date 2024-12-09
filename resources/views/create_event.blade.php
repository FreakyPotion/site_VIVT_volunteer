<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новое событие</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f9f9f9;
            font-family: 'Helvetica', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin: 0; /* Убираем отступы между блоками */
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            outline: none;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        /* Убираем скругления для всех полей ввода */
        input, textarea {
            border-radius: 0;
        }

        /* Добавляем скругление для "Название" */
        #event-name {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        /* Добавляем скругление для "Описание" */
        #description {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background: #1C4BAA; /* Градиент */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px; /* Увеличиваем отступ сверху */
        }

        .btn-submit:hover {
            background: #133477; /* Темный градиент при наведении */
        }

        .image-upload {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            background-color: #e9ecef;
            border: 2px dashed #ccc;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px; /* Увеличиваем отступ снизу */
        }

        .image-upload img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload .placeholder {
            color: #999;
            font-size: 16px;
        }

        .address-fields {
            display: flex;
            justify-content: space-between; /* Отступы между полями */
        }

        .address-fields input {
            flex: 1; /* Все поля равной ширины */
            margin-right: 0px; /* Отступ между полями */
        }

        .address-fields input:last-child {
            margin-right: 0; /* Убираем отступ у последнего поля */
        }

        .button-back-row-cr {
        display: flex;
        align-items: flex-start;
        font-size: 16px;
        font-weight: bolder;
        margin-bottom: 20px;
      }

      .button-back-container-cr {
        display: flex;
        align-items: center;
        text-align: center;
      }

      .button-back-container-cr img {
        height: 13px;
        padding-right: 5px;
      }

      .button-back-img-cr {
        width: 15px;
      }

      .button-back-text-cr {
        color: #1C4BAA;
        text-decoration: none;
        cursor: pointer;
      }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="button-back-row-cr">
            <a onclick="history.back()" class="button-back-text-cr">
            <div class="button-back-container-cr">
                <img class="button-back-img-cr" src="/storage/icons/back_icon.png">
                <span>Назад</span>
            </div>
            </a>
        </div>
        <h1>Новое событие</h1>
        <form action="{{ route('create.event.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="image-upload" id="imageUpload">
                    <img id='preview_image'style='width: 100%'>
                    <span id="placeholder_img" class="placeholder" style="al">Нажмите, чтобы загрузить</span>
                    <input type="file" accept="image/*" id="fileInput" name="image">
                </div>
            </div>
            <div class="form-group">
                <input type="text" id="event-name" name="name" placeholder="Введите название" required>
            </div>
            <div class="form-group">
                <div class="address-fields">
                    <input type="text" name="city" placeholder="Город" required>
                    <input type="text" name="street" placeholder="Улица" required>
                    <input type="text" name="house" placeholder="Дом" required>
                </div>
            </div>
            <div class="form-group">
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <input type="number" id="max-participants" name="max_participants" placeholder="Максимум участников" required>
            </div>
            <div class="form-group">
                <textarea id="description" name="description" placeholder="Введите описание" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Создать событие</button>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const placeholder = document.getElementById('placeholder_img');
        const preview = document.getElementById('preview_image');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                // Проверка типа файла
                if (!file.type.startsWith('image/')) {
                    alert('Пожалуйста, выберите файл изображения!');
                    return;
                }

                // Проверка размера файла (например, до 8 МБ)
                const maxSize = 8 * 1024 * 1024; // 8MB
                if (file.size > maxSize) {
                    alert('Размер файла не должен превышать 8 МБ!');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    // Если изображение уже загружено, удаляем старое
                    if (preview.src || preview.src.trim() == '') {
                        preview.src = '';
                    }

                    //const img = document.createElement('img');
                    preview.src = e.target.result;
                    preview.alt = 'Загруженное изображение';
                    preview.style.maxWidth = '100%';
                    placeholder.hidden = true;

                };

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
