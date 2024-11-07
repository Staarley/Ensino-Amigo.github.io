<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../tcc/view/css/cadastroSec.css">
    <title>Entrar | Ensino Amigo</title>
</head>
<body>
    <section>

    <div class="linhaVermelha"></div>
        
        <div class="arcoIris">
                <div class="azul"></div>
                <div class="amarelo"></div>
                <div class="vermelho"></div>
        </div>

        <!-- Abrindo Navbar -->
        <nav>
            <div class="nav-content">
                <div class="button"><a href="../tcc/view/login/loginAluno.php"><button class="btnCadastrar btnNav">Portal do Aluno</button></a></div>
                <div class="button"><button class="btnProfessor btnNav">Entrar como Professor</button></div>
                <div class="button"><button class="btnSecretaria btnNav">Entrar como Secretaria</button></div>
            </div>
        </nav>

        <main>

        <div class="container">
                
                <div class="box">
                    <div class="row">

                    <div class="boxtext">
                        <img src="../image/globo.png" alt=""><span class="txtlogo">Ensino amigo</span>
                    <br/>
                        <span class="title">Já pensou em gerenciar sua aula com uma
                                                plataforma compacta e inclusiva? Pois é,
                                                você acabou de nos encontrar</span>
                        <br/><br/>
                        <span class="text"><span>Realize o cadastro e vem com a gente!</span>
                    </div>
                </div>
            </div>
        </div>

       
         <div class="forms">
             <!-- Div para formulário do Professor -->
        <div class="formDiv" id="divFormProfessor">
        <form action="../tcc/controller/autenticaProf.php" method="post" class="">
                <h2>Login professor</h2>

                <label for="nomeUsuario">Email:</label>
                <input type="email" name="email" class="edtNomeUsu" id="edtNomeUsu" placeholder="Digite o e-mail">

                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="edtSenha" placeholder="Crie uma senha">

                <center>
                        <button class="btnCadastrar btnNav">Entrar</button>
                </center>

                <p class="pLogin">Não possui login ? <br> realize o <a href="inicioLogin.html">cadastro</a></p>


            </form>
        </div>

        <!-- Div para formulário da Secretaria -->
        <div class="formDiv hidden" id="divFormSecretaria">
        <form action="../tcc/controller/autenticaSecretaria.php" method="post" class="">
                <h2>Login secretaria</h2>

                <label for="nomeUsuario">Email:</label>
                <input type="email" name="email" class="edtNomeUsu" id="edtNomeUsu" placeholder="Digite seu e-mail">

                <label for="senha">Senha</label>
                <input type="password" name="senha" id="edtSenha" placeholder="Digite sua senha">

                <center>
                        <button class="btnCadastrar btnNav">Entrar</button>
                </center>

                <p class="pLogin">Não possui login ? <br> realize o <a href="inicioLogin.html">cadastro</a></p>


            </form>
        </div>
        </div>

        <div class="divPersonagens">
            <img src="../image/vania.png" class="imgPersonagens" alt="Imagem personagem Vânia" title="Vânia">
            <img src="../image/sophia.png" class="imgPersonagens" alt="Imagem personagem Sophia" title="Sophia">
            <img src="../image/beto.png" class="imgPersonagens" alt="Imagem personagem Beto" title="Beto">
            <img src="../image/chico.png" class="imgPersonagens" alt="Imagem personagem Chico" title="Chico">
        </div>
        
       </main>

    <section>
    <script type="text/javascript" src="../tcc/view/scripts/telaLogins.js"></script>
</body>
</html>
