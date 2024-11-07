document.addEventListener("DOMContentLoaded", function () {
    // Seleciona os links e formulários
    const linkCadastro = document.querySelector(".pCadastro a");
    const linkLogin = document.querySelector(".pLogin a");
    const formLogin = document.getElementById("divFormSecretariaLogin");
    const formCadastro = document.getElementById("divFormSecretariaCadastro");

    // Função para alternar visibilidade dos formulários
    function toggleFormVisibility(showCadastro) {
        if (showCadastro) {
            formCadastro.classList.remove("hidden");
            formLogin.classList.add("hidden");
        } else {
            formLogin.classList.remove("hidden");
            formCadastro.classList.add("hidden");
        }
    }

    // Eventos de clique para alternar formulários
    linkCadastro.addEventListener("click", function (event) {
        event.preventDefault(); // Evita o comportamento padrão do link
        toggleFormVisibility(true); // Exibe o formulário de cadastro
    });

    linkLogin.addEventListener("click", function (event) {
        event.preventDefault(); // Evita o comportamento padrão do link
        toggleFormVisibility(false); // Exibe o formulário de login
    });
});
