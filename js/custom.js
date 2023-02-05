function msgSucesso(type, title, msg) {
    swal.fire({
        icon: type,
        title: title,
        text: msg,
        showConfirmButton: false,
        timer: 1500
      })
}

function msgErro(type, title, msg) {
    swal.fire({
        icon: type,
        title: title,
        text: msg,
        showConfirmButton: false,
        timer: 3000
      })
}

function msgBotao(type, title, msg) {
    swal.fire({
        icon: type,
        title: title,
        text: msg,
      })
}

function msgLink(type, title, msg, link, linknome) {
    swal.fire({
        icon: type,
        title: title,
        text: msg,
        footer: '<a href="'+link+'">'+linknome+'</a>'
      })
}

/*const cadUsuarioForm = document.getElementById("formulario-1");

if(cadUsuarioForm){
    cadUsuarioForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dadosForm = new FormData(cadUsuarioForm);
        
        const dados = await fetch("./dados.php", {
            method: "POST",
            body: dadosForm
        });

        //console.log("Cadastrar");

        const resposta = await dados.json();
        console.log(resposta);

    });

}*/
