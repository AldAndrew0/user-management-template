# 🗂️ Gestionale Template

Uno stampino (boilerplate) riutilizzabile per costruire gestionali web in PHP puro.
Permette di gestire utenti, studenti, clienti o qualsiasi tipo di entità
con le operazioni base: creazione, visualizzazione, modifica ed eliminazione (CRUD).

---

## 🚀 Tecnologie utilizzate

- **PHP** — logica del backend
- **MySQL** — database
- **Composer** — gestore di librerie PHP
- **vlucas/phpdotenv** — gestione variabili d'ambiente
- **HTML + CSS + JavaScript** — frontend
- **Laragon** — ambiente di sviluppo locale

---

## 📁 Struttura del progetto

```
user-management-template/
│
├── assets/                  # File statici (stile, script, immagini)
│   ├── css/style.css
│   ├── js/main.js
│   └── img/
│
├── config/
│   └── database.example.php # Esempio di configurazione → rinominare in database.php
│
├── database/
│   └── user-management.sql  # Schema del database
│
├── includes/                # Componenti riutilizzabili
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
├── pages/
│   ├── auth/                # Login e logout
│   │   ├── login.php
│   │   └── logout.php
│   └── Users/               # CRUD utenti
│       ├── index.php        # Lista utenti
│       ├── create.php       # Crea utente
│       ├── edit.php         # Modifica utente
│       └── delete.php       # Elimina utente
│
├── .env.example             # Esempio variabili d'ambiente → rinominare in .env
├── composer.json            # Dipendenze PHP
├── index.php                # Homepage / Dashboard
└── README.md```

---

## ⚙️ Installazione

1. Clona la repository nella cartella `www` di Laragon:
```bash
   git clone https://github.com/AldAndrew0/user-management-template.git
```

2. Installa le dipendenze PHP con Composer:
```bash
   composer install
```

3. Avvia **Laragon** (Apache + MySQL)

4. Importa il database:
```bash
   database/user-management.sql
```

5. Copia il file `.env.example`, rinominalo in `.env` e inserisci le tue credenziali:
DB_HOST=your_host
DB_USER=your_username
DB_PASS=your_password
DB_NAME=your_database_name

6. Apri il browser e vai su:
http://localhost/user-management-template

---

## 🔄 Come riutilizzare questo template

Questo progetto è pensato per essere uno **stampino**. Per adattarlo a un nuovo gestionale:

1. Rinomina la cartella `pages/Users/` con il nome della tua entità (es. `Studenti/`, `Clienti/`)
2. Aggiorna i nomi delle variabili e i campi del database
3. Cambia il titolo e il tema grafico in `includes/header.php`

---

## 📌 Funzionalità previste

- [x] Struttura base del progetto
- [x] Configurazione database con variabili d'ambiente
- [ ] Connessione al database
- [ ] Sistema di autenticazione (login/logout)
- [ ] CRUD utenti completo
- [ ] Validazione dei form
- [ ] Gestione sessioni

---

## 👤 Autore

**Andrea**