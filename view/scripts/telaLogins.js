document.addEventListener('DOMContentLoaded', function () {
    const btnSecretaria = document.querySelector('.btnSecretaria');
    const btnProfessor = document.querySelector('.btnProfessor');
    const divFormProfessor = document.getElementById('divFormProfessor');
    const divFormSecretaria = document.getElementById('divFormSecretaria');


    // Função para exibir a div da Secretaria e ocultar a do Professor
    btnSecretaria.addEventListener('click', function () {
        divFormSecretaria.classList.remove('hidden');
        divFormProfessor.classList.add('hidden');
    });

    // Função para exibir a div do Professor e ocultar a da Secretaria
    btnProfessor.addEventListener('click', function () {
        divFormProfessor.classList.remove('hidden');
        divFormSecretaria.classList.add('hidden');
    });
});
