<?php

class Conexao{

	private $conn;

	public function __construct(){
		try{
			$this->conn = new PDO("mysql:dbname=bdensinoamigo;host=localhost","root","");
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo 'erro de conexão: ' . $e->getMessage();
			exit();
		}
	}

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

///////////////////////////////////////////////////////////////////////////////////// SECRETARIA
	//funcionando sem o nivel de acesso
	public function registroSecretaria($nome,$email, $senha, $senha2){

		if($senha !=$senha2)
		{
			echo "<script Language='javascript'> 
			window.location.href='../../html/cadastro.html';
			alert('confirmação de senha incorreta')</script>";
		}
		else
		{

			$query = "SELECT * FROM secreatia WHERE email = :email";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':email', $email);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				return false; 
			}

			$stmt = $this->conn->prepare("INSERT INTO secretaria(nome, email, senha) VALUES (:nome, :email, :senha)");
			$stmt ->bindValue(":nome" , $nome);
			$stmt ->bindValue(":email" , $email);
			$stmt ->bindValue(":senha" , $senha);
			$stmt->execute();

			return true; 
        }
	}

    
	public function autenticaSecretaria($email, $senha) {
        $query = "SELECT codSecretaria, nome FROM secretaria WHERE email = :email AND senha = :senha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["nome"] = $row["nome"];
            $_SESSION["codSecretaria"] = $row["codSecretaria"]; // Armazena o codSecretaria na sessão
    
            // Adicione o var_dump aqui
            var_dump($_SESSION);
    
            return true; 
        } else {
            echo "<script Language='javascript'>
                alert('Email ou senha incorretos');
                window.location.href='../../tcc/index.php';
            </script>";
            return false; 
        }
    }

    	// Novo método para obter o codProfessor
        public function getCodSecretaria($email) {
            $query = "SELECT codSecretaria FROM secretaria WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                $secretaria = $stmt->fetch(PDO::FETCH_ASSOC);
                return $secretaria['codSecretaria'];
            }
            return null; // Retorna nulo se não encontrado
        }


///////////////////////////////////////////////////////////////////////////////////// SECRETARIA


///////////////////////////////////////////////////////////////////////////////////// PROFESSOR
	//funcionando sem o nivel de acesso
	public function registroProf($nome,$email, $senha, $senha2){

		if($senha !=$senha2)
		{
			echo "<script Language='javascript'> 
			window.location.href='../../html/cadastro.html';
			alert('confirmação de senha incorreta')</script>";
		}
		else
		{

			$query = "SELECT * FROM professores WHERE email = :email";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':email', $email);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				return false; 
			}

			$stmt = $this->conn->prepare("INSERT INTO professores(nome, email, senha) VALUES (:nome, :email, :senha)");
			$stmt ->bindValue(":nome" , $nome);
			$stmt ->bindValue(":email" , $email);
			$stmt ->bindValue(":senha" , $senha);
			$stmt->execute();

			return true; 
        }
	}

	public function autenticaProf($email, $senha) {
        $query = "SELECT codProfessor, nome FROM professores WHERE email = :email AND senha = :senha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["nome"] = $row["nome"];
            $_SESSION["codProfessor"] = $row["codProfessor"]; // Armazena o codProfessor na sessão
    
            // Adicione o var_dump aqui
            var_dump($_SESSION);
    
            return true; 
        } else {
            echo "<script Language='javascript'>
                alert('Email ou senha incorretos');
                window.location.href='../../tcc/index.php';
            </script>";
            return false; 
        }
    }
    

	// Novo método para obter o codProfessor
    public function getCodProfessor($email) {
        $query = "SELECT codProfessor FROM professores WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $professor = $stmt->fetch(PDO::FETCH_ASSOC);
            return $professor['codProfessor'];
        }
        return null; // Retorna nulo se não encontrado
    }

/////////////////////////////////////////////////////////////////////////////////////////TURMAS

 // Método para autenticar o professor com email e senha
 public function autentica($email, $senha) {
    $query = "SELECT * FROM professores WHERE email = :email AND senha = :senha";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["nome"] = $row["nome"]; // Armazena o nome do professor na sessão
        return true;    
    }
    return false; // Retorna falso se a autenticação falhar
}

// Método para registrar uma nova turma
public function registroTurma($nomeTurma, $numeroAlunos) {
    session_start(); // Inicia a sessão para acessar as variáveis

    if (!isset($_SESSION["codProfessor"])) {
        echo "Usuário não autenticado."; // Verifica se o usuário está autenticado
        return;
    }

    $codProfessor = $_SESSION["codProfessor"]; // Obtém o código do professor

    $query = "INSERT INTO turma (nomeTurma, numeroAlunos, codProfessor) VALUES (:nomeTurma, :numeroAlunos, :codProfessor)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nomeTurma', $nomeTurma);
    $stmt->bindParam(':numeroAlunos', $numeroAlunos);
    $stmt->bindParam(':codProfessor', $codProfessor);
    $stmt->execute(); // Executa a inserção da nova turma
}

// Método para exibir turmas de um professor
public function exibeTurma() {
    session_start(); // Inicia a sessão para acessar as variáveis

    if (!isset($_SESSION["codProfessor"])) {
        echo "Usuário não autenticado."; // Verifica se o usuário está autenticado
        return [];
    }

    $codProfessor = $_SESSION["codProfessor"]; // Obtém o código do professor

    $query = "SELECT codTurma, nomeTurma, numeroAlunos FROM turma WHERE codProfessor = :codProfessor";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':codProfessor', $codProfessor);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todas as turmas associadas ao professor
}

// Método para obter uma turma por seu ID
//public function getTurmaById($id) {
//    $query = "SELECT codTurma, nomeTurma, numeroAlunos FROM turma WHERE codTurma = :id";
//    $stmt = $this->conn->prepare($query);
//    $stmt->bindParam(':id', $id);
//    $stmt->execute();
//    return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna os detalhes da turma
//}

// Método para obter a conexão com o banco de dados
public function getConnection() {
    return $this->conn;
}

// Método para buscar alunos por turma
public function getAlunosByTurma($codTurma) {
    $pdo = $this->getConnection();
    $query = "SELECT codAluno, nome, dataNascimento FROM aluno WHERE codTurma = :codTurma";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':codTurma', $codTurma, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os alunos associados à turma
}

// Método para excluir um aluno
public function excluirAluno($id) {
    $query = "DELETE FROM aluno WHERE codAluno = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute(); // Executa a exclusão do aluno
}

/////////////////////////////////////////////////////////////////////////////////////////TURMAS


/////////////////////////////////////////////////////////////////////////////////////////QUESTIONARIO

public function getQuestionarioById($codQuestionario) {
    $sql = "SELECT * FROM questionario WHERE codQuestionario = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$codQuestionario]);
    return $stmt->fetch();
}

public function getPerguntasDoQuestionario($codQuestionario) {
    $sql = "SELECT * FROM perguntas WHERE codQuestionario = ? ORDER BY numeroPergunta";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$codQuestionario]);
    return $stmt->fetchAll();
}

public function getAlternativasDaPergunta($codPergunta) {
    $sql = "SELECT * FROM alternativa WHERE codPergunta = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$codPergunta]);
    return $stmt->fetchAll();
}

public function getAlternativaCorreta($codPergunta) {
    $sql = "SELECT * FROM alternativa WHERE codPergunta = :codPergunta AND status = 1"; // Ajuste conforme o nome correto
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['codPergunta' => $codPergunta]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function exibiQuestionario($codProfessor) {
    $query = "SELECT titulo, codQuestionario FROM questionario WHERE codProfessor = :codProfessor";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':codProfessor', $codProfessor);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getQuestionario()
{
    $stmt = $this->conn->query('SELECT codQuestionario, titulo, descricao FROM questionario ORDER BY codQuestionario');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getQuestionarioTitulo($codQuestionario) {
    $query = "SELECT titulo FROM questionario WHERE codQuestionario = :codQuestionario";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':codQuestionario', $codQuestionario);
    $stmt->execute();
    
    return $stmt->fetchColumn(); // Retorna o título se encontrado
}

public function getQuestionariosAtivosPorTurma($codTurma) {
    $query = "SELECT q.codQuestionario, q.titulo, q.descricao 
              FROM questionario q 
              INNER JOIN turma t ON q.codProfessor = t.codProfessor 
              WHERE t.codTurma = :codTurma AND q.statusProva = 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':codTurma', $codTurma);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getId()
{
    // Pega o último registro pela ordem decrescente de codPerguntas
    $stmt = $this->conn->query('SELECT codPerguntas FROM perguntas ORDER BY codPerguntas DESC LIMIT 1');
    
    // Pega o primeiro registro (último cadastro) e retorna o codPerguntas
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['codPerguntas'] : null;
}

public function getNomeQuestionario($cod)
{
    $stmt = $this->conn->prepare('SELECT codQuestionario, titulo, descricao FROM questionario WHERE codQuestionario = :cod');
    $stmt->bindParam(':cod', $cod);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getNomePergunta($pergunta)
{
    $stmt = $this->conn->prepare('SELECT codPerguntas, pergunta, numeroPergunta FROM perguntas WHERE codPerguntas = :perg');
    $stmt->bindParam(':perg', $pergunta);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function editaQuestionario($cod){
    $query = "SELECT titulo FROM questionario WHERE codQuestionario = :cod";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':cod', $cod);
    $stmt->execute();
}

public function insereQuestionario($titulo, $enunciado)
{
$insere = $this->conn->prepare("insert into questionario (titulo, descricao) values (:t, :e)");
$insere->bindValue(":t",$titulo);
$insere->bindValue(":e",$enunciado);
$insere->execute();
return $this->conn->lastInsertId();
echo"<script>alert('Cadastrado com sucesso!')</script>";
}

public function inserePergunta($pergunta, $numPergunta, $codQuest)
{
    $insere = $this->conn->prepare("insert into perguntas (pergunta, numeroPergunta, codQuestionario) values (:p, :np, :cq)");
    $insere->bindValue(":p",$pergunta);
    $insere->bindValue(":np",$numPergunta);
    $insere->bindValue(":cq",$codQuest);
    $insere->execute();

    return intval($this->conn->lastInsertId());
    $cod = $insere->fetchAll(PDO::FETCH_ASSOC);
   // return $cod;

    echo"<script>alert('Cadastrado com sucesso!')</script>";
}


public function insereAlternativa($alternativas, $statusCorreta, $codPergunta)
{
    // Confere se $alternativas é realmente um array
    if (!is_array($alternativas)) {
        throw new InvalidArgumentException("Alternativas deve ser um array.");
    }

    foreach ($alternativas as $index => $alternativa) {
        // Verifica se a alternativa atual é a correta
        $status = ($index + 1 == $statusCorreta) ? 1 : 0; // 1 para correta, 0 para errada

        $insere = $this->conn->prepare("INSERT INTO alternativa (alternativa, status, codPergunta) VALUES (:alt, :status, :codP)");
        $insere->bindValue(":alt", $alternativa);
        $insere->bindValue(":status", $status);
        $insere->bindValue(":codP", $codPergunta);
        $insere->execute();
    }
    echo "<script>alert('Cadastrado com sucesso!')</script>";
}


////////////////////////FUNÇÕES DE CONSULTA////////////////////////////////

        public function buscaQuestionario($codQuestionario)
        {
            $retorna = array();
            $le = $this->conn->prepare ("SELECT * FROM questionario where codQuestionario = :c");
            $le -> bindParam(":c", $codQuestionario);
            $le->execute();
            $retorna = $le->fetchAll(PDO::FETCH_ASSOC);
            return $retorna;
        }
   
/////////////////////////////////////////////////////////////////////////////////////////PROFESSOR



////////////////////////////////////////////////////////////////////////////////////////ALUNO

    public function autenticaAluno($ra, $data) {
        $query = "SELECT codAluno, codTurma FROM aluno WHERE ra = :ra AND dataNascimento = :data";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ra', $ra);
        $stmt->bindParam(':data', $data);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }    


public function getAlunos(){
    $stmt = $this->conn->query('SELECT a.nome AS nome_aluno, a.ra, t.nomeTurma 
                                FROM aluno a 
                                JOIN turma t 
                                ON a.codTurma = t.codTurma;');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



	public function registroAluno($nomeAluno, $dataNascimento, $grauTEA, $codTurma) {
        session_start(); // Inicia a sessão para acessar as variáveis
    
        $profQuery = "SELECT codProfessor FROM professores WHERE email = :email";
        $stmt2 = $this->conn->prepare($profQuery);
        $stmt2->bindParam(':email', $email);
        $stmt2->execute();

        if($stmt2->rowCount() > 0)
        {
            $professor = $stmt2->fetch(PDO::FETCH_ASSOC);
            $codProfessor = $professor['codProfessor'];
    
        $query = "INSERT INTO aluno (nome, dataNascimento, grauTEA, codTurma, codProfessor) VALUES (:nomeAluno, :dataNascimento, :grauTEA, :codTurma, :codProfessor)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nomeAluno', $nomeAluno);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        $stmt->bindParam(':grauTEA', $grauTEA);
        $stmt->bindParam(':codTurma', $codTurma);
        $stmt->bindParam(':codProfessor', $codProfessor);
        $stmt->execute();
    }
    else {
       
        echo "Usuário não encontrado.";
    }
}

	public function exibeAluno() {
        session_start(); // Inicia a sessão para acessar as variáveis
    
        if (!isset($_SESSION["codProfessor"])) {
            echo "Usuário não autenticado.";
            return [];
        }
    
        $codProfessor = $_SESSION["codProfessor"];
    
        $query = "SELECT codAluno, nome, dataNascimento, codTurma FROM aluno WHERE codProfessor = :codProfessor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codProfessor', $codProfessor);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function getAlunoById($id) {
        $query = "SELECT codAluno, nome, dataNascimento, codTurma FROM aluno WHERE codAluno = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
	public function selectTurma() {
        $seleciona = $this->conn->prepare("SELECT * FROM turma ORDER BY nomeTurma ASC");
        $seleciona->execute();
        return $seleciona->fetchAll(PDO::FETCH_ASSOC);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////ALUNO
}

?>