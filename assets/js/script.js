jQuery(document).ready(function(){
    var startX=0;
    var count=1;
    var depth=25;
    var division=0;
    var classBootstrap;
    $(".sortable-ui").sortable({
        start: function(event, ui) {
            startX=event.clientX;
            ui.item.removeClass(classBootstrap);
        },
        sort: function(event, ui){
            var summ = event.clientX-startX;
            var prev= ui.item.prev().data('depth');
            division = Math.round(prev+1);
            //var dataDepth=ui.item.data('depth');
        },
        stop:function(event,ui){
            startX=event.clientX;
            if(ui.item.index()!=0) {
                classBootstrap = 'col-md-offset-' + division;
                ui.item.addClass(classBootstrap);
                var dataDepth=ui.item.data('depth');
                ui.item.attr('data-depth',(dataDepth+division));
            }
        }
    });
    $(".sortable-ui").on('click','.wells .del',function(){
        $(this).parent('.wells').remove()
    });
});

function log (evt) {
    if (!evt) {
        var args = '{}';
    } else {
        var args = evt.params;
    }
    return args;}