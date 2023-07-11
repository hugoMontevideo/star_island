const selectMediaType =  document.querySelector('#id_media_type');
const inputNameMedia = document.querySelector('.name_media');
const inputFile = document.querySelector('.div_input_file');

selectMediaType.addEventListener('change', function(){

    for(i=0; i<this.options.length; i++){
        if(this.options[i].selected == true){
            if(this.options[i].label == 'lien'){
                inputFile.classList.add('none');
                inputNameMedia.classList.remove('none');
            }else{
                inputFile.classList.remove('none');
                inputNameMedia.classList.add('none');
            }
        }       
    } 
})


