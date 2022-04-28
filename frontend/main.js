function main() {
  let data = getAllDDD(URL);
  
  data.response.forEach(element => {
    let rows = buildTable(element);
    MY_TABLE.appendChild(rows);
  });
}



main()

