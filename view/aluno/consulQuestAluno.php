<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/consulta.css">
    <title>Questionario | Ensino Amigo</title>
</head>
<body>
    <section>
        <!-- Linha superior com ícones e opções de perfil -->
        <div class="linhaVermelha">
        </div>

        <!-- Elemento gráfico (arco-íris) no canto superior direito -->
        <div class="arcoIris">
            <div class="azul"></div>
            <div class="amarelo"></div>
            <div class="vermelho"></div>
        </div>

        <!-- Início da Navbar -->
        <nav>
            <div class="nav-content">
                <!-- Botão para voltar à página inicial do aluno -->
                <div class="button">
                    <a href="inicioAluno.php">
                        <button class="btnInicio btnNav">Início</button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Fim da Navbar -->

        <main>

        <div class="distance">
                <div class="box" id="mainBox">
                    <h2>Consulta Questionarios</h2>
                    <div class="consul-list">
                        <!-- Lista de turmas cadastradas com barra de rolagem -->
                        <div class="consu-item">
                            Questionario 1
                            <div>
                                <a href="quest.php">
                                    <button type="button" class="btnList btnListAzul">Iniciar</button>
                                </a>
                            </div>
                        </div>
                        <div class="consu-item">
                            Questionario 2
                            <div>
                                <a href="quest.php">
                                    <button type="button" class="btnList btnListAzul">Iniciar</button>
                                </a>
                            </div>
                        </div>
                        <div class="consu-item">
                            Questionario 3
                            <div>
                                <a href="quest.php">
                                    <button type="button" class="btnList btnListAzul">Iniciar</button>
                                </a>
                            </div>
                        </div>
                        <div class="consu-item">
                            Questionario 4
                            <div>
                                <a href="quest.php">
                                    <button type="button" class="btnList btnListAzul">Iniciar</button>
                                </a>
                            </div>
                        </div>
                        <div class="consu-item">
                            Questionario 5
                            <div>
                                <a href="quest.php">
                                    <button type="button" class="btnList btnListAzul">Iniciar</button>
                                </a>
                            </div>
                        </div>
                        <div class="consu-item">
                            Questionario 6
                            <div>
                                <a href="quest.php">
                                    <button type="button" class="btnList btnListAzul">Iniciar</button>
                                </a>
                            </div>
                        </div>
                        <div class="consu-item">
                            Questionario 7
                            <div>
                                <a href="quest.php">
                                    <button type="button" class="btnList btnListAzul">Iniciar</button>
                                </a>
                            </div>
                        </div>
                        <!-- Adicione mais turmas conforme necessário -->
                    </div>
                </div>

</div>
    </div>
    <!-- Script para abrir e fechar o modal -->
    <script>
        function openModal() {
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</body>
</html>
