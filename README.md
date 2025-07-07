# Gameclub Online

Dit is een webproject voor een online gameclub, gemaakt met Laravel.

## Over het project

Gameclub Online is een website waar gamers samenkomen om nieuws te delen, vragen te stellen en contact te maken. De site is bedoeld als oefening voor het vak Backend Web en laat zien dat ik met Laravel kan werken.

## Belangrijkste onderdelen

- **Registratie en login:** Iedereen kan een account aanmaken en inloggen.
- **Gebruikersrollen:** Er zijn gewone gebruikers en admins. Admins kunnen andere gebruikers beheren en admin maken.
- **Profielpagina:** Elke gebruiker heeft een eigen profiel met gebruikersnaam, verjaardag, profielfoto en een korte tekst over zichzelf. Profielen zijn voor iedereen zichtbaar.
- **Nieuws:** Admins kunnen nieuws toevoegen, bewerken en verwijderen. Iedereen kan nieuws lezen en reacties plaatsen.
- **FAQ:** Veelgestelde vragen zijn gegroepeerd per categorie. Admins kunnen vragen en categorieën beheren. Gebruikers kunnen zelf vragen voorstellen.
- **Contact:** Bezoekers kunnen een bericht sturen via het contactformulier. Admins kunnen deze berichten bekijken.
- **Reactiesysteem:** Gebruikers kunnen reageren op nieuwsitems.
- **Beveiliging:** Alleen admins kunnen bij admin-pagina's. Alle formulieren zijn beveiligd tegen CSRF en XSS.

## Extra features

- Admin dashboard voor contactberichten
- Reactiesysteem bij nieuws
- FAQ-suggesties door gebruikers

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
6. Kopieer het `.env.example` bestand naar `.env` en vul je databasegegevens in.
7. Maak de database aan en voer de migraties en seeders uit:
   ```
   php artisan migrate:fresh --seed
   ```
8. Maak een applicatiesleutel aan:
   ```
   php artisan key:generate
   ```
9. Start de ontwikkelserver:
   ```
   php artisan serve
   ```
10. Open de site in je browser op [http://127.0.0.1:8000](http://127.0.0.1:8000)

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

## Screenshots

_Voeg hier enkele screenshots toe van de belangrijkste pagina's (login, dashboard, profiel, nieuws, FAQ, adminbeheer, enz.)_

## Gebruikte bronnen

- [Laravel documentatie](https://laravel.com/docs)
- [Tailwind CSS documentatie](https://tailwindcss.com/docs)
- [PHP documentatie](https://www.php.net/docs)
- [Stack Overflow](https://stackoverflow.com/)
- AI code assistent chatlog

