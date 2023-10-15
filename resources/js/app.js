
import Dropzone from 'dropzone';

Dropzone.autoDiscover=false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage:'Sube aqui tu imagen',
    acceptedFiles:".png,.jpg,.jpeg,.gif",
    addRemoveLinks:true,
    dictRemoveFile:'Borrar archivo',
    maxFiles:1,
    uploadMultiple:false,

    init:function(){
      //  alert('Dropzone creado');
      //en el caso de que haya algo va a selecionar
      if(document.querySelector('[name="imagen"]').value.trim()){
 //crear un objeto
        const imagenPublicada={};
        imagenPublicada.size=1234;
        imagenPublicada.name=document.querySelector('[name="imagen"]').value;

        //las opciones de dropzone
        this.options.addedfile.call(this,imagenPublicada);
        //call se asigna automaticamente pero se hace llamar
        //cuando se inicie esta funcion se mande a llamar aqui ´
        //si fuese bind el resultado es el mismo pero tu debes de llamar a la function
        this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);
        imagenPublicada.previewElement.classList.add(
            "dz-success",
            "dz-complete"
        );

      }
    }
});

//eventos
//cuando estas enviando un archivo , file el archivo actual , la peticion 
//el upload
dropzone.on('sending',function(file,xhr,formData){

    console.log(file);

});
//en el caso de que se suba correctamente
dropzone.on('success',function(file,response){

    console.log(response+" "+ response.imagen);
    document.querySelector('[name="imagen"]').value=response.imagen;
});

//en el caso que no se suba 
dropzone.on('error',function(file,message){

    console.log(message);
});

//cuando vayamos a borrar el archivo
dropzone.on('removedfile',function(){

    console.log('archivo eliminado');

    document.querySelector('[name="imagen"]').value='';
});


