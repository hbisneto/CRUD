# CRUD

CRUD básico feito em **PHP**, **Bootstrap**, e **MySQL**.
<br>
O projeto permite que o usuário insira o nome do game no banco de dados e indicar se o status de progresso entre as opções disponíveis:

> OK - (Zerei)
><br> Pendente - (Tenho que Zerar)
><br> Blacklist - (Nunca Jogar)

### Script DB

```
CREATE TABLE `GamesStudio`.`tbl_games` ( `id` INT(30)
NOT NULL AUTO_INCREMENT , `gamename` VARCHAR(255) NOT NULL,
`status` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
```