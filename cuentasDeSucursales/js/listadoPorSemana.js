
$(document).ready(function() {

    $('#pendientes').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    select: true,
    order: [[1,'asc']],
    dom: 'lBfrtip', 
    buttons: [   'copy', 'excel', 'pdf', 'print' ],
    "pageLength": 50,
    fixedHeader: true
    });


});


let tablas = document.querySelectorAll("#tablaDatos")

let sucursales = []
document.querySelector("#tablaDatos").querySelector("tbody").querySelectorAll("tr").forEach(x=>{
    sucursales.push({nmbreSuc: x.querySelectorAll("td")[0].textContent, valores: 0})
})



tablas.forEach(x => {

            let tBody = x.querySelector("tbody")
            let rows = tBody.querySelectorAll("tr")
            rows.forEach((element ,y)=> {
                let td = element.querySelectorAll("td");

                sucursales.forEach((nuevo) => {
                    if (nuevo['nmbreSuc'] == td[0].textContent ){
                        nuevo['valores'] =   parseInt(nuevo['valores']) + (parseInt(td[1].getAttribute('attr-realvalue')) + parseInt(td[2].getAttribute('attr-realvalue'))+ parseInt(td[3].getAttribute('attr-realvalue')) +parseInt(td[4].getAttribute('attr-realvalue')) +parseInt(td[5].getAttribute('attr-realvalue')) );
                    };
                });
              
            });

})
let tablaTachos = document.querySelector("#tablaDatos")
let t = tablaTachos.querySelector("tbody")
let r = t.querySelectorAll("tr")


r.forEach(tabla => {
    td = tabla.querySelectorAll("td");
sucursales.forEach(suc => {

    if(td[0].textContent == suc['nmbreSuc']){
        td[7].textContent = "$" + suc['valores']
    }
});

let resultadoTotal = 0;
r.forEach(tabla => {
    td = tabla.querySelectorAll("td");
    resultadoTotal =  parseInt(td[7].textContent.replace("$","") )+ parseInt( td[6].textContent.replace("$",""));
    td[8].textContent = resultadoTotal
})

});
