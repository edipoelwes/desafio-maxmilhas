# Maximilhas -
## Instruções para o desenvolvimento

***Dica***: Para acessar o container e executar comandos como `composer install` ou `npm install`, execute o comando `docker exec -ti app_php /bin/bash`.

*MySQL*:  

- port: 3306
- dbname: maximilhas_db
- username: root
- password: root

# Parametrizar a API

- Após clonar o projeto desafio-maxmilhas
   1. Através do terminal, entre no diretório do projeto `cd desafio-maxmilhas`
   2. Execute `docker-compose up -d --build`

   3. execute o comando `docker-compose exec app composer install`.
   4. execute o comando `docker-compose exec app chmod -R 777 storage`.

   *Obs*:
    - Já deixei o arquivo .env parametrizado para facilitar o passo 5 e 5.1, dessa forma não será nescessário executar o passo 5, 5.1 e 6.

   5. Copie o arquivo `.env-example` para `.env`
   5.1. Execute o comando `docker-compose exec app php artisan key:generate`.
   6. Configurar as variaveis de ambientes do banco    
   
   *MySQL*:
      - connection: mysql
      - host: db
      - port: 3306
      - dbname: maximilhas_db
      - username: root
      - password: root

   7. Execute o comando `docker-compose exec app php artisan migrate`.
   
   # Rotas da API

   ### Cpf
      - GET Index      `http://localhost:8080/api/cpf`. 
      - POST Store     `http://localhost:8080/api/cpf`. *OBS enviar um json*  `{"cpf": "035.854.785-98"}`
      - GET Show       `http://localhost:8080/api/cpf{cpf}`. {cpf} = 205.041.080-85 exemplo
      - DELETE Destroy `http://localhost:8080/api/cpf{cpf}`. {cpf} = 205.041.080-85 exemplo


#IMPORTANTE
*Se por algum motivo precisar refazer a build da imagem, apagar a pasta dbdata de dentro do .docker*
