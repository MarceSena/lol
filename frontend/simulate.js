$(".simulate").click(async function () {
  validation()
  if (!error) {
    if (TABLE_CONSULTE_ERROR.parentNode != null) {
      TABLE_CONSULTE_ERROR.parentNode.removeChild(TABLE_CONSULTE_ERROR);
    }

    var origin = getOrigin()
    var destiny = getDestiny()
    var plan = getPlan()
    var time = getTime()

    data = [{
      'origem': origin,
      'destino': destiny
    }]

    var excess = getExcess(time, plan)
    var tariff = gettariff(data)
    var tariffnew = calculePercentage(tariff)
    var paymentAmountWith = valorPagar(excess, tariffnew)
    var paymentAmountWithout = parseFloat(time) * parseFloat(tariff)

    dataTableResult = [{
      'Origem': origin,
      'Destino': destiny,
      'Minutos': time,
      'plano': plan,
      'Com': paymentAmountWith > 0 ? paymentAmountWith : 0,
      'Sem': paymentAmountWithout
    }]

    drawTable(dataTableResult)
  }
})

function getDestiny() {
  return document.getElementById('select-destino').value
}

function getOrigin() {
  return document.getElementById("select-origin").value
}

function getPlan() {
  return document.getElementById('plano').value
}

function getTime() {
  return document.getElementById('tempo').value
}

function getExcess(time, plan) {
  return time - plan
}

function valorPagar(exedente, tariff_new) {
  return exedente * tariff_new
}

function calculePercentage(valor) {
  return valor = parseFloat(valor) + parseFloat(valor * 0.1)
}

let valor
function gettariff(data) {
  let ddd = getAllDDD(URL);
  ddd.response.forEach((element) => {
    var obj1 = buildDataFronCompararion(element);
    if (isEquals(obj1, data)) {
      valor = element.valor
    }
  });
  return valor
}

function isEquals(obj1, obj2) {
  return JSON.stringify(obj1) == JSON.stringify(obj2)
}

function buildDataFronCompararion(element) {
  return [{
    'origem': element.origem,
    'destino': element.destino
  }]
}


