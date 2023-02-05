function downloadPDF() {
    const item = document.querySelector(".sistema-conteudo-tabela");

    var opt = {
        //margin: 1,
        filename: "tabela.pdf",
        //html2canvas: { scale: 2},
        jsPDF: { unit: "in", format: "letter", orientation: "portrait"},
    };

    html2pdf().set(opt).from(item).save();
}