# TESTE PARA VAGA DE DESENVOLVEDOR BACK END

### Back-end feito com laravel

### Arquitetura 

- PHP 8.1.14
- Laravel 9.52.4
- Composer 2.4.4

### Instalação - WINDOWS
```sh
git clone https://github.com/eduardohor/test-saperx-back.git
```

```sh
cd test-saperx-back
```

- Instalar as dependências

```sh
composer install
```

- Duplicar o arquivo **.env.example** e renomear a copia para **.env**
```sh
cp .env.example .env
```

- Com um editor altere os dados de banco no arquivo .env para os referente ao seu banco local

- Logo depois execute o comando abaixo para gerar uma nova chave
```PHP
php artisan key:generate
```
- Criar as tabelas no banco

```sh
php artisan migrate
```

- Subir o servidor

```sh
php artisan serve
```

 Verificar se a aplicação está online acessando [http://localhost:8000](http://localhost:8000)
 
 - Executar Testes
 (Necessário extensão do sqlite ativada)

```sh
php artisan test --testdox
```
