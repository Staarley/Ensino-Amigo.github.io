<?php
//verificar para o usuario não entrar direto nessa pagina e ser obrigado a fazer login
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['email']))
{
session_destroy();

echo"<script Language='javascript'> window.location.href='../../../index.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inicioProf.css">
    <title>Inicio</title>
</head>
<body>
    <div class="container">
        <section>
            
            <div class="linhaVermelha"></div>

           <!-- Abrindo Navbar -->
           <nav>
                <div class="dropdown">
                    <button class="btnAlunos">Alunos</button>
                    <div class="dropdown-content alunos-dropdown">
                        <a href="../php/cadAluno.php">Alunos</a>
                    </div>
                </div>

                <div class="button">
                    <a href="#">
                        <button class="btnInicio">Inicio</button>
                    </a>
                </div>

                <div class="dropdown">
                    <button class="btnCadastro">Cadastro</button>
                    <div class="dropdown-content cadastro-dropdown">
                        <a href="../php/cadAluno.php">Alunos</a>
                        <a href="cadTurmas.php">Turmas</a>
                        <a href="cadQuest.php">Questionário</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btnSecretaria">Secretaria</button>
                    <div class="dropdown-content secretaria-dropdown">
                        <a href="#">Secretaria</a>
                        <a href="#">Secretaria</a>
                        <a href="#">Secretaria</a>
                    </div>
                </div>
            </nav>

            <!-- fechando Navbar -->
            
             <!-- Abrindo Arco-Iris -->
            <div class="arcoIris">
                <div class="azul">
                    <div class="amarelo">
                        <div class="vermelho">
                            <div class="branco">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fechando Arco-Iris -->

            <!-- Fechando Conteudo -->
        <main>
            <div class="row">
            <div id="Logo"><img src="../img/baixados.png" alt="">Ensino Amigo</div>
                <div class="sobre-nos"> 

                    <div class="texto-sobrenos">
                        <h1>Chega de sofrer com pilhas de papéis durante a correção de provas!</h1><br/><br/><br/>
                        <p>Com o Ensino Amigo, você pode criar e personalizar seus próprios questionários de maneira prática, obtendo resultados de forma automática e dinâmica. Facilite seu processo de avaliação e tenha mais tempo para o que realmente importa: o ensino de qualidade.</p>
                    </div>
                   

                    <div class="card">
                        <div id="logoMenor"><img src="../img/baixados.png" alt=""></div>
                        <div class="carcoIris">
                            <div class="cazul">
                                <div class="camarelo">
                                    <div class="cvermelho">
                                        <div class="ctransparent">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="../img/cacheado.png" alt="garotopropaganda" id="cacheado">
                        <div class="card__content">
                        <p class="card__title">Ensino Amigo</p>
                        <p class="card__description"></p>    Nas escolas brasileiras, muitos alunos com Transtorno do Espectro Autista (TEA) enfrentam dificuldades durante as aulas devido à falta de preparo dos professores para lidar com esses casos em sala de aula. <br><br>    Alguns alunos da ETEC de Franco da Rocha (Dr. Emilío Hernandéz Aguilar) reconheceram essa necessidade e desenvolveram o Ensino Amigo, uma plataforma inovadora que oferece suporte aos professores, permitindo que todos os alunos participem das aulas de forma inclusiva. Por meio de jogos e perguntas adaptados às necessidades individuais de cada aluno, incluindo aqueles com TEA, o Ensino Amigo busca promover uma educação mais acessível e eficaz para todos.</p>
                        </div>
                    </div>
                    

                </div>
            </div>
        </main>
         <!-- Fechando Conteudo -->

        </section>
    </div>
</body>
</html>