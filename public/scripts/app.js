function displayImages(images){
    const area = document.getElementById("area");
    for(let i = 0; i < images.length; i++){
        const img = document.getElementById("img"+String(i));
        let image = images[i];
        area.innerHTML += `
        <img src="${image}" alt="${image.name}">
    `;
    }
}

const imgInput = document.getElementById("pic_button");
imgInput.addEventListener("change",function () {
    const files = imgInput.files;
    // console.log(files);
    let images = [];
    Object.keys(files).forEach(i => {
        const file = files[i];
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (e) => {
        images.push(reader.result);
        displayImages(images);
        images=[]
      }
    })
});

// ()=>{
//     const files = imgInput.files;
//     if (files.length == 0){
//         alert("Nope");
//     }
//     const formData = new FormData();
//   // Append each selected file to the FormData object
//     for (let i = 0; i < files.length; i++) {
//         console.log(files[i]);
//         formData.append("files[]", files[i]);
//   }
//   displayImages(formData);
// });