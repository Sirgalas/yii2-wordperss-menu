jQuery(document).ready(function(){
    var startX=0;
    var count=1;
    $("#sortable").sortable({

        start: function(event, ui) {
            startX=event.clientX;
            console.log(startX);
        },
        sort: function(event, ui){
            if((startX-event.clientX)<=-25){

            }
            console.log(startX-event.clientX);
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