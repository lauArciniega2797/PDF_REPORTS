const createPFD = () => {
    console.log('hagamoslo!!!')
    fetch('assets/api/api.php')
    .then(response => {
        console.log('tipo de respuesta: ', response.type);

        response.blob().then(myblob =>{
            const objectURL = URL.createObjectURL(myblob)
            window.open(objectURL)
        })
    })
    .catch(() => { console.log('no se armo') })
}