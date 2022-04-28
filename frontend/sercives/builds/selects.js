function buildSelects(objeto) {
  objeto.response.forEach((element) => {
    option_origin = new Option(element.origem, [element.origem]);
    option_destiny = new Option(element.destino, [element.destino]);
    SELECT_ORIGIN.options[SELECT_ORIGIN.options.length] = option_origin;
    SELECT_DESTINY.options[SELECT_DESTINY.options.length] = option_destiny;
  });
}

function selects() {
  let data = getAllDDD(URL);
  buildSelects(data)
  
}

selects()


