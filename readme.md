# Laravel 6.20.44 + Livewire 0.7.2 — Clean Code Run code in Laravel Livewire ...

Este projeto é um exemplo de **CRUD** utilizando **Laravel 6.20.44** com **Livewire 0.7.2**, com foco em **Clean Code**, boas práticas e organização para projetos legados.

## Objetivo

Demonstrar como estruturar um projeto Laravel legado (legacy) de forma clara e escalável, aplicando:

- Separação de responsabilidades (`Services`, `DTOs`, `Helpers`).
- Componentes Livewire limpos e reutilizáveis.
- Validação centralizada e consistente.
- Soft deletes e controle de dados seguro.
- Estrutura de pastas organizada.

## Estrutura do Projeto (ex:...)

```
app/
  DTOs/               # Objetos de transferência de dados
  Services/           # Regras de negócio separadas
  Models/             # Models Eloquent
  Http/
    Livewire/
      Tasks/          # Componentes Livewire
  Helpers/            # Funções utilitárias
config/
resources/
  views/
    layouts/
    tasks.blade.php
    livewire/tasks/   # Views dos componentes Livewire
routes/web.php
database/migrations/
composer.json         # Autoload de Helpers
package.json          # Assets (Bootstrap, Laravel Mix)
```

## Instalação

1. Clonar o projeto ou criar Laravel 6.20.44:
```bash
composer create-project laravel/laravel="6.20.44" meu_projeto
```

2. Instalar Livewire 0.7.2:
```bash
composer require livewire/livewire:"0.7.2"
```

3. Publicar configuração do Livewire (se disponível):
```bash
php artisan vendor:publish --provider="Livewire\\LivewireServiceProvider" --tag=livewire
```

4. Autoload dos Helpers (`composer.json`):
```json
"autoload": {
    "psr-4": {"App\\": "app/"},
    "files": ["app/Helpers/helpers.php"]
}
```
```bash
composer dump-autoload
```

5. Instalar assets e compilar:
```bash
npm install
npm run dev
```

6. Rodar migrations:
```bash
php artisan migrate
```

7. Rodar servidor local:
```bash
php artisan serve
```
Acesse: [http://127.0.0.1:8000/tasks](http://127.0.0.1:8000/tasks)

## Funcionalidades

- Listagem de tarefas com busca e paginação.
- Criação, edição e remoção de tarefas.
- Validação no frontend e backend.
- Comunicação entre componentes Livewire via eventos.
- Soft deletes para segurança de dados.

## Boas Práticas Aplicadas

- **Separa responsabilidades**: Livewire chama Services; lógica de negócio não está no componente.
- **DTOs (TaskData)**: padroniza dados entre camada de serviço e Livewire.
- **Helpers**: funções utilitárias isoladas e autoloaded.
- **Validação centralizada**: no componente de formulário, consistente.
- **Eventos e mensagens de sessão**: comunicação clara entre componentes.
- **Estrutura de pastas limpa**: facilita manutenção e escalabilidade.

## Observações

- Compatível com **Bootstrap 4.6.x**, já incluso no template.
- Livewire 0.7.2 tem diferenças de sintaxe em relação às versões atuais; o projeto segue a sintaxe dessa versão.
- Pode ser usado como boilerplate para projetos Laravel legados que precisem de Clean Code.

---

Este README serve como guia inicial e referência para boas práticas em **Laravel legacy + Livewire + Bootstrap**, facilitando aprendizado e manutenção de código limpo.