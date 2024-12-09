<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчет о событии</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .image-preview img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 15px;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            margin: 0;
            background-color: #f9f9f9;
            font-family: 'Helvetica', sans-serif;
        }

        .events-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .button {
            margin-bottom: 30px;
            border-radius: 15px;
            background: #1C4BAA;
            margin-left: 270px; 
        }

        .button:hover {
            background: #133477;
        }

        .need {
            border-radius: 15px;
        }

        .text-muted {
            margin-left: 15px;
        }

        .mb-4 {
            margin-left: 200px;
        }

    </style>
</head>
<body>
    <div class="events-container">
        <div class="container mt-5">
            <h1 class="mb-4">Отчет о событии</h1>
            <form method="POST" action="{{ route('report.create', ['id' => $eventid]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="event-text" class="form-label">Сообщение:</label>
                    <textarea id="event-text" name="event_text" class="form-control need" rows="4" maxlength="500" required></textarea>
                </div>

                <div class="mb-3">
                    <input 
                        type="file" 
                        id="images" 
                        name="images[]" 
                        class="form-control need" 
                        accept="image/*" 
                        multiple 
                        onchange="previewImages(this)">
                    <small class="text-muted">Можно загрузить до 9 изображений.</small>
                </div>

                <div id="image-preview" class="image-preview"></div>

                <button type="submit" class="btn btn-primary mt-3 button">Завершить событие</button>
            </form>
        </div>
    </div>

    <script>
        function previewImages(input) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Очищаем предыдущий превью
            const files = input.files;

            if (files.length > 9) {
                alert('Можно загрузить максимум 9 изображений!');
                input.value = ''; // Сбрасываем выбор файлов
                return;
            }

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

    <script>
        const textarea = document.getElementById('event-text');

        // Функция для автоматического изменения высоты
        function autoResize() {
            textarea.style.height = 'auto'; // Сбрасываем высоту
            textarea.style.height = textarea.scrollHeight + 'px'; // Устанавливаем высоту по содержимому
        }

        // Обработка события ввода
        textarea.addEventListener('input', autoResize);
    </script>
</body>
</html>
