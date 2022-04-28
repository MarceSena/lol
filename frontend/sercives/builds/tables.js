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

// function drawTablePrices(){
//   let data = getAllDDD(URL);
//   data.response.forEach(element => {
//     let rows = buildTable(element);
//     MY_TABLE.appendChild(rows);
//   });
// }
errorTable('Nenhuma simulação realizada!')