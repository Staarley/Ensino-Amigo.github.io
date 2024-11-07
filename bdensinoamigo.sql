-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/11/2024 às 05:01
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdensinoamigo`
--
CREATE DATABASE IF NOT EXISTS `bdensinoamigo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdensinoamigo`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alternativa`
--

CREATE TABLE `alternativa` (
  `codAlternativa` int(11) NOT NULL,
  `alternativa` varchar(4000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `codPergunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alternativa`
--

INSERT INTO `alternativa` (`codAlternativa`, `alternativa`, `status`, `codPergunta`) VALUES
(1, 'alternativa1', 0, 17),
(2, 'alternativa2', 0, 17),
(3, 'alternativa3', 0, 17),
(4, 'alternativa4', 1, 17),
(5, 'alternativa2 1', 0, 21),
(6, 'alternativa2 2', 0, 21),
(7, 'alternativa2 3', 0, 21),
(8, 'alternativa2 4', 1, 21),
(9, 'alternativa3 1', 0, 22),
(10, 'alternativa3 2', 0, 22),
(11, 'alternativa3 3', 0, 22),
(12, 'alternativa3 4', 1, 22);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `codAluno` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ra` varchar(20) NOT NULL,
  `dataNascimento` date NOT NULL,
  `grauTEA` int(11) NOT NULL,
  `codTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`codAluno`, `nome`, `ra`, `dataNascimento`, `grauTEA`, `codTurma`) VALUES
(10, 'Felipe', '123456789', '2006-10-20', 1, 5),
(11, 'Marina', '456789123', '2006-10-21', 1, 5),
(12, 'Samuel', '987654312', '2006-10-22', 1, 5),
(13, 'Luiz', '978645312', '2006-10-23', 1, 5),
(14, 'Ygor', '645978432', '2006-10-24', 1, 6),
(15, 'Yuri', '098765432', '2006-10-24', 1, 6),
(16, 'Yasmin', '784039175', '2006-10-25', 1, 6),
(17, 'Yago', '572096321', '2006-10-24', 1, 6),
(18, 'Escario', '674907654', '2006-10-25', 1, 7),
(19, 'Estefani', '853089635', '2006-10-27', 1, 7),
(20, 'Eduardo', '91056135763', '2006-10-29', 1, 7),
(21, 'Eliza', '109381254', '2006-10-30', 1, 7),
(22, 'Carlos', '784019634', '2006-10-10', 1, 8),
(23, 'Carlinhos', '8429103674', '2006-10-11', 1, 8),
(24, 'Cadu', '4538754901', '2006-10-12', 1, 8),
(25, 'Carlos Eduardo ', '6740103135', '2006-10-13', 1, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `codPerguntas` int(11) NOT NULL,
  `pergunta` varchar(500) NOT NULL,
  `numeroPergunta` int(11) NOT NULL,
  `codQuestionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perguntas`
--

INSERT INTO `perguntas` (`codPerguntas`, `pergunta`, `numeroPergunta`, `codQuestionario`) VALUES
(17, 'pergunta1', 1, 15),
(21, 'Pergunta 2', 2, 15),
(22, 'Pergunta 3', 3, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `codProfessor` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` int(30) NOT NULL,
  `nivelAcesso` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professores`
--

INSERT INTO `professores` (`codProfessor`, `nome`, `email`, `senha`, `nivelAcesso`) VALUES
(3, 'felipe', 'felipe@felipe.com', 123, '0'),
(4, 'lucas', 'lucas@lucas', 123, '0'),
(5, 'Pedro', 'pedro@pedro.com', 123, '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `questionario`
--

CREATE TABLE `questionario` (
  `codQuestionario` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `codProfessor` int(11) DEFAULT NULL,
  `statusProva` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `questionario`
--

INSERT INTO `questionario` (`codQuestionario`, `titulo`, `descricao`, `codProfessor`, `statusProva`) VALUES
(15, 'TESTE1', 'Testando exibir o questionario', 4, 0),
(16, 'TESTE2', 'Teste 2 para o professor Pedro', 5, 0),
(17, 'TESTE3', 'teste para a segunda Prova do Professor Lucas', 4, 0),
(18, 'Teste 4', 'teste 4', 4, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas`
--

CREATE TABLE `respostas` (
  `codResposta` int(11) NOT NULL,
  `codAluno` int(11) NOT NULL,
  `codPerguntas` int(11) NOT NULL,
  `acerto` tinyint(1) NOT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `codAlternativa` int(11) NOT NULL,
  `codQuestionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `respostas`
--

INSERT INTO `respostas` (`codResposta`, `codAluno`, `codPerguntas`, `acerto`, `data`, `hora`, `codAlternativa`, `codQuestionario`) VALUES
(22, 10, 17, 1, '2024-11-02', '03:23:47', 4, 15),
(23, 10, 21, 1, '2024-11-02', '03:23:48', 8, 15),
(24, 10, 22, 1, '2024-11-02', '03:23:49', 12, 15),
(50, 14, 17, 1, '2024-11-02', '04:54:06', 4, 15),
(51, 14, 21, 1, '2024-11-02', '04:54:07', 8, 15),
(52, 14, 22, 1, '2024-11-02', '04:54:08', 12, 15),
(53, 14, 17, 0, '2024-11-02', '04:58:57', 1, 15),
(54, 14, 21, 0, '2024-11-02', '04:58:58', 6, 15),
(55, 14, 22, 1, '2024-11-02', '04:58:59', 12, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `secretaria`
--

CREATE TABLE `secretaria` (
  `codSecretaria` int(11) NOT NULL,
  `nome` varchar(1000) NOT NULL,
  `email` varchar(300) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `nivelAcesso` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `secretaria`
--

INSERT INTO `secretaria` (`codSecretaria`, `nome`, `email`, `senha`, `nivelAcesso`) VALUES
(1, 'Igor Viado', 'igor@gmail', '1234', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `codTurma` int(11) NOT NULL,
  `nomeTurma` varchar(100) NOT NULL,
  `numeroAlunos` int(11) NOT NULL,
  `codProfessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`codTurma`, `nomeTurma`, `numeroAlunos`, `codProfessor`) VALUES
(5, '8 ano A', 20, 4),
(6, '8 ano B', 20, 4),
(7, '1 ano A', 20, 5),
(8, '1 ano B', 20, 5),
(9, 'teste', 2, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma_questionario`
--

CREATE TABLE `turma_questionario` (
  `codTurmaQuestionario` int(11) NOT NULL,
  `codQuestionario` int(11) NOT NULL,
  `codTurma` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma_questionario`
--

INSERT INTO `turma_questionario` (`codTurmaQuestionario`, `codQuestionario`, `codTurma`, `status`) VALUES
(49, 15, 5, 1),
(50, 15, 6, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`codAlternativa`),
  ADD KEY `codPergunta` (`codPergunta`);

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codAluno`),
  ADD KEY `codTurma` (`codTurma`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`codPerguntas`),
  ADD KEY `codQuestionario` (`codQuestionario`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`codProfessor`),
  ADD UNIQUE KEY `uqEmail` (`email`);

--
-- Índices de tabela `questionario`
--
ALTER TABLE `questionario`
  ADD PRIMARY KEY (`codQuestionario`),
  ADD KEY `FKQuestionario_Professor` (`codProfessor`);

--
-- Índices de tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`codResposta`),
  ADD KEY `fk_resposta_pergunta` (`codPerguntas`),
  ADD KEY `fk_resposta_aluno` (`codAluno`),
  ADD KEY `fk_resposta_alternativa` (`codAlternativa`),
  ADD KEY `fk_resposta_questionario` (`codQuestionario`);

--
-- Índices de tabela `secretaria`
--
ALTER TABLE `secretaria`
  ADD PRIMARY KEY (`codSecretaria`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`codTurma`),
  ADD KEY `codProfessor` (`codProfessor`);

--
-- Índices de tabela `turma_questionario`
--
ALTER TABLE `turma_questionario`
  ADD PRIMARY KEY (`codTurmaQuestionario`),
  ADD KEY `codQuestionario` (`codQuestionario`),
  ADD KEY `codTurma` (`codTurma`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `codAlternativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `codAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `codPerguntas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `codProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `questionario`
--
ALTER TABLE `questionario`
  MODIFY `codQuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `codResposta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `secretaria`
--
ALTER TABLE `secretaria`
  MODIFY `codSecretaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `codTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `turma_questionario`
--
ALTER TABLE `turma_questionario`
  MODIFY `codTurmaQuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `codPergunta` FOREIGN KEY (`codPergunta`) REFERENCES `perguntas` (`codPerguntas`);

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `codTurma` FOREIGN KEY (`codTurma`) REFERENCES `turma` (`codTurma`);

--
-- Restrições para tabelas `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `codQuestionario` FOREIGN KEY (`codQuestionario`) REFERENCES `questionario` (`codQuestionario`);

--
-- Restrições para tabelas `questionario`
--
ALTER TABLE `questionario`
  ADD CONSTRAINT `FKQuestionario_Professor` FOREIGN KEY (`codProfessor`) REFERENCES `professores` (`codProfessor`);

--
-- Restrições para tabelas `respostas`
--
ALTER TABLE `respostas`
  ADD CONSTRAINT `fk_resposta_alternativa` FOREIGN KEY (`codAlternativa`) REFERENCES `alternativa` (`codAlternativa`),
  ADD CONSTRAINT `fk_resposta_aluno` FOREIGN KEY (`codAluno`) REFERENCES `aluno` (`codAluno`),
  ADD CONSTRAINT `fk_resposta_pergunta` FOREIGN KEY (`codPerguntas`) REFERENCES `perguntas` (`codPerguntas`),
  ADD CONSTRAINT `fk_resposta_questionario` FOREIGN KEY (`codQuestionario`) REFERENCES `questionario` (`codQuestionario`);

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `codProfessor` FOREIGN KEY (`codProfessor`) REFERENCES `professores` (`codProfessor`);

--
-- Restrições para tabelas `turma_questionario`
--
ALTER TABLE `turma_questionario`
  ADD CONSTRAINT `turma_questionario_ibfk_1` FOREIGN KEY (`codQuestionario`) REFERENCES `questionario` (`codQuestionario`) ON DELETE CASCADE,
  ADD CONSTRAINT `turma_questionario_ibfk_2` FOREIGN KEY (`codTurma`) REFERENCES `turma` (`codTurma`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
