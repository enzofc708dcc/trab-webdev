/**
 * @file script.js
 *
 * 
 * Responsável pela conexão entre o front e backend
 *
 * @link      https://github.com/enzofc708dcc/trab-webdev/blob/master/util.js
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/resultado.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/registra_voto.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/index.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/fill_json.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/script.js
 *  @author Paulo Roma, adaptado por Felipe Pestana Rosa e Enzo Ferreira Carnevali
 *  @since 31/07/2022
 */


/**
 * É responsável pela comunicação do frontend com o backend, chamando um script php para executar uma consulta ao banco de dados.
 * 
 * A resposta dessa consulta é então consumida por uma função do frontend.
 * @param {String} url 
 * @param {String} method 
 * @param {function} callback 
 * @param {String} body 
 */
function ajax(url, method, callback, body = null) {
    let request = new XMLHttpRequest();
    request.overrideMimeType("application/json");
    request.open(method, url, true);
    request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status == "200") {
          callback(request.responseText);
      }
    };
    request.send(body);
  }

  function ajaxNotAsync(url, method, callback, body = null) {
    let request = new XMLHttpRequest();
    request.overrideMimeType("application/json");
    request.open(method, url, false);
    request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status == "200") {
          callback(request.responseText);
      }
    };
    request.send(body);
  }