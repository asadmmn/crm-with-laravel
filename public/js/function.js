function showError(field, message){
    if(!message){
        $("#"+field).addClass('is-valid').removeClass("is-invalid").siblings(".invalid-feedback").text("")
    } else {
        $("#"+field).addClass('is-invalid').removeClass("is-valid").siblings(".invalid-feedback").text(message)
    }
}

function removeValidtationClasses(form){
    $(form).each(function(){
        $(form).find(":input").removeClass("is-valid is-invalid")
    })
}


function showMessage(type, message){
    return `<div class="alert alert-${type}"><strong>${message}</strong><button type="button" class="btn-close" ><i class="fa-solid fa-circle-xmark"></i></button></div>`
}


$("body").on('click', '.btn-close', function(){
    $(this).parent().remove()
})
