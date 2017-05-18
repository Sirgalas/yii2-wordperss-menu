jQuery(document).ready(function(){
    var startX=0;
    var count=1;
    var depth=25;
    var division=0;
    var maxDeptch;
    var classBootstrap;
    var prev;
    var offset=$('#menu-to-edit').offset();
    $(".sortable-ui").on('click',function () {
        $(".sortable-ui").sortable({
            start: function (event, ui) {
                startX = event.clientX;
                ui.item.removeClass(classBootstrap);
            },
            sort: function (event, ui) {
                var summ = event.clientX - startX;
                //var dataDepth=ui.item.data('depth');
            },
            stop: function (event, ui) {
                var classDeptch = 1;
                startX = event.clientX;//получаю позицию движущего элимента
                prev = ui.item.prev().context.attributes[3].nodeValue;
                maxDeptch = parseInt(prev) + 1;//предыдущего вложенного элимента +1
                devision = Math.round((event.clientX - offset.left) / depth);//получаю количество шагов из расчета шаг 25 пикселей
                if (devision >= maxDeptch) {//если количество шагов больше чем глубина maxDeptch глубина вложения не может быть глубже maxDeptch
                    classDeptch = maxDeptch;
                } else {
                    classDeptch = devision;
                }
                console.log(ui.item.prev());
                console.log(maxDeptch);
                if (ui.item.index() != 0) {
                    classBootstrap = 'col-md-offset-' + classDeptch;
                    ui.item.addClass(classBootstrap);
                    var dataDepth = ui.item.data('depth');
                    ui.item.attr('data-depth', (classDeptch));
                }
            }
        });
    });
    $(".sortable-ui").on('click','.wells .del',function(){
        $(this).parent('.wells').remove()
    });
});