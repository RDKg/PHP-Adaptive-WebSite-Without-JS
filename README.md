# Сайт на PHP без JavaScript.

## НАСТРОЙКА

### Установка PHP:
1. Установите ZIP-файл (https://windows.php.net/downloads/releases/php-8.3.2-nts-Win32-vs16-x64.zip)
2. Разархивируйте его в "**C:\\**"
3. Перейдите в переменные среды компьютера. (Пуск -> Напишите "**Изменение системных переменных среды**" -> Нажмите на "**Переменные среды**" -> В секции "**Переменные среды пользователя для ИМЯ_ПОЛЬЗОВАТЕЛЯ**" нажмите 2 раза на поле "**Path**" -> Нажмите "**Создать**" -> Вставьте путь до каталога с php "**C:\\php**"

### Настройка PHP:
1. Перейдите в папку с php "**C:\\php**"
2. Найдите файл "**php.ini-development**" и скопируйте его
3. Копию файла переименуйте в "**php.ini**" и откройте его
5. Перейдите в каталог с этим проектом и откройте файл "**php-extensions.ini**"
6. Найдите каждую строчку из "**php-extensions.ini**" в "**php.ini**" и уберите знак "**;**" в этой строке. Например: "**; extension=fileinfo**" должно стать "**extension=fileinfo**"

### Запуск приложения:
1. Запустите **start_server.cmd**
2. Отройте в браузере **http://localhost:8080**

![RUBI - Google Chrome 2024-02-09 20-50-13](https://github.com/RDKg/PHP-Adaptive-WebSite-Without-JS/assets/115119289/a25ba63b-b052-4fef-9185-02939a437469)
