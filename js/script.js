$(document).ready(function() {
    $("[data-target-block]").click(function (eventObject) {
        // Определяем целевой блок
        $target = $(this).attr("data-target-block");
        $p = $(this).attr("data-loc");
        // Отображаем его
        $('#'+$target).css('display', 'block');
        // Добавляем стрелочку "назад" в заголовке
        $('#'+$p+"-prev").css('display', 'block');

        // Ссылку внизу убираем
        $('#'+$p+"-link").css('display', 'none');
        // Родительский блок тоже убираем
        $($(this).parent()).css('display', 'none');
    });

    $("[data-prev-target]").click(function (eventObject) {
        // Определяем предыдущий блок
        $prev = $(this).attr("data-prev-target");
        $p = $(this).attr("data-loc");
        // Отображаем его
        $('#'+$prev).css('display', 'flex');
        // Отображаем ссылку внизу блока
        $('#'+$p+'-link').css('display', 'block');

        // Скрываем блок с вариантами тарифов и саму стрелку
        $('#'+$p+'-sub').css('display', 'none');
        $($(this).css('display', 'none'));
    });

    $("[data-tarif-sel]").click(function (eventObject) {
        $sel = $(this).attr("data-tarif-sel");
        $p = $(this).attr("data-loc");

        $('#'+$sel).css('display', 'block');
        // Скрываем родительский див и все остальные ли-шки
        $($(this).parent()).css('display', 'none');
        $($(this).parent().parent().siblings()).css('display', 'none');

        // Подменяем одну стрелку "назад" другой
        $('#'+$p+'-prev').css('display', 'none');
        $('#'+$p+'-prev-sub').css('display', 'block');

    });

    $("[data-prev-sub-target]").click(function (eventObject) {
        $sub = $(this).attr("data-prev-sub-target");
        $p = $(this).attr("data-loc");
        // Отображаем все ли-шки и помесячную инфу, скрываем выбранный вариант тарифа
        $('#'+$sub).children("ul").children("li").css('display', 'block');
        $('#'+$sub).children("ul").children("li").children(".tarif-months").css('display', 'flex');
        $('#'+$sub).children("ul").children("li").children(".tarif-selected").css('display', 'none');

        // Отображаем предыдущую стрелку, скрываем текущую
        $($(this).siblings(".arrow-prev")).css('display', 'block');
        $($(this).css('display', 'none'));
    });

    // Тест
    $("button").click(function () {
        // Добавлено для отладки, показывает айди родительского элемента
        alert($(this).parent().attr("id"));
    });
});