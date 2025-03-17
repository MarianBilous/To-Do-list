# System zarządzania zadaniami

## Opis
Ten projekt jest systemem zarządzania zadaniami, który pozwala użytkownikom na tworzenie, edytowanie, usuwanie oraz przeglądanie zadań. Dodatkowo system obsługuje historię zmian, filtrowanie zadań, powiadomienia e-mail i dostęp do zadań po API.

## Technologie
- Laravel 11
- PHP 8.2
- MySQL
- Blade
- Node v20.14.0
- Bootstrap 5

## Instalacja

### 1. Klonowanie repozytorium
- git clone https://github.com/MarianBilous/To-Do-list.git

### 2. Instalacja zależności
- composer install
- npm install && npm run dev

### 3. Konfiguracja pliku .env
Utwórz plik `.env` na podstawie `.env.example`:

### 4. Konfiguracja bazy danych
Skonfiguruj połączenie z bazą danych w pliku `.env`. Domyślnie ustawienia są dla MySQL.

### 5. Migracje i dane testowe
php artisan migrate --seed
php artisan storage:link

Przejdź na http://localhost:8000, aby uzyskać dostęp do aplikacji.


## Endpointy API
- GET /api/tasks - pobranie listy zadań
- POST /api/tasks - utworzenie nowego zadania
- GET /api/tasks/{id} - pobranie szczegółów zadania
- PUT /api/tasks/{id} - aktualizacja zadania
- DELETE /api/tasks/{id} - usunięcie zadania

## Ważne komendy
### Autoryzacja
Po uruchomieniu migracji i seederów zostanie utworzony testowy użytkownik, a do niego będą przypisane zadania.

- Jego dane logowania do systemu:
    - testuser@example.com
    - password

Lub stwórz swoje konto.

### Dostęp do API
Aby uzyskać dostęp do API, należy wygenerować token API. Token generowany jest w sekcji **Settings** w prawym górnym rogu aplikacji.
Autentykacja odbywa się za pomocą **Bearer token**.
Wygenerowany token jest ważny przez **1 tydzień**.

### Powiadomienia e-mail
Aby uruchomić przetwarzanie kolejek, uruchom `php artisan queue:work` następnie w nowym terminalu `php artisan schedule:run`

