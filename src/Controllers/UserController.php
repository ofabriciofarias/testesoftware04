<?php

namespace App\Controllers;

use Fabri\Testesoftware04\Models\User;
use Exception;

class UserController
{
    /**
     * Recebe os dados brutos e tenta registrar o usuário.
     * Retorna um array estruturado com o status do cadastro.
     */
    public function register(array $requestData): array
    {
        try {
            // Tenta instanciar o modelo. Se alguma regra falhar, o construtor lança Exception.
            $user = new User(
                $requestData['nome'] ?? '',
                (int)($requestData['idade'] ?? 0),
                $requestData['telefone'] ?? '',
                $requestData['email'] ?? '',
                $requestData['descricaoPessoal'] ?? ''
            );

            // Simulação de sucesso no salvamento
            return [
                'success' => true,
                'message' => 'Usuário registrado com sucesso!',
                'data' => [
                    'nome' => $user->getNome(),
                    'email' => $user->getEmail(),
                    'idade' => $user->getIdade()
                ]
            ];

        } catch (Exception $e) {
            // Em caso de falha de validação, captura o erro e retorna uma resposta limpa
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}