function simple_alert(title,message,type){
    Swal.fire({
        title: title,
        text: message,
        icon: type
      });
}
function post_msg(title,message,type){
    swal.fire({
        title: title,
        text: message,
        icon: type
        }). then(function() {
            location.reload();
        });
}