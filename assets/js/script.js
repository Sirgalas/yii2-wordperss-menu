jQuery(document).ready(function(){

   
});
function log (evt) {
    if (!evt) {
        var args = '{}';
    } else {
        var args = evt.params;
    }
    return args;
}