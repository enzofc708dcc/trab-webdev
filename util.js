/**
 * @file util.js
 *
 * 
 * <p>Responsável pela conexão entre o front e backend</p>
 *
 * @link      https://github.com/enzofc708dcc/trab-webdev/blob/master/util.js
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/resultado.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/registra_voto.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/fill_json.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/script.js
 *  @author Paulo Roma, adaptado por Felipe Pestana Rosa e Enzo Ferreira Carnevali
 *  @since 31/07/2022
 */


/**
 * É responsável pela comunicação do frontend com o backend, chamando um script php para executar uma consulta ao banco de dados.
 * 
 * A resposta dessa consulta é então consumida por uma função do frontend.
 * @param {String} url url para o código php a ser executado.
 * @param {String} method método HTTP a ser executado.
 * @param {function} callback função a ser executada com a resposta.
 * @param {String} body corpo da requisição caso método HTTP seja POST.
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

/**
 *  É responsável pela comunicação do frontend com o backend, mas apenas para a recuperação do resultado.
 *  
 *  A resposta dessa consulta é então consumida por uma função do frontend.
 * @param {String} url url para o código php a ser executado.
 * @param {String} method método HTTP a ser executado.
 * @param {function} callback função a ser executada com a resposta.
 * @param {String} body corpo da requisição caso método HTTP seja POST.
 */
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