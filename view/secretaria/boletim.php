<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/boletim.css">
    <title>Início</title>
</head>
<body>
    <section>
        <!-- Linha vermelha com ícones e perfil -->
        <div class="linhaVermelha">
        </div>

        <!-- Elementos de arco-íris -->
        <div class="arcoIris">
            <div class="azul"></div>
            <div class="amarelo"></div>
            <div class="vermelho"></div>
        </div>

        <!-- Navbar -->
        <nav>
            <div class="nav-content">
                <div>
                    <a href="#">
                        <button class="btnAlunos btnNav">Alunos</button>
                    </a>
                </div>

                <div>
                    <a href="inicioSec.php">
                        <button class="btnInicio btnNav">Início</button>
                    </a>
                </div>

                <div class="dropdown">
                    <button class="btnCadastro btnNav">Cadastro</button>
                    <div class="dropdown-content cadastro-dropdown">
                        <a href="profPHP/consulProf.php">Professores</a>
                        <a href="alunoPHP/consulAluno.php">Alunos</a>
                        <a href="turmaPHP/consulTurma.php">Turmas</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a href="../../../login.php">
                        <button class="btnAmarelo btnNav">Sair</button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Fim da navbar -->

        <main>
            
        </main>

    </section>
</body>
</html>
