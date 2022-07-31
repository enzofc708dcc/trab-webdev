/**
 * @file script.js
 *
 * Summary.
 * <p>Responsável pelo funcionamento e da interação do frontend com o usuário</p>
 *
 *  Description.
 *  <p>Essa classe serve para processar os toques nos botões pelo usuário, além da exibição de fotos, nomes e números dos candidatos.</p>
 *
 * @link      https://github.com/enzofc708dcc/trab-webdev/blob/master/script.js
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/resultado.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/registra_voto.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/index.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/fill_json.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/util.js
 *  @author Paulo Roma, adaptado por Felipe Pestana Rosa e Enzo Ferreira Carnevali
 *  @since 31/07/2022
 */


const rVotoPara = document.querySelector('.esquerda .rotulo.r1 span')
const rCargo = document.querySelector('.esquerda .rotulo.r2 span')
const numeros = document.querySelector('.esquerda .rotulo.r3')
const rDescricao = document.querySelector('.esquerda .rotulo.r4')
const rMensagem = document.querySelector('.esquerda .rotulo.r4 .mensagem')
const rNomeCandidato = document.querySelector('.esquerda .rotulo.r4 .nome-candidato')
const rPartidoPolitico = document.querySelector('.esquerda .rotulo.r4 .partido-politico')
const rNomeVice = document.querySelector('.esquerda .rotulo.r4 .nome-vice')
const rRodape = document.querySelector('.tela .rodape')

const rCandidato = document.querySelector('.direita .candidato')
const rVice = document.querySelector('.direita .candidato.menor')

const votos = []

if(localStorage.votosV == null){
  localStorage.votosV = ""
}

if(localStorage.votosP == null){
  localStorage.votosP = ""
}

var votosV;
var votosP;

var etapaAtual = 0
var etapas = null
var numeroDigitado = ''
var votoEmBranco = false

var resultResp = null

/**
 * Chama o ajax para fazer consultas do banco de dados
 */
ajax(`fill_json.php`, 'GET', (response) => {
  etapas = JSON.parse(response)
  console.log(etapas)

  comecarEtapa()
})



window.onload = () => {
  let btns = document.querySelectorAll('.teclado--botao')
  for (let btn of btns) {
    btn.onclick = () => {
      clicar(btn.innerHTML)
    }
  }

  document.querySelector('.teclado--botao.branco').onclick = () => branco()
  document.querySelector('.teclado--botao.laranja').onclick = () => corrigir()
  document.querySelector('.teclado--botao.verde').onclick = () => confirmar()
}

/**
 * Inicia a etapa atual da votação.
 */
function comecarEtapa() {
  let etapa = etapas[etapaAtual]
  console.log('Etapa atual: ' + etapa['titulo'])

  numeroDigitado = ''
  votoEmBranco = false

  numeros.style.display = 'flex'
  numeros.innerHTML = ''
  rVotoPara.style.display = 'none'
  rCandidato.style.display = 'none'
  rVice.style.display = 'none'
  rDescricao.style.display = 'none'
  rMensagem.style.display = 'none'
  rNomeCandidato.style.display = 'none'
  rPartidoPolitico.style.display = 'none'
  rNomeVice.style.display = 'none'
  rRodape.style.display = 'none'

  for (let i = 0; i < etapa['numeros']; i++) {
    let pisca = i == 0 ? ' pisca' : ''
    numeros.innerHTML += `
      <div class="numero${pisca}"></div>
    `
  }

  rCargo.innerHTML = etapa['titulo']
}

/**
 * Procura o candidato pelo número digitado,
 * se encontrar, mostra os dados dele na tela.
 */
function atualizarInterface() {
  console.log('Número Digitado:', numeroDigitado)

  let etapa = etapas[etapaAtual]
  let candidato = null

  for (let num in etapa['candidatos']) {
    if (num == numeroDigitado) {
      candidato = etapa['candidatos'][num]
      break
    }
  }

  console.log('Candidato: ' + candidato)

  rVotoPara.style.display = 'inline'
  rDescricao.style.display = 'block'
  rNomeCandidato.style.display = 'block'
  rPartidoPolitico.style.display = 'block'

  if (candidato) {
    let vice = candidato['vice']

    rRodape.style.display = 'block'
    rNomeCandidato.querySelector('span').innerHTML = candidato['nome']
    rPartidoPolitico.querySelector('span').innerHTML = candidato['partido']

    rCandidato.style.display = 'block'
    rCandidato.querySelector('.imagem img').src = candidato['foto']
    rCandidato.querySelector('.cargo p').innerHTML = etapa['titulo']
    
    if (vice) {
      rNomeVice.style.display = 'block'
      rNomeVice.querySelector('span').innerHTML = vice['nome']
      rVice.style.display = 'block'
      rVice.querySelector('.imagem img').src = vice['foto']
    } else {
      rNomeVice.style.display = 'none'
    }

    return
  }

  if (votoEmBranco) return

  // Anular o voto
  rNomeCandidato.style.display = 'none'
  rPartidoPolitico.style.display = 'none'
  rNomeVice.style.display = 'none'

  rMensagem.style.display = 'block'
  rMensagem.classList.add('pisca')
  rMensagem.innerHTML = 'VOTO NULO'
}

/**
 * Verifica se pode usar o teclado e atualiza o número.
 */
function clicar(value) {
  console.log(value)

  let elNum = document.querySelector('.esquerda .rotulo.r3 .numero.pisca')
  if (elNum && ! votoEmBranco) {
    numeroDigitado += (value)
    elNum.innerHTML = value
    elNum.classList.remove('pisca')

    let proximoNumero = elNum.nextElementSibling
    if (proximoNumero) {
      proximoNumero.classList.add('pisca')
    } else {
      atualizarInterface()
    }

    (new Audio('https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/se1.mp3?v=1659025929936')).play()
  }
}

/**
 * Verifica se há número digitado, se não,
 * vota em branco.
 */
function branco() {
  console.log('branco')
  
  // Verifica se há algum número digitado,
  // se sim, não vota
  if (! numeroDigitado) {
    votoEmBranco = true

    numeros.style.display = 'none'
    rVotoPara.style.display = 'inline'
    rDescricao.style.display = 'block'
    rMensagem.style.display = 'block'
    rMensagem.innerHTML = 'VOTO EM BRANCO';

    (new Audio('https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/se1.mp3?v=1659025929936')).play()
  }

}

/**
 * Reinicia a etapa atual.
 */
function corrigir() {
  console.log('corrigir');
  (new Audio('https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/se2.mp3?v=1659025985101')).play()
  comecarEtapa()
}

/**
 * Confirma o numero selecionado.
 */
function confirmar() {
  console.log('confirmar')

  let etapa = etapas[etapaAtual]

  if (numeroDigitado.length == etapa['numeros']) {
    if (etapa['candidatos'][numeroDigitado]) {
      jsonRequest = JSON.stringify({"numero":numeroDigitado, "titulo":etapa['titulo']});
      console.log(jsonRequest);
      ajax(`registra_voto.php`, 'POST', () => {}, jsonRequest);
      console.log(`Votou em ${numeroDigitado}`)
    } else {
      jsonRequest = JSON.stringify({"numero":"nulo", "titulo":etapa['titulo']});
      ajax(`registra_voto.php`, 'POST', () => {}, jsonRequest);
      console.log('Votou Nulo')
    }
  } else if (votoEmBranco) {
    // Votou em branco
      jsonRequest = JSON.stringify({"numero":"branco", "titulo":etapa['titulo']});
      ajax(`registra_voto.php`, 'POST', () => {}, jsonRequest);
      console.log('Votou em Branco')
  } else {
    // Voto não pode ser confirmado
    console.log('Voto não pode ser confirmado')
    return
  }

  if (etapas[etapaAtual + 1]) {
    etapaAtual++
  } else {
    document.querySelector('.tela').innerHTML = `
      <div class="fim">FIM</div>
    `
  }

  (new Audio('https://cdn.glitch.global/f92a5083-3c9d-44ad-9c28-36ed56ff4e7e/se3.mp3?v=1659025987654')).play()
  comecarEtapa()
}

function getOccurrence(array, value) {
    var count = 0;
    array.forEach((v) => (v === value && count++));
    return count;
}

/**
 * Retorna o resultado da votação e o imprime na tela
 */
function resultado(){
  ajaxNotAsync(`resultado.php`, 'GET', (response) => {
    resultResp = JSON.parse(response)
    console.log(resultResp)
  });

  document.getElementById("resultado").innerHTML = "Prefeito: " + (resultResp["prefeito"]["result"] == "vitoria" ? (resultResp["prefeito"]["vencedor"] + `. (${resultResp["prefeito"]["numVotos"]} votos)`) : (resultResp["prefeito"]["result"] == "empate" ? `Houve um empate na eleição para prefeitos entre os candidatos: ${Object.values(resultResp["prefeito"]["vencedor"]).join(", ")}. (${resultResp["prefeito"]["numVotos"]} votos.)` : "Erro")) + 
  ".<br> Vice: " + (resultResp["prefeito"]["result"] == "vitoria" ? resultResp["prefeito"]["vice"] : (resultResp["prefeito"]["result"] == "empate" ? "Houve um empate na eleição para prefeitos" : "Erro")) + 
  ".<br> Vereador: " + (resultResp["vereador"]["result"] == "vitoria" ? (resultResp["vereador"]["vencedor"] + `(${resultResp["vereador"]["numVotos"]} votos)`) : (resultResp["vereador"]["result"] == "empate" ? `Houve um empate na eleição para vereadores entre os candidatos: ${Object.values(resultResp["vereador"]["vencedor"]).join(", ")}. (${resultResp["vereador"]["numVotos"]} votos.)` : "Erro"));
}