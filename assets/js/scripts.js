const PDF_APP = new Vue({
    el: '#app_report',
    data: {
        tipoDoc: 'General de clientes',
        vendedor: '01 MONSERRAT',
        fechaHra: new Date(),
        counter: 0,
        clientes: []
    },
    created(){
        this.fechaHra = this.fechaHra.getDate() + '-' + (this.fechaHra.getMonth() + 1) + '-' + this.fechaHra.getFullYear()
        this.getData();
    },
    methods: {
        createPFD: function() {
            fetch('assets/api/report_api.php')
            .then(response => {
                console.log('tipo de respuesta: ', response.type);

                response.blob().then(myblob =>{
                    const objectURL = URL.createObjectURL(myblob)
                    window.open(objectURL)
                })
            })
            .catch(() => { console.log('Error') })
        },
        getData: function(){
            let app = this
            fetch('assets/api/api.php?action=getData')
            .then(response => response.json())
            .then(response => {
                app.clientes = response.datos
            })
            .catch(() => {console.log('Error datos')})
        }
    }
})