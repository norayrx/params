#Модуль для Битрикс «Списки параметров»
Модуль предоставляет api для получения данных в виде двумерных массивов из многих моделей битрикс. Модуль можно использовать для получения списков параметров в файлах `.parameters.php` компонентов, а так же для других целей.

Модуль доступен на [Маркетплейсе Битрикса](http://marketplace.1c-bitrix.ru/solutions/rover.params/).
##Использование
Большинство методов последним параметром принимают массив `$params`. Этот массив может содеражать слежующие поля:
* `empty` - подпись пустого элемента. Если задана и равняется `null`, то пустой элемент не создается
* `template` - шаблон для элементов списка, по умолчанию `['{ID}' => '[{ID}] {NAME}']`. Это означает, что ключами списка будут id элементов, а значение - id в квадратных скобках и имя.
* `filter` - дополнительный запрос orm getList `filter` к стандарному запросу метода
* `elements` - массив элементов, который будет преобразован к виду, заданному в `template` вместо массива, полученного в ходе выполнения метода

##Api
На данный момент доступны списки параметров из:
* [Главного модуля (main)](./help/main.md)
* [Инфоблоков (iblock)](./help/iblock.md)
* [Социальной сети (socialnetwork)](./help/socialnetwork.md)
* [Веб-форм (form)](./help/form.md)

##Требования  
Для работы модуля необходим установленный на хостинге php версии 5.4 или выше. 
##Контакты
Модуль активно развивается. Свои вопросы и плжелания вы можете отправлять на электропочту rover.webdev@gmail.com, либо через форму на сайте http://rover-it.me.