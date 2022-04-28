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

function drawTable(data) {
  data.forEach(element => {
    let rows = buildTable(element);
    TABLE_CONSULTE.appendChild(rows);
  });
}

errorTable('Nenhuma simulação realizada!')