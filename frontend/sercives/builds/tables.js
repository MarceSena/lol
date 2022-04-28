function buildTable(element) {
  let row = document.createElement("tr");
  Object.keys(element).forEach((item) => {
    value = document.createElement("td");
    value.innerHTML = element[item]
    row.appendChild(value);
  });

  return row;
}

function errorTable(error){
  TABLE_CONSULTE_ERROR.innerHTML = error  //''
}

function drawTable(data, table) {
  data.forEach(element => {
    let rows = buildTable(element);
    table.appendChild(rows);
  });
}

function drawTablePrices(){
  let data = getAllDDD(URL);
  drawTable(data.response,MY_TABLE )
}

drawTablePrices()
errorTable('Nenhuma simulação realizada!')