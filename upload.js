/* const photo_form = document.getElementById('photosForm');
photo_form.addEventListener('submit',function(event){
    event.preventDefault();
    let file = document.getElementById('uploadPhoto');
    let title = document.getElementById('titlePhoto');
    let description = document.getElementById('desciptionPhoto');
    let categorie = document.getElementById('categoriePhoto');
    let visibility = document.getElementById('categoriePhoto');
    let errFile = document.getElementById('errFile');
    let errTitle = document.getElementById('errTitle');
    let errDescription = document.getElementById('errDescription');
    let errCategorie = document.getElementById('errCategorie');
})
 */
const file = document.getElementById("file_selected");
const zone = document.getElementById('upload');
const filename = document.getElementById("uploadPhoto");
const zoneClick = document.querySelector('.card-body');
zone.addEventListener('click',function(){
    document.getElementById('uploadPhoto').click();
})

zoneClick.addEventListener("change",function(){
    if(filename.files.length > 0){
        file.style.display = "block";
        const reader = new FileReader();
        reader.onload = function(e){
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = "block";
            zone.style.padding = "0";
        }
        reader.readAsDataURL(filename.files[0]);
        file.textContent = `Selected file ${filename.files[0].name}`;
        document.getElementById("para").innerHTML = "";
        document.getElementById("icon").style.display = "none";
    }else{
        alert("Choose a file please");
    }
})