# Autenticação de usuarios 

Nesta pagina contem os scripts em php e sql para realizar registro e login de usuarios 


## Estrutura da pasta 
```txt
auth/ 
├── Register/
│           ├── Register.php                # Contem o script de registro com front-end e sql
│           ├── Register.html               # Contem o front-end da pagina de registro 
│           └── config/
│                     ├── db.php            # Contem o script para conexão com o Dataset MySQL
│                     └── logout.php        # Contem o script para logout, caso for preciso
│
├── Login/
│        ├── Login.php                      # Contem o script de Login com front-end e sql
│        ├── Login.html                     # Contem o front-end da pagina de login
│        └── config/
│                  ├── db.php               # Contem o script para conexão com o Dataset MySQL
/                  └── logout.php           # Contem o script para logoun, caso for preciso    
```

## 'config/db.php'

Diretorio importante por *Conecar com o banco de dados* via PDO  (seguro e moderno). Aqui vc definira:

- Host
- User
- Passwod
- Name the database

** IMPORTANTE **: Esse arquivo é incluindo as operações que envolvem acesso ao Dataset. Se der erro no codigo, baixe o repositório PHPHelp e mude a pasta config para a do PHPHelp.

---

## Observações

- O seu dataset estara totalmente seguro contra *SQL Injection* com ``PDO`.
- Criptografia de senhas 
- Documentação no código para facilitar a manutenção e escalabilidade.
- Pronto para integram com sistmas de sessão, dashboard e etc.

---

# Requisitos 
- PHP 7.4 ou superior
- MySQL/MariaDB
- Servidor local (XAMPP, WAMP, laragon ou um servidor web)

---


