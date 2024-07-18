import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube aquí tu imagen', 
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    DictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init: function() {
        if (document.querySelector('[name="imagen"]').value.trim())
        {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this,imagenPublicada);
            this.options.thumbnail.call(this,imagenPublicada,'/uploads/'.imagenPublicada.name);
            imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
        }
    },
});

dropzone.on('success',function(file,respuesta){
   document.querySelector('[name="imagen"]').value = respuesta.imagen;
});

dropzone.on('removedfile',function(file){
    document.querySelector('[name="imagen"]').value = '';
})
