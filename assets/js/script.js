jQuery(document).ready(function(){
    var startX=0;
    var depth=50;
    var maxDeptch;
    var classBootstrap;
    var prev;
    var offsets=$('#menu-to-edit').offset();
    $(".sortable-ui").sortable({
        grid:[50,50],
        create:function(event,ui){

        },
        start: function (event, ui) {
            startX = event.clientX;
            ui.item.removeClass(classBootstrap);
        },
        activate: function (event, ui) {

        },
        beforeStop: function(event, ui){
            devision = Math.round((ui.offset.left - offsets.left) / depth);

        },
        stop: function (event, ui) {
            id=ui.item.prev().index();
            ui.item.prev().attr('data-id',id);
            var classDeptch = 1;
            startX = event.clientX;
            prev = ui.item.prev().attr('data-depth');
            maxDeptch = parseInt(prev) + 1;
            if (devision >= maxDeptch) {
                classDeptch = maxDeptch;
            } else {
                classDeptch = devision;
            }
            if(classDeptch>0){
                var siblingItemDepht = Number(classDeptch)-Number(1);
                var parent = ui.item.prevAll('[data-depth=' + siblingItemDepht + ']').first();
                var index= parent.index();
                var sibling=ui.item.siblings();
                for(var i = 0;i<sibling.length;i++){
                    var oldParent=ui.item.siblings('[data-item='+index+']');
                    oldParent.attr('data-item',oldParent.index());
                    index=oldParent.index();
                }
                parent.attr('data-item',parent.index());
                ui.item.attr('data-parent',parent.index());
                ui.item.attr('data-item',ui.item.index());

            }else{
                ui.item.removeAttr('data-parent');
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
            var depth = parseInt($(this).attr('data-depth'));
            var path = $(this).data('path');
            if($(this).find('input').val().length==0) {
                var title = $(this).data('title').toString();
            }else{
                var title =$(this).find('input').val();
            }
            var key = 'menu' + $(this).attr('data-item');
            var addmenu = {title: title, id: id, model: model,alias:alias,depth:depth,path:path};
            if($(this).attr('data-parent')) {
                var parentKey = 'menu' + $(this).data('parent');
                var parent = menu[parentKey];
                if (parent) {
                    for (var j = depth; j > 1 && parent; j--) {
                        parent = parent.depthMenu;
                    }
                    if (parent){
                        if (typeof parent.depthMenu == "undefined") {
                            parent.depthMenu = {};
                        }
                        parent.depthMenu[key] = addmenu;
                    }
                }else{
                    menu[key] = addmenu;
                }
            }else {
                menu[key] = addmenu;
            }
        });
        console.log(JSON.stringify(menu, "", 4));
        var newval = JSON.stringify(menu);
    });

    $(".sortable-ui").on('click','.wells .showInput',function(){
        var input =$(this).siblings('p.form-group');
        if(input.hasClass('hide')){
            input.slideDown(300);
            input.removeClass('hide');
            $(this).removeClass('glyphicon-chevron-down');
            $(this).addClass('glyphicon-chevron-up');
        }else{
            input.slideUp(300);
            input.addClass('hide');
            $(this).addClass('glyphicon-chevron-down');
            $(this).removeClass('glyphicon-chevron-up');
        }
    });
    $(".sortable-ui").on('click','.wells .showDropFile',function(e){
        e.preventDefault();
        var id=$(this).parents('.wells').data('item');
        $('#dropzone').toggleClass('dropFileHide');
    });
});

var count=0;
function log (evt) {
    if (!evt) {
        var args = '{}';
    } else {
        var args = evt.params;
    }
    return args;}