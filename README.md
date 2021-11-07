# Sistema de Cadastro de Vendas e Gerenciamento de Vendedores - Backend

**Backend feito em PHP com Laravel e MySQL para cadastrar vendas, gerenciar vendedores (inserir, atualizar ou remover), e consultar vendas e vendedores.**<br>
O sistema também enviaa e-mails contendo um relatório das vendas realizadas no dia atual, bem como o valor total destas vendas, periodicamente (conforme configurado).
<br>

## How to Use

- Necessário ter Docker e Docker-Compose instalados na máquina.
- Executar, na pasta do projeto, o comando `docker-compose up -d` para subir a aplicação.
  - O backend usará a porta 8000.
- Rodar o comando `docker exec backend-app php artisan migrate` para inicializar as tabelas do banco de dados dentro do container.

- Caso seja interessante, pode-se rodar os seeds para criar alguns vendedores de exemplo, com o seguinte comando `docker exec backend-app php artisan db:seed SellerSeeder`.
  - No entanto, os vendedores podem ser criados/gerenciados por meio da aplicação de front citada abaixo.
<br>
  
O front desse sistema está em um projeto separado, feito com React, [neste repositório](https://github.com/fabygiacomini/sales-frontend). <br>
**Basta inicializar o docker de ambas as aplicações (rodando os respectivos docker-composes de cada projeto) para que os dois sistemas se comuniquem.**


### Envio de E-mail
Para o envio de e-mails disparados pelo sistema, foi utilizado o site [MailTrap](https://mailtrap.io).<br>
Após criar uma conta no site (é um serviço gratuito com limite de 50 e-mails), podemos ir na aba do site chamada "inbox" (fica no menu esquerdo), selecionar a inbox criada; depois, na aba "SMTP Settings", podemos, então, selecionar (dentro de um dropdown) a opção "Laravel".<br>
O site do MailTrap, então, vai listar os dados que precisamos adicionar no arquivo `.env` do projeto, basta colar os valores lá.<br>
Exemplo:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username_mailtrap
MAIL_PASSWORD=password_mailtrap
MAIL_ENCRYPTION=tls
```
<br>

Podemos testar o envio dos e-mails de duas formas:
- fazendo manualmente uma request para o IP onde está rodando o `php artisan`, como, por exemplo, `localhost:8000/api/mail`, e uma mensagem de e-mail será disparada para o endereço cadastrado.<br>
- ou iniciando a **schedule** que roda o serviço de envio de e-mail uma vez ao dia, ao final do dia (às 23:59):<br>
Podemos iniciar a schedule rodando, com cautela, o comando `while true; do php artisan schedule:run; sleep 60; done` (para parar a execução, basta pressionar `crtl+c` no terminal), o qual rodará um schedule a cada 60 segundos e que verificará se a condição da data estabelecida no arquivo `Kernel.php` já foi cumprida, ocasião em que rodará o serviço de envio de e-mails.<br>
Para testar mais rápido, podemos ir até o arquivo `App\Console\Kernel.php`, no método `schedule()`, e podemos, então, comentar a linha contendo: `->dailyAt('23:59');` e descomentar a linha: `->everyMinute();` para que a periodicidade de envio de e-mails seja alterada para cada minuto, e não mais todos os dias às 23:59.<br>
  
<br>

*Obs: podemos ver a schedule rodando e disparando os e-mails no [video anexado](anexos/schedule-envio-email.mov).


## Tecnologias Utilizadas
- PHP 7.3.11
- Laravel 8.48.2
- MySQL 5.7.26

Ferramentas utilizadas no desenvolvimento:
- MAMP (subir o banco de dados);
- Postman (realizar chamadas para o backend);

## Rotas
As rotas que temos neste sistema são:
- **get**: *'/seller'* -> busca todos os vendedores;
- **delete**: *'/seller/{id}'* -> remove um vendedor da base de dados (o parâmetro indica o id do vendedor a ser removido);
- **post**: *'/seller'* -> insere um novo vendedor ou atualiza o registro caso já exista
    - campos do body: 'id', 'name', 'email', 'commission_fee'


- **get**: *'/sales/{name?}'* -> busca todas as vendas (caso seja passado o parâmetro "name" que é opcional, busca as vendas cujo vendedor tenha o "name" em parte de seu nome);
- **post**: *'/sales'* -> insere uma nova venda;
    - campos do body: 'seller_id', 'sale_value'

- **get**: *'/mail'* -> testa o envio manual de um e-mail.

*Obs.: foi utilizado o header 'X-Requested-With': 'XMLHttpRequest' para evitar alguns problemas de CORS encontrados durante o desenvolvimento.
<br>
