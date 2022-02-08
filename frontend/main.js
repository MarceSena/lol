const URL = "http://localhost:8000/public/ddd/listar"
const MY_TABLE = document.getElementById("tbody")
const WHIT_PLAN = 0 
const NO_PLAN = 0
const PLAN =  document.getElementById("plano").value
const TIME = document.getElementById("tempo").value
const SELECT_ORIGIN =  document.getElementById("select-origin")
const SELECT_DESTINY = document.getElementById("select-destino")




function connectWithApi(URL) {
    request = new XMLHttpRequest()
    request.open("GET", URL, false)
    request.send()
    return request.responseText

}

function buildSelects(objeto) {
    
    objeto.resposta.forEach((element) => {
        option_origin = new Option(element.origem, element.origem);
        option_destiny = new Option(element.destino, element.destino);
        SELECT_ORIGIN.options[SELECT_ORIGIN.options.length] = option_origin;
        SELECT_DESTINY.options[SELECT_DESTINY.options.length] = option_destiny;
    });
}

function buildTable(ddd, time, plan, with_plan, no_plan){
    row = document.createElement("tr");

    td_origin = document.createElement("td");
    td_destiny = document.createElement("td");
    td_tariff = document.createElement("td");
    td_time  = document.createElement("td");
    td_plan  = document.createElement("td");
    td_with_plan = document.createElement("td");
    td_value_no_plan = document.createElement("td");

    td_origin.innerHTML = ddd.origem
    td_destiny.innerHTML = ddd.destino
    td_tariff.innerHTML = (ddd.valor / 100)
    td_time.innerHTML = time
    td_plan.innerHTML = plan
    td_with_plan.innerHTML = with_plan
    td_value_no_plan.innerHTML = no_plan

    row.appendChild(td_origin);
    row.appendChild(td_destiny);
    row.appendChild(td_tariff);
    row.appendChild(td_time);
    row.appendChild(td_plan);
    row.appendChild(td_with_plan);
    row.appendChild(td_value_no_plan);

    return row;

}


function updateTablePlan(update){
    var TARIFF = getTarifa();
    var TIME = $('#tempo').val()
    var PLAN = $('#plano').val()
    
    update.on("click", function () {
        var value = $(this).val()
        var par = $("#tbody tr td").parent();
        var plano = par.children("td:nth-child(5)");
        plano.html(value);


        with_plan = withPlan(TARIFF, TIME, PLAN)
        var withplan = par.children("td:nth-child(6)");
        withplan.html(with_plan);
    
        no_plan = noPlan(TARIFF, TIME)
        var noplan = par.children("td:nth-child(7)");
        noplan.html(no_plan);


    });
}


function updateTableTime(update) {
    var TARIFF = getTarifa();
    var TIME = $('#tempo').val()
    var PLAN = $('#plano').val()

    update.on("keyup", function () {
        var value = $(this).val()
        var par = $("#tbody tr td").parent();
        var time = par.children("td:nth-child(4)");
        time.html(value);


        with_plan = withPlan(TARIFF, TIME, PLAN)
        var withplan = par.children("td:nth-child(6)");
        withplan.html(with_plan);
    
        no_plan = noPlan(TARIFF, TIME)
        var noplan = par.children("td:nth-child(7)");
        noplan.html(no_plan);


      
    }).click(function () {
        var value = $(this).val()
        var par = $("#tbody tr td").parent();
        var time = par.children("td:nth-child(4)");
        time.html(value);


        with_plan = withPlan(TARIFF, TIME, PLAN)
        var withplan = par.children("td:nth-child(6)");
        withplan.html(with_plan);
    
        no_plan = noPlan(TARIFF, TIME)
        var noplan = par.children("td:nth-child(7)");
        noplan.html(no_plan);
    });

}


function withPlan(tarifa, tempo, plano) {
   console.log(tarifa)
   console.log(tempo)
   console.log(plano)
   
    if (plano >= tempo) return custo = '0'
  
    var cobradoTempo = tempo - plano
    var custo = tarifa + (tarifa * 0.1)
    var cobranca = cobradoTempo + custo

    console.log(cobranca)
    return cobranca


}

function noPlan(tarifa, tempo) {
    var cobranca = tarifa + tempo
    return cobranca

}


function getTarifa() {
    var par = $("#tbody tr td").parent();
    var tdtarifa = par.children("td:nth-child(3)").text();
    return tdtarifa;
}



function main() {

    let data = connectWithApi(URL);
    let ddd = JSON.parse(data);
    const PLANO = $("#plano")
    const TEMPO = $("#tempo")

    buildSelects(ddd)

    // DRAW MY TABLE
    ddd.resposta.forEach(element => {
        let rows = buildTable(element, TIME, PLAN, WHIT_PLAN, NO_PLAN);
        MY_TABLE.appendChild(rows);
    });
   
    
    updateTablePlan(PLANO)
    updateTableTime(TEMPO)


}

main()

