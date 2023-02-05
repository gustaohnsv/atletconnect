const botao = document.querySelector('.cabecalho-botao');
const popup = document.querySelector('.cadastro');
const site = document.querySelector('body');
const botaofechar = document.querySelector('.cadastro-popup-fechar');
const botaovoltar = document.querySelector('.cadastro-popup-formulario-voltar');

botao.addEventListener('click', () => {
    console.log('Popup aberto.');
    popup.style.display = 'flex';
    site.style.overflowY = 'hidden';
});

botaofechar.addEventListener('click', () => {
    console.log('Popup fechado.')
    popup.style.display = 'none';
    site.style.overflowY = 'auto';
    $("#nome, #sobrenome, #datanasc, #rg, #email-cadastro, #rm, #senha-cadastro, #senha-cadastro-confirmar, #celular, #turno, #curso, #serie").val("");
});

botaovoltar.addEventListener('click', () => {
    console.log('Popup fechado.');
    popup.style.display = 'none';
    site.style.overflowY = 'auto';
    $("#nome, #sobrenome, #datanasc, #rg, #email-cadastro, #rm, #senha-cadastro, #senha-cadastro-confirmar, #celular, #turno, #curso, #serie").val("");
})