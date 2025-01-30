## 📌 Sobre o Projeto

O **PetCode** é um sistema web desenvolvido para facilitar o gerenciamento de clínicas veterinárias. Ele permite o cadastro de clientes e seus animais, além do agendamento e controle de consultas veterinárias. O sistema oferece uma interface amigável e intuitiva para funcionários e administradores da clínica.

## 🚀 Funcionalidades Principais

- **Cadastro de Clientes**: Armazena informações de clientes, como nome, telefone e endereço.
- **Cadastro de Animais**: Vincula os pets aos seus respectivos donos.
- **Agendamento de Consultas**: Permite a marcação e o gerenciamento de consultas veterinárias.
- **Login e Controle de Acesso**: Diferencia usuários entre administradores e funcionários.
- **Gerenciamento de Usuários**: Cadastro, edição e exclusão de funcionários do sistema.
- **Relatórios**: Exibição de informações sobre clientes, animais e consultas realizadas.

## 🛠️ Tecnologias Utilizadas

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP 8
- **Banco de Dados:** MySQL (MariaDB via XAMPP)
- **Servidor Local:** Apache (via XAMPP)
- **Testes Automatizados:** PHPUnit e Selenium

## 📁 Estrutura do Projeto

```
PetCode/
│── public/            # Arquivos acessíveis via navegador
│   ├── index.php      # Página inicial do sistema
│   ├── login.php      # Página de login
│   ├── dashboard.php  # Página principal do sistema
│   ├── css/           # Arquivos de estilo (CSS)
│   ├── js/            # Arquivos JavaScript
│
│── src/               # Código-fonte principal
│   ├── config/        # Configurações gerais do sistema
│   │   ├── Database.php # Conexão com o banco de dados
│   ├── model/         # Modelos do banco de dados
│   │   ├── Usuario.php  # Modelo de usuários
│   │   ├── Cliente.php  # Modelo de clientes
│   │   ├── Animal.php   # Modelo de animais
│   │   ├── Agendamento.php # Modelo de agendamentos
│   ├── controller/    # Controladores do sistema
│
│── tests/             # Testes automatizados
│
│── README.md          # Documentação do projeto
│── .env               # Configuração de ambiente
│── composer.json      # Dependências do PHP
│── sql/               # Scripts SQL para criação do banco de dados
```

## 📌 Requisitos para Instalação

Antes de instalar o **PetCode**, certifique-se de ter os seguintes softwares instalados:

- **XAMPP** (Apache + MySQL + PHP 8)
- **Composer** (Gerenciador de dependências do PHP)
- **Git** (Opcional, mas recomendado para controle de versão)

## 🛠️ Como Instalar e Configurar o Projeto

### 1️⃣ Clonar o Repositório

```sh
git clone https://github.com/seu-usuario/petcode.git
cd petcode
```

### 2️⃣ Configurar o Banco de Dados

1. Inicie o **XAMPP** e ative o **Apache** e o **MySQL**.
2. Acesse `http://localhost/phpmyadmin/` e crie um banco de dados chamado `clinica_veterinaria`.
3. Importe o arquivo `sql/petcode.sql` dentro do phpMyAdmin.
4. Atualize o arquivo `src/config/Database.php` com as credenciais do seu banco de dados.

### 3️⃣ Instalar Dependências do PHP

```sh
composer install
```

### 4️⃣ Iniciar o Servidor

```sh
php -S localhost:8000 -t public
```

Ou, se estiver usando o **XAMPP**, acesse `http://localhost/petCode/public/`

### 5️⃣ Criar um Usuário Administrador

1. Acesse o sistema via `http://localhost/petCode/public/login.php`
2. Caso não tenha um usuário criado, insira manualmente um administrador no banco:

```sql
INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES ('Admin', 'admin@email.com', MD5('admin123'), 'admin');
```

3. Faça login com `admin@email.com` e senha `admin123`.

