var saludar = new Promise((resolve, reject)=>{
    setTimeout(()=>{
        let saludo = "hola mundo";
        saludo = false;
        if(saludo){
            resolve(saludo);
        }else{
            reject("Nada por aqui");
        }
    }, 2000);
});

saludar.then(resultado => {
    alert(resultado);
})
.catch(err => {
    alert(err);
});