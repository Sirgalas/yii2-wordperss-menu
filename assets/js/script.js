jQuery(document).ready(function(){
    var startX=0;
    var count=1;
    var depth=50;
    var division=0;
    var maxDeptch;
    var classBootstrap;
    var prev;
    var offsets=$('#menu-to-edit').offset();
    $(".sortable-ui").sortable({
        grid:[50,50],
        start: function (event, ui) {
            startX = event.clientX;
            ui.item.removeClass(classBootstrap);
            // console.log(ui.item.offset());
        },
        activate: function (event, ui) {

        },
        beforeStop: function(event, ui){
            devision = Math.round((ui.offset.left - offsets.left) / depth);
        },
        stop: function (event, ui) {
            var classDeptch = 1;
            startX = event.clientX;
            prev = ui.item.prev().attr('data-depth')
            maxDeptch = parseInt(prev) + 1;
            if (devision >= maxDeptch) {
                classDeptch = maxDeptch;
            } else {
                classDeptch = devision;
            }
            if (ui.item.index() != 0) {
                classBootstrap = 'col-md-offset-' + classDeptch;
                ui.item.addClass(classBootstrap);
                var dataDepth = ui.item.data('depth');
                ui.item.attr('data-depth', (classDeptch));
            }
        }
    });
    $(".sortable-ui").on('click','.wells .del',function(){
        $(this).parent('.wells').remove()
    });
    $("#secure").click(function (e) {
        e.preventDefault();
        var menu={};
        $( "#menu-to-edit li" ).each(function (i) {
            var id = $(this).data('id');
            var model = $(this).data('model');
            var alias = $(this).data('alias');
            var depth = $(this).attr('data-depth');
            var path = $(this).data('path');
            var title=$(this).data('title');
            var key = 'menu' + i;
            var addmenu = {title: title, id: id, model: model,alias:alias,depth:depth,path:path };
            menu[key] = addmenu;
        });
        //console.log(JSON.stringify(menu));
        var newval = JSON.stringify(menu);
        console.log(newval);
        //$('#frontendsetup-vaelye').val(''+newval);
    });
});

function log (evt) {
    if (!evt) {
        var args = '{}';
    } else {
        var args = evt.params;
    }
    return args;}