

 📋 Visão Geral
É um sistema para o gerenciamento de livros do usuario, em um servidor local, usando xamp, com apache e mysql ligados, fiz o projeto em web, utilizando Html, css, js, e PHP. Para atender casos de pessoas com muitos livros, com opção de adicionar resumos do livro para facil memorização, com sistema de busca dentro das opções de escolha de genero, nome e autor.
Caso não tenha foto, tem uma foto de capa de livro de maneira padrão.


 ⚙️ Tecnologias Utilizadas
 
 **Front-end:** HTML, CSS e JavaScript.
 
   * *Justificativa:* Para garantir responsabilidade e animações mais elegantes.
     
 **Back-end:** PHP (Versão 7.4 ou superior).
 
   * *Justificativa:* Majoritariamente porque é a linguagem que mais domino.
     
 **Banco de Dados:** MySQL.
 
   * *Justificativa:* Para guardar os dados, sistema de login, id, livros, imagens, etc.

 📂 Estrutura do Projeto

PROJETO IIBRASIL/


├── back/                    # Maior parte do back-end aqui

│   ├── cadastrar.php        # faz o insert no banco com os dados do user

│   ├── conexao.php          # faz a conexão com o banco

│   ├── editar.php           # edita o que se coloca nos livros

│   ├── index.php            # Arquivo de segurança (previne listagem de diretório)

│   ├── login.php            # Pesquisa os dados do user no banco e verifica se ta certo

│   ├── logout.php           # Encerra a sessão do usuario

│   └── verifica.php         # É o verificador se houve uma sessão ou nao no sistema

│

├── style/                   # Pasta dos css separado

│   ├── style_adicionar.css  # para a pagina adicionar.php

│   ├── style_index.css      # para a pagina index.php

│   └── style_inicio.css     # para a pagina inicio.php

│

├── uploads/                 # Para as imagens


├── adicionar.php            # A Pagina de adicionar livros para a biblioteca

├── index.php                # A pagina de login e de cadastro

└── inicio.php               # a interace das listas de livros
