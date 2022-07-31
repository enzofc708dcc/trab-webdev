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