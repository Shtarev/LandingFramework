# LandingFramework
Минифреймворк для лэндингов
MiniFramework for Landing

В корне
Папка content - файловая база данных общая для пользовательской части и админки
Папка images - фото общая для пользовательской части и админки
Папка admin - только для администротивной части
Папка config - config_foto.php - задать размеры  фото и в config.php разные настройки, конфигурации и пара функций
Папка content - все текстовые блоки хранить в папке content, по сути эта папка как база данных
indeх.php - шаблон пользовательского шаблона
admin.php - пример админки. Делай ее похожей на пользовательский шаблон с возможностью редактирования прямо в теле.
Функционал эдитора прописан в admin\js\cript.js

________________________________________________________________________
Изображения
Изображения, принадлежащие шаблону
Изображения, принадлежащие шаблону должны иметь определенные в процессе верстки шаблона имена и размеры, то есть изначально определены вручную, должны лежать в директории images, и имя фото должно быть быть прописано в шаблоне и в аргументе функции fileSuch так:
Пользовательская часть
<!-- Статичное фото, всегда с одним именем например здесь foto_name это имя фото без расширения -->
<img src="images/<?= fileSuch('images', 'foto_name'); ?>" alt="...">

административная часть
<!-- Статичное фото, всегда с одним именем например здесь foto_name это имя фото без расширения id должно быть  как имя -->
<img id="foto_name" class="pointer" src="images/<?= fileSuch('images', 'foto_name'); ?>" alt="..." onClick="fotoChoice(this)" title="Кликни, чтоб заменить фото">

В админке эти изображения можно менять сликнув по ним мышью. Скрипт меняет эти изображения, но не меняет ни имен, ни размеров этих изображений. То есть обновляет изображение под старым именем и с размерами, бывшими у предыдущего фото. Здесь все происходит автоматически.
Изображения для галереи
Изображения для галереи можно загружать в любом количестве и удалять. При загрузке они сохраняются под новыми именами. Размеры этх фотографий прописаны в config\config_foto.php. Для каждого изображения есть описание. Редактирование описания не делал.
Шаблон получает массив с этими фотографиями где:
$img[$key][0] – фото для шаблона
$img[$key][1] – большое фото
$img[$key][2] – описание

Контент
Текст контента хранится в файлах директории content.  Имя каждого файла - это имя переменной, в которой лежит содержимое этого файла. Для админки и для клиентской части это одинаковые имена переменных. Рождение этих переменных в файле config/config.php
1)	В директории content создать файл например: sample.txt
2)	Что-нибудь в нем написать.
3)	В шаблоне этот контент вывести так <div><?= $sample ?></div>
4)	В админке этот контент вывести так
С редактором (запись и редактирование желательны только через редактор):
<div id="sample" onClick="editor(this)" contenteditable="true"><?= $sample ?></div>

Для простого редактирования в инпуте, удобно использовать в тегах шаблонах:. Поддерживает html-тэги, но желательно вводить просто строку, например для заголовков:
<input type="text" id="title_sample" name="title_sample" class="adminInput" style="width: 100%" value="<?= $sample ?>">




