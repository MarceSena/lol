const URL = "http://localhost:8000/public/ddd/getAll"
const MY_TABLE = document.getElementById("table-service-body")
const TABLE_CONSULTE_ERROR = document.getElementById("table-consulte-body-error")
const TABLE_CONSULTE = document.getElementById("table-consulte-body")
const WHIT_PLAN = 0 
const NO_PLAN = 0
const PLAN =  document.getElementById("plano").value
const TIME = document.getElementById("tempo").value
const SELECT_ORIGIN =  document.getElementById("select-origin")
const SELECT_DESTINY = document.getElementById("select-destino")
let error = false
let count = 0