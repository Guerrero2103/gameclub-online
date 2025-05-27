# Gameclub Online Project

Dit is een webproject voor een online gameclub, gebouwd met het Laravel framework.

## Projectbeschrijving en Functionaliteiten

Dit project simuleert een platform voor een online gameclub, met functionaliteiten gericht op nieuwsdeling, gebruikersinteractie, en administratie.

Het project bevat de volgende onderdelen:

*   **Nieuws:** Gebruikers kunnen nieuwsitems bekijken. Beheerders hebben volledige CRUD (Create, Read, Update, Delete) rechten voor nieuwsitems via het beheergedeelte. Geïmplementeerd in:
    *   `app/Http/Controllers/NewsController.php`
    *   `routes/web.php` (routes beginnend met `/news`)
    *   `resources/views/news/` (views zoals index, show, form)

*   **FAQ (Veelgestelde Vragen):** Toont veelgestelde vragen gegroepeerd per categorie. Beheerders kunnen zowel FAQ-items als categorieën toevoegen, bewerken en verwijderen via een beheerinterface. Geïmplementeerd in:
    *   `app/Http/Controllers/FaqController.php`
    *   `app/Models/HelpEntry.php` (Model voor FAQ items)
    *   `app/Models/HelpGroup.php` (Model voor FAQ categorieën)
    *   `database/migrations/*_create_help_entries_table.php`
    *   `database/migrations/*_create_help_groups_table.php`
    *   `routes/web.php` (routes beginnend met `/faq`)
    *   `resources/views/faq/` (views zoals index, manage, form)

*   **Contact:** Biedt een contactformulier voor bezoekers. Ingezonden berichten zijn zichtbaar voor beheerders in een speciaal dashboard. Geïmplementeerd in:
    *   `app/Http/Controllers/ContactController.php`
    *   `app/Models/ContactMessage.php` (Model voor contactberichten)
    *   `database/migrations/*_create_contact_messages_table.php`
    *   `routes/web.php` (routes beginnend met `/contact` en `/admin/contact`)
    *   `resources/views/contact/` (views zoals create)
    *   `resources/views/admin/contact/` (views voor het beheer)

*   **Gebruikersbeheer (Admin):** Beheerders kunnen gebruikersaccounts bekijken en beheren, inclusief het toewijzen van rollen (`admin`, `gamer`, etc.). Dit maakt gebruik van Laravel's ingebouwde authenticatie en resource controllers. Geïmplementeerd in:
    *   `app/Http/Controllers/Admin/UserController.php`
    *   `app/Models/User.php` (Model voor gebruikers)
    *   `database/migrations/*_create_users_table.php`
    *   `database/migrations/*_add_role_to_users_table.php`
    *   `routes/web.php` (routes onder de `/admin/users` resource)
    *   `resources/views/admin/users/` (views voor gebruikersbeheer)

*   **Authenticatie en Autorisatie:** Het systeem ondersteunt gebruikersregistratie, login en logout voor zowel normale gebruikers als beheerders. Autorisatie met Gates zorgt ervoor dat alleen geautoriseerde gebruikers toegang hebben tot specifieke functionaliteiten (bijvoorbeeld FAQ/nieuwsbeheer, contactberichten). Geïmplementeerd in:
    *   `app/Models/User.php`
    *   `app/Providers/AuthServiceProvider.php` (voor Gates/Policies)
    *   `routes/web.php` (auth routes en middleware)
    *   Controllers (gebruik van `$this->authorize()` of `Gate::allows()`)
    *   Views (gebruik van `@can` of `@cannot`)

*   **Profiel:** Ingelogde gebruikers kunnen hun profielinformatie bekijken en bijwerken. Geïmplementeerd in:
    *   `app/Http/Controllers/ProfileController.php`
    *   `routes/web.php` (routes beginnend met `/profile`)
    *   `resources/views/profile/` (views zoals edit)

## Installatiehandleiding

Volg deze stappen om het project lokaal te installeren en te draaien:

1.  Zorg ervoor dat je PHP (versie 8.2 of hoger aanbevolen), Composer en Node.js/npm hebt geïnstalleerd.
2.  Kloon dit project naar je lokale computer. Je kunt dit doen met Git:
    ```bash
    git clone <url_van_je_github_repo>
    ```
3.  Open de terminal en navigeer naar de projectmap:
    ```bash
    cd naam_van_je_projectmap
    ```
4.  Installeer de PHP-afhankelijkheden met Composer:
    ```bash
    composer install
    ```
5.  Kopieer het `.env.example` bestand naar `.env` en pas de database-instellingen aan. Zorg ervoor dat je een MySQL database hebt aangemaakt en vul de juiste gegevens in het `.env` bestand (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
    ```bash
    cp .env.example .env
    ```
    Open het `.env` bestand en configureer je databaseverbinding.
6.  Genereer een applicatiesleutel:
    ```bash
    php artisan key:generate
    ```
7.  Draai de database-migraties om de benodigde tabellen aan te maken. Dit commando maakt ook standaard tabellen aan voor gebruikers, wachtwoordresets, etc.
    ```bash
    php artisan migrate
    ```
8.  (Optioneel) Vul de database met testdata door seeders te draaien. Dit kan handig zijn om snel testgebruikers of inhoud te hebben:
    ```bash
    php artisan db:seed
    ```
9.  Installeer de Node.js afhankelijkheden met npm of Yarn:
    ```bash
    npm install
    # of
    yarn install
    ```
10. Compileer de frontend assets (CSS en JavaScript):
    ```bash
    npm run dev
    # of
    yarn dev
    ```
    Voor een productie build gebruik je:
    ```bash
    npm run build
    # of
    yarn build
    ```
11. Start de lokale ontwikkelserver:
    ```bash
    php artisan serve
    ```

Het project zou nu beschikbaar moeten zijn via `http://127.0.0.1:8000` (of de poort die de `serve` commando aangeeft in je terminal).

## Screenshots van de Applicatie

Voeg hier screenshots toe van de belangrijkste pagina's en functionaliteiten van je applicatie om een visuele indruk te geven.

## Gebruikte Bronnen

Dit project is gebouwd met behulp van het Laravel framework en maakt gebruik van de Tailwind CSS utility-first CSS library. De volgende bronnen waren nuttig tijdens de ontwikkeling:

*   **Laravel Documentatie:** De officiële en uitgebreide documentatie voor het Laravel PHP framework. Een essentiële bron voor het begrijpen van het framework en de vele functies.
    [https://laravel.com/docs](https://laravel.com/docs)

*   **Tailwind CSS Documentatie:** De officiële documentatie voor Tailwind CSS, nuttig voor het stylen van de gebruikersinterface.
    [https://tailwindcss.com/docs](https://tailwindcss.com/docs)

*   **PHP Documentatie:** De officiële handleiding van de PHP programmeertaal.
    [https://www.php.net/docs](https://www.php.net/docs)

*   **MySQL Documentatie:** Documentatie voor de MySQL database, gebruikt als het opslagsysteem voor de applicatiegegevens.
    [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)

*   **Algemene Web Development Tutorials en Gidsen:** Diverse online bronnen, tutorials en community forums (zoals Stack Overflow, Laracasts, etc.) die hebben geholpen bij het oplossen van specifieke problemen en het leren van best practices in webontwikkeling met het Laravel framework.

*   **AI Code Assistent Chatlog:** De gesprekken met de AI code assistent zijn gebruikt ter ondersteuning bij het ontwikkelen, debuggen en verbeteren van specifieke delen van de code en documentatie. Je kunt de chatgeschiedenis van deze sessie exporteren en hier eventueel als apart bestand toevoegen of relevante fragmenten kopiëren.

## Licentie

[Voeg hier eventueel de licentie van je project toe, bijvoorbeeld MIT of GPL]
