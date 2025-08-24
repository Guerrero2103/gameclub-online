# Gameclub Online

Dit is een webproject voor een online gameclub, gemaakt met Laravel.

## Over het project

Gameclub Online is een website waar gamers samenkomen om nieuws te delen, vragen te stellen en contact te maken. De site is bedoeld als oefening voor het vak Backend Web en laat zien dat ik met Laravel kan werken.

## Belangrijkste onderdelen

- **Registratie en login:** Iedereen kan een account aanmaken en inloggen.
- **Gebruikersrollen:** Er zijn gewone gebruikers en admins. Admins kunnen andere gebruikers beheren en admin maken.x
- **Profielpagina:** Elke gebruiker heeft een eigen profiel met gebruikersnaam, verjaardag, profielfoto en een korte tekst over zichzelf. Profielen zijn voor iedereen zichtbaar.
- **Nieuws:** Admins kunnen nieuws toevoegen, bewerken en verwijderen. Iedereen kan nieuws lezen en reacties plaatsen.
- **Reactiesysteem bij nieuws:** Gebruikers kunnen reageren op nieuwsitems. Admins en de eigenaar van een reactie kunnen deze verwijderen.
- **FAQ:** Veelgestelde vragen zijn gegroepeerd per categorie. Admins kunnen vragen en categorieën beheren. Gebruikers kunnen zelf vragen voorstellen.
- **Contact:** Bezoekers kunnen een bericht sturen via het contactformulier. Admins kunnen deze berichten bekijken in een apart dashboard.
- **Beveiliging:** Alleen admins kunnen bij admin-pagina's. Alle formulieren zijn beveiligd tegen CSRF en XSS.
- **Forum/discussiefunctionaliteit:** Gebruikers kunnen topics aanmaken en reageren op topics in het forum. Alleen ingelogde gebruikers kunnen posten.

## Extra features

- Admin dashboard voor contactberichten: admins kunnen alle ontvangen berichten bekijken en beheren.
- Reactiesysteem bij nieuws: gebruikers kunnen reageren op nieuws, admins kunnen reacties beheren.
- FAQ-suggesties door gebruikers: gebruikers kunnen vragen voorstellen, admins kunnen deze goedkeuren of verwijderen.

## Installatie

1. Zorg dat je PHP, Composer en Node.js hebt geïnstalleerd.
2. Download of kloon dit project:
   ```
   git clone https://github.com/Guerrero2103/gameclub-online
   ```
3. Ga naar de projectmap:
   ```
   cd gameclub-online
   ```
4. Installeer de PHP-pakketten:
   ```
   composer install
   ```
5. Installeer de Node.js-pakketten:
   ```
   npm install
   ```
6. **Maak een nieuw bestand `.env` aan** in de hoofdmap van het project en kopieer onderstaande code erin:

   **Belangrijk:** De `.env` file wordt niet meegestuurd in de GitHub repository om veiligheidsredenen. Je moet deze zelf aanmaken door `.env.example` te kopiëren.

   ```
   APP_NAME=GameClub
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   APP_LOCALE=nl
   APP_FALLBACK_LOCALE=en
   APP_FAKER_LOCALE=nl_BE

   APP_MAINTENANCE_DRIVER=file

   PHP_CLI_SERVER_WORKERS=4

   BCRYPT_ROUNDS=12

   FILESYSTEM_DRIVER=public

   LOG_CHANNEL=stack
   LOG_LEVEL=debug

   DB_CONNECTION=sqlite
   # Of gebruik mysql:
   # DB_CONNECTION=mysql
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=gameclub
   # DB_USERNAME=root
   # DB_PASSWORD=

   SESSION_DRIVER=database
   SESSION_LIFETIME=120
   SESSION_ENCRYPT=false

   BROADCAST_CONNECTION=log
   FILESYSTEM_DISK=public
   QUEUE_CONNECTION=sync

   CACHE_STORE=file

   REDIS_CLIENT=phpredis
   REDIS_HOST=127.0.0.1
   REDIS_PORT=6379
   REDIS_PASSWORD=null

   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=c000b4830b7881
   MAIL_PASSWORD=4c747ae1f70ff7   
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@gameclub.be
   MAIL_FROM_NAME="GameClub"

   VITE_APP_NAME="${APP_NAME}"
   ```

   **Snelle manier:** Je kunt ook gewoon dit commando uitvoeren:
   ```bash
   cp .env.example .env
   ```

7. **Maak een applicatiesleutel aan** (dit moet vóór de migraties):
   ```
   php artisan key:generate
   ```
8. **Maak de SQLite database aan:**
   ```
   touch database/database.sqlite
   ```
9. **Voer de migraties en seeders uit:**
   ```
   php artisan migrate:fresh --seed
   ```
10. **Bouw de front-end assets met Vite** (BELANGRIJK: doe dit vóór je de server start):
    ```
    npm run build
    ```
    *(Of gebruik `npm run dev` tijdens ontwikkeling)*

11. **Maak de storage link aan** (voor profielfoto's en uploads):
    ```
    php artisan storage:link
    ```

12. Start de ontwikkelserver:
    ```
    php artisan serve
    ```
13. Open de site in je browser op [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Belangrijke opmerkingen

- **Volgorde is cruciaal**: Zorg dat je eerst `php artisan key:generate` uitvoert voordat je de migraties start
- **SQLite database**: Het project gebruikt standaard SQLite. Zorg dat je `touch database/database.sqlite` uitvoert om het databasebestand aan te maken
- **Front-end assets**: Je MOET `npm run build` uitvoeren om de CSS en JavaScript bestanden te genereren voordat de site correct werkt
- **Storage link**: Voor profielfoto's moet je ook `php artisan storage:link` uitvoeren om de storage map toegankelijk te maken

## Testaccounts

- **Admin:**  
  Gebruikersnaam: admin  
  E-mail: admin@ehb.be  
  Wachtwoord: Password!321

## Belangrijke bestanden

- `routes/web.php` – Alle routes van de site
- `app/Http/Controllers/` – Controllers voor de logica
- `app/Models/` – Modellen voor de database
- `resources/views/` – Alle pagina's en formulieren
- `database/seeders/` – Voorbeelddata voor de database

## Gebruikte bronnen

- [Laravel documentatie](https://laravel.com/docs)
- [Tailwind CSS documentatie](https://tailwindcss.com/docs)
- [PHP documentatie](https://www.php.net/docs)
- [Stack Overflow](https://stackoverflow.com/)
- AI code assistent chatlog

## Recente verbeteringen

- Forum/discussiefunctionaliteit toegevoegd: topics en reactiesysteem.
- Navigatielink naar het forum toegevoegd.
- Tijdzone aangepast naar Europe/Brussels.
- Duidelijke labels toegevoegd voor titel en inhoud bij nieuwsberichten in het overzicht.
- Opvallende “Bekijk nieuws” knop toegevoegd bij elk nieuwsitem.
- Kleine ruimtes toegevoegd tussen onderdelen voor een rustigere uitstraling.
- Reactieformulier op de detailpagina van nieuws is nu alleen zichtbaar na klikken op een knop.
- Fout met namespace in de CommentController opgelost.
