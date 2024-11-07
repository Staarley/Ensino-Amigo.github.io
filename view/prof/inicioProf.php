<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inicioProf.css">
    <title>Inicio | Ensino Amigo</title>
</head>
<body>
    <section>
        <!-- Linha superior com ícones de perfil e redes sociais -->
        <div class="linhaVermelha">
        </div>

        <!-- Elemento gráfico (arco-íris) no canto superior -->
        <div class="arcoIris">
            <div class="azul"></div>
            <div class="amarelo"></div>
            <div class="vermelho"></div>
        </div>

        <!-- Início da Navbar -->
        <nav>
            <div class="nav-content">
                <!-- Botão para a página de Alunos -->
                <div class="button">
                    <a href="boletim.php">
                        <button class="btnAlunos btnNav">Alunos</button>
                    </a>
                </div>

                <!-- Botão para a página inicial -->
                <div class="button">
                    <a href="#">
                        <button class="btnInicio btnNav">Início</button>
                    </a>
                </div>

                <!-- Dropdown para cadastro -->
                <div class="dropdown">
                    <a href="questPHP/consulQuest.php">
                        <button class="btnCadastro btnNav">Questionario</button>
                    </a>
                </div>

                <div class="dropdown">
                    <a href="iniciarQuest.php">
                        <button class="btnQuest btnNav">Dê o play</button>
                    </a>
                </div>

                <div class="dropdown">
                    <a href="../../../login.php">
                        <button class="btnAmarelo btnNav">Sair</button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Fim da Navbar -->

        <!-- Conteúdo principal -->
        <main>
            <div class="container">
                <div class="box">
                    <div class="row">
                        <!-- Texto de boas-vindas e descrição da plataforma -->
                        <div class="boxtext">
                            <img src="../image/globo.png" alt="Logo Ensino Amigo">
                            <span class="txtlogo">Ensino Amigo</span>
                            <br/>
                            <span class="title">Ajudando no ensino de nossas Crianças</span>
                            <br/><br/>
                            <span class="text">
                                Bem-vindo, uma plataforma inovadora desenvolvida especialmente para auxiliar professores na gestão e no ensino de seus alunos de forma prática e eficiente. 
                                Nosso objetivo é simplificar a experiência educacional, oferecendo ferramentas que permitem um acompanhamento mais próximo e organizado do progresso dos alunos.
                                <br/><br/>
                                Com nosso website, os professores podem facilmente:<br/><br/>
                                Cadastrar Alunos: Adicione e gerencie informações dos alunos de forma rápida, garantindo que todos os dados estejam sempre atualizados.<br/><br/>
                                Organizar Turmas: Crie e gerencie turmas, facilitando a organização das atividades e o acompanhamento do desempenho dos estudantes.<br/><br/>
                                Criar Questionários: Desenvolva questionários personalizados para avaliar o aprendizado dos alunos, proporcionando feedback imediato e ajudando a identificar áreas que necessitam de atenção.<br/><br/>
                                Acreditamos que a tecnologia pode transformar a educação, e nosso projeto visa proporcionar uma solução prática que suporte os professores em suas atividades diárias. Junte-se a nós nessa jornada de inovação e melhore a experiência de ensino e aprendizado!
                            </span>
                        </div>
                        <br/>
                        <!-- Botão para a página de cadastro de alunos -->
                        <div class="btn">
                            <a href="questPHP/consulQuest.php">
                                <button class="btnSobreCad btnSobre"><span>Questionario</span></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>
</html>
