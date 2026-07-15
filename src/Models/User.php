<?php

namespace Fabri\Testesoftware04\Models;

use InvalidArgumentException;

class User
{
    private string $nome;
    private int $idade;
    private string $telefone;
    private string $email;
    private string $descricaoPessoal;

    public function __construct(string $nome, int $idade, string $telefone, string $email, string $descricaoPessoal)
    {
        $this->setNome($nome);
        $this->setIdade($idade);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        $this->setDescricaoPessoal($descricaoPessoal);
    }

    // --- REGRAS DE NEGÓCIO (VALIDAÇÕES) ---

    private function setNome(string $nome): void
    {
        if (empty(trim($nome))) {
            throw new InvalidArgumentException("O nome não pode estar em branco.");
        }
        $this->nome = $nome;
    }

    private function setIdade(int $idade): void
    {
        if ($idade < 18) {
            throw new InvalidArgumentException("O usuário deve ser maior de idade (18 anos ou mais).");
        }
        $this->idade = $idade;
    }

    private function setTelefone(string $telefone): void
    {
        // Valida se o telefone tem apenas números e entre 10 e 11 dígitos (DDD + número)
        $apenasNumeros = preg_replace('/\D/', '', $telefone);
        if (strlen($apenasNumeros) < 10 || strlen($apenasNumeros) > 11) {
            throw new InvalidArgumentException("O telefone deve conter um DDD válido e entre 10 ou 11 dígitos numéricos.");
        }
        $this->telefone = $apenasNumeros;
    }

    private function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("O formato do e-mail é inválido.");
        }
        $this->email = $email;
    }

    private function setDescricaoPessoal(string $descricaoPessoal): void
    {
        if (strlen($descricaoPessoal) < 10) {
            throw new InvalidArgumentException("A descrição pessoal deve ter no mínimo 10 caracteres.");
        }
        $this->descricaoPessoal = $descricaoPessoal;
    }

    // --- GETTERS ---
    public function getNome(): string { return $this->nome; }
    public function getIdade(): int { return $this->idade; }
    public function getTelefone(): string { return $this->telefone; }
    public function getEmail(): string { return $this->email; }
    public function getDescricaoPessoal(): string { return $this->descricaoPessoal; }
}