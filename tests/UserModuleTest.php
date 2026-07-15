<?php

use PHPUnit\Framework\TestCase;

// Inclua o autoload do composer se necessário
require_once __DIR__ . '/../vendor/autoload.php';

// Ajuste as chamadas de diretório para que os arquivos sejam encontrados.
// Inclua manualmente os arquivos das classes User e UserController
//require_once __DIR__ . '/../src/Models/User.php';
//require_once __DIR__ . '/../src/Controllers/UserController.php';

use Fabri\Testesoftware04\Models\User;
use Fabri\Testesoftware04\Controllers\UserController;

class UserModuleTest extends TestCase
{
    // Exemplo de Teste de Sucesso do Modelo
    public function testCriacaoDeUsuarioComDadosValidos(): void
    {
        $user = new User(
            "Fabricio Farias",
            38,
            "91988887777",
            "fabriciosf@ufpa.br",
            "Professor universitário e pesquisador de computação."
        );

        $this->assertEquals("Fabricio Farias", $user->getNome());
        $this->assertEquals(38, $user->getIdade());
        $this->assertEquals("91988887777", $user->getTelefone());
    }

    // Exemplo de Teste de Validação (Idade)
    public function testRejeitarMenorDeIdade(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O usuário deve ser maior de idade (18 anos ou mais).");

        new User(
            "Aluno Menor",
            17, // Força o erro
            "91988887777",
            "aluno@ufpa.br",
            "Estudante de engenharia de software."
        );
    }

    public function testAceitarMaiorDeIDade(): void
    {
        $user = new User(
            "Aluno Maior",
            30,
            "96988887777",
            "aluno@ufpa.br",
            "Estudante de engenharia de software."
        );

        $this->assertEquals("Aluno Maior", $user->getNome());
        $this->assertEquals(30, $user->getIdade()); 
        $this->assertEquals("96988887777", $user->getTelefone());
    }


    // TODO: Aluno deve implementar o resto dos testes descritos no roteiro...
}