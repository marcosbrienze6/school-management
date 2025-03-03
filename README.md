# Projeto de Gestão Escolar

Este é um projeto de **API em Laravel 11** desenvolvido para gerenciar informações escolares, incluindo o cadastro de usuários e médicos. O sistema utiliza **SQL** como banco de dados e implementa **autenticação via JWT**. Segue boas práticas de desenvolvimento com **Controllers, Services e Migrations**.

## Tecnologias Utilizadas

- **Laravel 11**
- **PHP**
- **SQL** (MySQL/PostgreSQL)
- **JWT para autenticação**
- **Migrations e Seeds**
- **Arquitetura MVC (Model-View-Controller)**

## Funcionalidades Implementadas

- Cadastro e gerenciamento de usuários
- Cadastro e gerenciamento de médicos
- Autenticação e controle de acesso com JWT
- Organização da lógica de negócio em Services
- Banco de dados estruturado com Migrations

## Como Rodar o Projeto

1. Clone este repositório:
   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git
   ```
2. Acesse o diretório do projeto:
   ```sh
   cd seu-repositorio
   ```
3. Instale as dependências do Laravel:
   ```sh
   composer install
   ```
4. Configure o arquivo **.env** com os dados do banco de dados.
5. Gere a chave da aplicação:
   ```sh
   php artisan key:generate
   ```
6. Execute as migrations:
   ```sh
   php artisan migrate --seed
   ```
7. Inicie o servidor:
   ```sh
   php artisan serve
   ```

## Endpoints Principais

### Autenticação

- `POST /api/login` - Autentica um usuário e retorna um token JWT
- `POST /api/logout` - Encerra a sessão do usuário

### Usuários

- `GET /api/`alunos - Lista todos os alunos
- `POST /api/`aluno - Cria um novo aluno
- `PUT /api/aluno/{id}` - Atualiza um aluno
- `DELETE /api/usuarios/{id}` - Remove um aluno

### Médicos

- `GET /api/teacher `- Lista todos os professores
- `POST /api/teacher/` - Cria um novo professor
- `PUT /api/tea/{id}` - Atualiza um professor
- `DELETE /api/teacher{id}` - Remove um professor

## Contribuição

Contribuições são bem-vindas! Para contribuir, siga estes passos:

1. Faça um fork do repositório
2. Crie uma branch para sua funcionalidade (`git checkout -b feature-nova`)
3. Faça commit das suas alterações (`git commit -m 'Adiciona nova funcionalidade'`)
4. Envie para o repositório (`git push origin feature-nova`)
5. Abra um Pull Request

## Licença

Este projeto está sob a licença MIT. Para mais detalhes, consulte o arquivo `LICENSE`.

