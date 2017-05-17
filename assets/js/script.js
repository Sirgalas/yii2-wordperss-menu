jQuery(document).ready(function(){
    var startX=0;
    var count=1;
    var deth=25;
    var countEvent=1;
    $(".sortable-ui").sortable({
        start: function(event, ui) {
            startX=event.clientX;

            console.log(ui);

        },
        sort: function(event, ui){
            var summ =event.clientX-startX;
            if(summ>=deth) {
                ui.item.addClass('deth');
                var removeClassBootstrap='col-md-offset-' + (countEvent-1);
                if(ui.item.hasClass(removeClassBootstrap)){
                    ui.item.removeClass(removeClassBootstrap);
                }
                var classBootstrap = 'col-md-offset-' + countEvent;

                ui.item.addClass(classBootstrap);
            }
        },
        stop:function(event,ui){
            if((event.clientX-startX)>=deth){
                countEvent++;

            }else{
                countEvent--;

            }
            startX=event.clientX;
        }
    });
});

function log (evt) {
    if (!evt) {
        var args = '{}';
    } else {
        var args = evt.params;
    }
    return args;}