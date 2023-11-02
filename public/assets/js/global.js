let Global = {

    init: function() {

    },
    
    responseMessageWithSwal : function ($response) {
        Swal.fire($response);
        this.modalDismiss();
    },

    modalDismiss : function () {
        $(document).find('.modal').modal('hide');
    },
}

$( document ).ready(function() {
    Global.init();
});