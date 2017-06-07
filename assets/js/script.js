jQuery(document).ready(function(){
    var startX=0;
    var depth=50;
    var maxDeptch;
    var classBootstrap;
    var prev;
    var offsets=$('#menu-to-edit').offset();
    $(".sortable-ui").sortable({
        grid:[50,50],
        //items:"li:not(.ui-state-disabled)",
        connectWith:".connectedSortables",
        start: function (event, ui) {
            startX = event.clientX;
            ui.item.removeClass(classBootstrap);
        },
        beforeStop: function(event, ui){
            devision = Math.round((ui.offset.left - offsets.left) / depth);

        },
        stop: function (event, ui) {
            id=ui.item.prev().index();
            ui.item.prev().attr('data-id',id);
            var classDeptch = 1;
            startX = event.clientX;
            prev = ui.item.prev().attr('data-depth')
            maxDeptch = parseInt(prev) + 1;
            var extId=ui.item.parents('ul').attr('data-class');
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
            var fullId=extId+'-'+ ui.item.attr('data-item');
            ui.item.attr('id',fullId);
        }
    }).disableSelection();
    /*$(".droppable").droppable({
     drop:function(event, ui){
     alert('yes');
     console.log(event);
     }
     });*/
    $(".sortable-ui").on('click','.wells .del',function(){
        $(this).parent('.wells').remove()
    });

    $("#secures").click(function (e) {
        e.preventDefault();
        var menu = {};
        var extra = {};
        $("#menu-to-edit li").each(function (i) {
            if ($(this).data('menu')) {
                var menuItem = $(this).data('menu');
                var depth = parseInt($(this).attr('data-depth'));
                var key = 'menu' + $(this).attr('data-item');
                var addmenu = {menuItem: menuItem, depth: depth}
            } else {
                var id = $(this).data('id');
                var model = $(this).data('model');
                var alias = $(this).data('alias');
                var depth = parseInt($(this).attr('data-depth'));
                var path = $(this).data('path');
                var title = '';
                if ($(this).find('img')) {
                    var img = $(this).find('img');
                    var imgPath = img.attr('data-pathimage');
                    var imgName = img.attr('data-filename');
                } else {
                    var imgPath = false;
                    var imgName = false;
                }
                if ($(this).find('.tilteInput').val().length == 0) {
                    title = $(this).data('title').toString();
                } else {
                    title = $(this).find('.tilteInput').val();
                }
                if ($(this).find('.classInput').val().length == 0) {
                    classItem = false;
                } else {
                    classItem = $(this).find('.classInput').val();
                }
                if ($(this).find('.idInput').val().length == 0) {
                    idInput = false;
                } else {
                    idInput = $(this).find('.idInput').val();
                }
                var key = 'menu' + $(this).attr('data-item');
                var addmenu = {
                    title: title,
                    id: id,
                    model: model,
                    alias: alias,
                    depth: depth,
                    path: path,
                    imgPath: imgPath,
                    imgName: imgName
                };
            }
            if ($(this).attr('data-parent')) {
                var parentKey = 'menu' + $(this).data('parent');

                var parent = menu[parentKey];
                if (parent) {
                    for (var j = depth; j > 1 && parent; j--) {
                        parent = parent.depthMenu;
                    }
                    if (parent) {
                        if (typeof parent.depthMenu == "undefined") {
                            parent.depthMenu = {};
                        }
                        parent.depthMenu[key] = addmenu;
                    }
                } else {
                    menu[key] = addmenu;
                }
            } else {
                menu[key] = addmenu;
            }
        });
        var countDraggable = 0;
        $('.extra').each(function () {

            var keyExtra = 'extra' + countDraggable;
            $(this).find("li").each(function (i) {

                if ($(this).data('menu')) {
                    var menuItem = $(this).data('menu');
                    var depth = parseInt($(this).attr('data-depth'));
                    var key = 'menu' + $(this).attr('data-item');
                    var addmenu = {menuItem: menuItem, depth: depth}
                } else {
                    var id = $(this).data('id');
                    var model = $(this).data('model');
                    var alias = $(this).data('alias');
                    var depth = parseInt($(this).attr('data-depth'));
                    var path = $(this).data('path');
                    var title = '';
                    if ($(this).find('img')) {
                        var img = $(this).find('img');
                        var imgPath = img.attr('data-pathimage');
                        var imgName = img.attr('data-filename');
                    } else {
                        var imgPath = false;
                        var imgName = false;
                    }
                    if ($(this).find('.tilteInput').val().length == 0) {
                        title = $(this).data('title').toString();
                    } else {
                        title = $(this).find('.tilteInput').val();
                    }
                    if ($(this).find('.classInput').val().length == 0) {
                        classItem = false;
                    } else {
                        classItem = $(this).find('.classInput').val();
                    }
                    if ($(this).find('.idInput').val().length == 0) {
                        idInput = false;
                    } else {
                        idInput = $(this).find('.idInput').val();
                    }
                    var key = 'extra' + $(this).attr('data-item');
                    var addmenu = {
                        title: title,
                        id: id,
                        model: model,
                        alias: alias,
                        depth: depth,
                        path: path,
                        imgPath: imgPath,
                        imgName: imgName
                    };
                }
                if ($(this).attr('data-parent')) {
                    var parentKey = 'extra' + $(this).data('parent');
                    var parent = extra[parentKey];
                    if (parent) {
                        for (var j = depth; j > 1 && parent; j--) {
                            parent = parent.depthMenu;
                        }
                        if (parent) {
                            if (typeof parent.depthMenu == "undefined") {
                                parent.depthMenu = {};
                            }
                            parent.depthMenu[key] = addmenu;
                        }
                    } else {
                        extra[keyExtra] = addmenu;
                    }
                } else {
                    extra[keyExtra] = addmenu;
                }
            });
            countDraggable++
        });
        var allMenu=Object.assign(menu,extra);
        console.log(JSON.stringify(allMenu, "", 4));
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
        $("#dropFileHide").hide();
        var url = $(this).data('url');
        var id = $(this).parents('li.wells').attr('data-item');
        var className = $(this).parents('li.wells').attr('data-model');
        var extId=$(this).parents('ul').attr('data-class');
        var fullId=extId+'-'+id;
        $.ajax({
            type: "GET",
            url:url,
            data:"id="+fullId+"&className="+className,
            success: function(data){
                $(".dropFileHide").html(data);
                $(".dropFileHide").show();
                //$("#menuget-imagefile").dropzone({url:url});
            }
        });

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