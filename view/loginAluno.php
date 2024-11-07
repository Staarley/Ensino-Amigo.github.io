    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

        <meta name="HandheldFriendly" content="true">
        <meta name="MobileOptimized" content="320">

        <link rel="stylesheet" href="../view/css/loginAlunoStyle.css">
        <link rel="shortcut icon" href="img/logo.icon" type="image/x-icon">
        <title>Ensino Amigo</title>
    </head>
    <body>
        <div class="container">
            <div class="designLinha"></div>

            <div class="card">
                <img src="/img/logomenor.png" alt="logoMenor" id="logoMenor" >
                <div class="arcoIris">
                    <div class="azul">
                        <div class="amarelo">
                            <div class="vermelho">
                                <div class="transparent">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="/img/cacheado.png" alt="garotopropaganda" id="cacheado">
                <div class="card__content">
                <p class="card__title">Ensino Amigo</p>
                <p class="card__description"></p>    Nas escolas brasileiras, muitos alunos com Transtorno do Espectro Autista (TEA) enfrentam dificuldades durante as aulas devido à falta de preparo dos professores para lidar com esses casos em sala de aula. <br><br>    Alguns alunos da ETEC de Franco da Rocha (Dr. Emilío Hernandéz Aguilar) reconheceram essa necessidade e desenvolveram o Ensino Amigo, uma plataforma inovadora que oferece suporte aos professores, permitindo que todos os alunos participem das aulas de forma inclusiva. Por meio de jogos e perguntas adaptados às necessidades individuais de cada aluno, incluindo aqueles com TEA, o Ensino Amigo busca promover uma educação mais acessível e eficaz para todos.</p>
                </div>
            </div>

            <div class="formContainer">
                <form class="formCadastro" method="">
                    <div class="cArcoIris">
                        <div class="cAzul">
                            <div class="cAmarelo">
                                <div class="cVermelho">
                                    <div class="cTransparent">
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="img/logomenor.png" alt="logo" id="logoMenor" title="Ensino Amigo">
                    <h2>Entre com sua conta</h2>
                    <label for="username">RA</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Data de nascimento</label>
                    <input type="date" id="password" name="password" required>

                    <button type="submit">Entrar</button>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('gesturestart', function(e) {
                e.preventDefault();
            });

            document.addEventListener('touchstart', function(event) {
                if (event.touches.length > 1) {
                    event.preventDefault();
                }
            }, { passive: false });

            document.addEventListener('touchmove', function(event) {
                if (event.scale !== 1) {
                    event.preventDefault();
                }
            }, { passive: false });
        </script>

    </body>
    </html>