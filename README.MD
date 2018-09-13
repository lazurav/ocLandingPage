<h1>LANDING PAGE</h1>
<p>Гарантировано работает на стандартных Opencart 2.3 и Ocstore 2.3</p>
<p>Если не работает, то легко адаптируется под любую другую тему или другой модуль фильтрации</p>
<h2>Возможности</h2>
<ul>
	<li>Работает со стандартными фильтрами, но легко дорабатывается под любой другой модуль!</li>
	<li>Создание посадочных страниц на любой странице фильтра, тега, сортировки, поиска, производителя с уникальными: <strong>title, meta_description, meta_keywords, h1, description.</strong></li>
	<li>В OPENCART 2.3 на странице категории исправляет тег &lt;h2&gt; на &lt;h1&gt;.&nbsp; В Ocstore это изначально исправлено.</li>
	<li>Добавляет кнопку "сброс фильтра" для стандартных фильтров.</li>
	<li>При пагинации в&nbsp; TITLE добавляет переменную пагинации и убирает текстовое описание страницы, чтобы не дублировался контент.</li>
	<li>Создает карту посадочных страниц Landing_sitemap.xml</li>
</ul>
<h2>Установка модуля</h2>
<h3>Для OPENCART 2.3</h3>
<ul>
	<ul>
		<li>Чтобы установить модуль установите Opencart2.3-LandingPage.ocmod.zip через установку дополнений.</li>
		<li>Если вы хотите иметь возможность создавать посадочные страницы на страницах производителей - установите&nbsp;Opencart2.3-LandingPageToManufacturer.ocmod.xml</li>
		<li>Обновите модификаторы.</li>
	</ul>
</ul>
<h3>Для OCSTORE 2.3</h3>
<ul>
	<ul>
		<li>Чтобы установить модуль установите Ocstore2.3-LandingPage.ocmod.zip через установку дополнений.</li>
		<li>Обновите модификаторы.</li>
	</ul>
</ul>
<p>В разделе каталог у вас появится ссылка "Посадочные страницы". В разделе "модули" =&gt; "каналы продвижения" появится Landing Sitemap.</p>
<h2>Использование модуля</h2>
<ul>
	<li>Перейдите на страницу фильтра или поиска, для которой нужно создать посадочную страницу.</li>
	<li>Скопируйте ссылку после домена. Если ваша ссылка имеет вид www.yourdomain.com<strong>/categ1/categ2/?filter=123</strong>,&nbsp;скопируйте только&nbsp;<strong>/categ1/categ2/?filter=123</strong>.</li>
	<li>В админке перейдите в Каталог =&gt; Посадочные страницы.</li>
	<li>Создайте посадочную страницу, в качестве "Параметр URL" используйте скопированную часть ссылки "<strong>/categ1/categ2/?filter=123</strong>". (Данное поле должно быть уникальным и начинаться со слеша, иначе посадочная страница не сохранится).</li>
	<li>Заполните необходимые поля, поставьте статус ВКЛЮЧЕНО и сохраните. Посадочная страница создана и работает!</li>
</ul>
<h2>Создание карты посадочных страниц</h2>
<ul>
	<li>Передите в раздел "Модули" =&gt; "Каналы продвижения".</li>
	<li>Установите и включите модуль "Landing sitemap".</li>
	<li>Для генерации "Landing sitemap" используйте ссылку: www.yourdomain.com<strong>/index.php?route=extension/feed/landing_sitemap</strong></li>
	<li>Фид сохраняется в файл по адресу: www.yourdomain.com<strong>/landing_sitemap.xml</strong></li>
</ul>
<h2>Особенности модуля</h2>
<ul>
	<li>Модуль не перезаписывает и не затирает стандартные файлы.</li>
	<li>Написан чистым языком в стиле OPENCART.</li>
	<li>Поддерживает мультиязычность.</li>
	<li>Поддерживает кириллицу.</li>
	<li>Работает с любыми ссылками.</li>
	<li>Легкая установка.</li>
	<li>При необходимости очень легко адаптировать под любой другой модуль и стороннюю тему.</li>
</ul>
<p>upload/admin/controller/catalog</p>
<h2>Структура файлов</h2>
<pre>install.sql&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Установщик таблиц в БД
install.xml&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Ocmod модификатор стандартных файлов
install.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Устанавливает права на просмотр и редактирование модуля
upload/admin/controller/catalog/landing.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Админ.часть контроллер посадочных страниц. Методы: add, edit, copy, delete, getForm, getList, valid
upload/admin/controller/extension/feed/landing_sitemap.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Админ.часть контроллер карты посадочных страниц
upload/admin/language/*/catalog/landing.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Админ.часть языковые файлы посадочных страниц
upload/admin/language/*/extension/feed/landing_sitemap.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;// Админ.часть языковые файлы карты посадочных страниц
upload/admin/model/catalog/landing.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Админ.часть модель посадочных страниц, содержит обращения к БД
upload/admin/view/template/catalog/landing_form.tpl&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Админ.часть фронт формы модуля посадочных страниц
upload/admin/view/template/catalog/landing_list.tpl&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Админ.часть фронт формирования списка посадочных страниц
upload/admin/view/template/extension/feed/landing_sitemap.tpl&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Админ.часть фронт карты посадочных страниц
upload/catalog/controller/extension/feed/landing_sitemap.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Контроллер генератора карты посадочных страниц
upload/catalog/model/catalog/landing.php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Модель генератора карты посадочных страниц - обращения к БД
</pre>
