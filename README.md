#JRest

Estrutura para início rápido de aplicações rest usando [SLIM Framework](https://github.com/codeguy/Slim).

##Installation
Usando o Composer você pode adicionar o codigo abaixo a seu composer.json

```json
    {
        "require": {
            "jorgejardim/jrest": "dev-master"
        }
    }

```

##RESTful

####exemplo de listagem
GET: http://localhost/jrest/app/public/teste

HEADER: Authorization: 123456

####exemplo de visualizacao
GET: http://localhost/jrest/app/public/teste/view/1

HEADER: Authorization: 123456

####exemplo de adicionar
POST: http://localhost/jrest/app/public/teste/add

HEADER: Authorization: 123456

```json

    {"test_name":"Jorge Jardim", "test_email":"jorge@email.com.br"}

```

####exemplo de editar
PUT: http://localhost/jrest/app/public/teste/edit

HEADER: Authorization: 123456

```json

    {"test_id":1, "test_name":"Jorge F Jardim", "test_email":"jorge@email.com.br"}

```

####exemplo de deletear
DELETE: http://localhost/jrest/app/public/teste/delete/1

HEADER: Authorization: 123456

####exemplo de login
POST: http://localhost/jrest/app/public/login

```json

    {"email":"jorge@email.com.br","password":"senha"}

```

##Banco de Dados

```sql

    CREATE TABLE IF NOT EXISTS `tests` (
      `test_id` int(10) NOT NULL AUTO_INCREMENT,
      `test_name` varchar(255) COLLATE utf8_bin NOT NULL,
      `test_email` varchar(255) COLLATE utf8_bin NOT NULL,
      PRIMARY KEY (`test_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

    CREATE TABLE IF NOT EXISTS `users` (
      `user_id` int(10) NOT NULL AUTO_INCREMENT,
      `user_name` varchar(100) COLLATE utf8_bin NOT NULL,
      `user_email` varchar(100) COLLATE utf8_bin NOT NULL,
      `user_password` varchar(64) COLLATE utf8_bin NOT NULL,
      `user_token` varchar(64) COLLATE utf8_bin NOT NULL,
      `created` datetime NOT NULL,
      `modified` datetime NOT NULL,
      PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

```

##Autor

Jorge Jardim [http://www.jorgejardim.com.br/]