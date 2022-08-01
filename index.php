<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urna Eletrônica</title>
  <script src="util.js"></script>
  <script src="script.js" defer></script>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="tela.css">
</head>
<body>
  <h1>Urna Eletrônica</h1>

  <div class="urna-area">
    <div class="urna">
      <div class="tela">
        <div class="principal">
          <div class="esquerda">
            <div class="rotulo r1">
              <span>Seu voto para</span>
            </div>
            <div class="rotulo r2">
              <span>Cargo</span>
            </div>
            <div class="rotulo r3">
              <div class="numero pisca"></div>
              <div class="numero"></div>
            </div>
            <div class="rotulo r4">
              <div class="mensagem"></div>
              <p class="nome-candidato">Nome: <span>Fulano de Tal</span></p>
              <p class="partido-politico">Partido: <span>XXXX</span></p>
              <p class="nome-vice">Vice-Prefeito: <span>Ciclano de Tal</span></p>
            </div>
          </div>
          <div class="direita">
            <div class="candidato">
              <div class="imagem">
                <img src="" alt="Candidato">
              </div>
              <div class="cargo">
                <p>Prefeito</p>
              </div>
            </div>
            <div class="candidato menor">
              <div class="imagem">
                <img src="" alt="Vice">
              </div>
              <div class="cargo">
                <p>Vice-Prefeito</p>
              </div>
            </div>
          </div>
        </div>
        <div class="rodape">
          <p>
            Aperte a tecla<br>
            CONFIRMA para CONFIRMAR este voto<br>
            CORRIGE para REINICIAR este voto.
          </p>
        </div>
      </div>

      <div class="lateral">
        <div class="logoarea">
          <img src="https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/brasao.png?v=1659025864341" alt="Brasão da República">
          <h2>Justiça Eleitoral</h2>
        </div>

        <div class="teclado">
          <div class="teclado--linha">
            <div class="teclado--botao">1</div>
            <div class="teclado--botao">2</div>
            <div class="teclado--botao">3</div>
          </div>
          <div class="teclado--linha">
            <div class="teclado--botao">4</div>
            <div class="teclado--botao">5</div>
            <div class="teclado--botao">6</div>
          </div>
          <div class="teclado--linha">
            <div class="teclado--botao">7</div>
            <div class="teclado--botao">8</div>
            <div class="teclado--botao">9</div>
          </div>
          <div class="teclado--linha">
            <div class="teclado--botao">0</div>
          </div>
          <div class="teclado--linha">
            <div class="teclado--botao especial branco">Branco</div>
            <div class="teclado--botao especial laranja">Corrige</div>
            <div class="teclado--botao especial verde">Confirma</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <button class="botao" onclick="resultado()">
    Resultado
  </button>
  <div id="resultado"></div>

  <div id="dochtml"><a href="https://trab-webdev.herokuapp.com/Documentacao JavaScript/index.html">Documentação JavaScript</a></div>
  <div id="docphp"><a href="https://trab-webdev.herokuapp.com/Documentacao PHP\html\index.html">Documentação PHP</a></div>
</body>
</html>