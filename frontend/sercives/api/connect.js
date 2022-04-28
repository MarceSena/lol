function getAllDDD(URL) {
  request = new XMLHttpRequest()
  request.open("GET", URL, false)
  request.send()
  return JSON.parse (request.responseText)
}