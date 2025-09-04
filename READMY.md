# Projekt iFairy / Why — Stan i Plan

Data wpisu: 2025-09-04 15:07 +01:00

## Stan Aktualny
- Framework: Laravel 12 (PHP 8.2); artisan dziala poprawnie.
- Frontend: Vite 7 + TailwindCSS + PostCSS; build zakonczony sukcesem (
pm ci && npm run build).
- Autoryzacja/UI: Breeze (Blade + komponenty). Po zalogowaniu trafiamy na dashboard (domyslny widok Breeze).
- Persona „why”: model, migracje i seeder z pliku why.json dzialaja (HomeController laduje aktywna persone „why”).
- API: GET /api/persona/{key} zwraca aktywna persone.
- Ostrzezenia builda: brak obrazów referencjonowanych w CSS/HTML (np. /img/auth-background.jpg, /img/why-hero-illustration.png).
- Composer nie jest w PATH, ale endor/ istnieje (zaleznosci PHP sa obecne).

## Oczekiwane Zachowanie
Po zalogowaniu uzytkownik powinien zobaczyc UI czatu z „Why” jako fundamentem.

## Luka Funkcjonalna
- Brak widoku i trasy czatu (nie istnieje ChatController, brak esources/views/chat/*.blade.php).
- dashboard nie prezentuje czatu ani nie przekierowuje do niego.
- Brak endpointu back-end do obslugi rozmów (LLM/integracja chatowa nie jest jeszcze wdrozona).
- Frontend nie zawiera komponentu czatu (formularz wejscia, lista wiadomosci, obsluga API).

## Plan Dzialan
1) Trasa i kontroler:
   - Dodac GET /chat (middleware uth).
   - Utworzyc ChatController@index renderujacy widok czatu z danymi persony „why”.
   - Opcja: przekierowac /dashboard ? /chat lub podmienic widok dashboard na czat.

2) Widok czatu (Blade + Tailwind):
   - Layout z lista wiadomosci i polem wejscia.
   - Integracja z Alpine.js/axios do wysylki/odbioru wiadomosci (na start mock/stub).

3) API czatu (etap I – stub):
   - POST /api/chat przyjmujacy historie/wiadomosc i zwracajacy odpowiedz (na razie prosta odpowiedz oparta o why.json lub echo, bez zewnetrznego LLM).

4) Integracja LLM (etap II – opcjonalnie):
   - Wydzielenie serwisu „ChatService” i podlaczenie do wybranego dostawcy (np. OpenAI, Anthropic lub wlasny endpoint), z kontrola bezpieczenstwa i cenzura tresci.

5) Assety i kosmetyka:
   - Dodac brakujace obrazy do public/img/ lub zmienic sciezki w CSS/HTML.
   - Uporzadkowac wpisy Vite (usunac pusty chunk ifairy-welcome lub dodac realny skrypt).

## Jak Uruchomic (Dev)
- Backend: php artisan serve
- Frontend (HMR): 
pm run dev
- Build prod: 
pm run build (artefakty w public/build)
- Baza danych: upewnij sie, ze .env ma poprawne dane i DB dziala; uruchom migracje/seed jesli potrzeba.

## Notatki
- Zródla kluczowe: outes/web.php, pp/Http/Controllers/*, esources/views/*, pp/Services/PersonaService.php, database/seeders/PersonaSeeder.php, why.json.
- W razie potrzeby doinstalowac Composer do aktualizacji paczek PHP (composer install).