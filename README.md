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
- Utwórz plik `.env` na podstawie `.env.example`:
- php artisan key:generate

### 4. Konfiguracja bazy danych
Skonfiguruj połączenie z bazą danych w pliku `.env`. Domyślnie ustawienia są dla MySQL.

### 5. Migracje i dane testowe
- php artisan migrate --seed
- php artisan storage:link
- php artisan serve

Przejdź na http://localhost:8000 lub http://127.0.0.1:8000/, aby uzyskać dostęp do aplikacji.


## Endpointy API
### GET /api/tasks - pobranie listy zadań
  - Odpowiedź (200 - Ok):
    ```sh
      [
        {
          "id": 1,
          "name": "Et cum.",
          "description": "Necessitatibus omnis necessitatibus quisquam est culpa. Esse officiis molestias voluptatum ut.",
          "priority": "high",
          "status": "done",
          "deadline": "2025-03-22",
          "user_id": 1,
          "access_token": null,
          "access_token_expires_at": null,
          "created_at": "2025-03-17T20:07:29.000000Z",
          "updated_at": "2025-03-17T20:07:29.000000Z"
        },
        {
          "id": 2,
          "name": "Minima neque itaque expedita eum.",
          "description": "Ab rerum aut debitis. Assumenda exercitationem suscipit aut et. Error id velit libero illum qui.",
          "priority": "medium",
          "status": "in-progress",
          "deadline": "2025-03-22",
          "user_id": 1,
          "access_token": null,
          "access_token_expires_at": null,
          "created_at": "2025-03-17T20:07:29.000000Z",
          "updated_at": "2025-03-17T20:07:29.000000Z"
        }
      ]
    ```
### GET /api/tasks/{id} - pobranie szczegółów zadania

  - Odpowiedź (200 - Ok):

    ```sh
       {
          "id": 1,
          "name": "Et cum.",
          "description": "Necessitatibus omnis necessitatibus quisquam est culpa. Esse officiis molestias voluptatum ut.",
          "priority": "high",
          "status": "done",
          "deadline": "2025-03-22",
          "user_id": 1,
          "access_token": null,
          "access_token_expires_at": null,
          "created_at": "2025-03-17T20:07:29.000000Z",
          "updated_at": "2025-03-17T20:07:29.000000Z"
       }
    ```
  - Odpowiedź (404 - Not Found)
    ```sh
      {
        "message": "Task not found"
      }
    ```
### POST /api/tasks - tworzenie nowego zadania

  - Dane wejściowe::
    ```sh
    {
       "name": "Et cum.",
       "description": "Necessitatibus omnis necessitatibus quisquam est culpa. Esse officiis molestias voluptatum ut.",
       "priority": "high",
       "status": "done",
       "deadline": "2025-03-22",
    }
    ```
  - Odpowiedź (201 - Created):
    ```sh
      {
          "name": "Et cum.",
          "description": "Necessitatibus omnis necessitatibus quisquam est culpa. Esse officiis molestias voluptatum ut.",
          "priority": "high",
          "status": "done",
          "deadline": "2025-03-22",
          "user_id": 1,
          "updated_at": "2025-03-17T20:29:25.000000Z",
          "created_at": "2025-03-17T20:29:25.000000Z",
          "id": 12
      }
    ```
  - Odpowiedź (422 - Validation Error)
    ```sh
      {
          "message": "The name field is required. (and 1 more error)",
          "errors": {
              "name": [
                  "The name field is required."
              ],
              "deadline": [
                  "The deadline field is required."
              ]
          }
      }
    ```
### PUT /api/tasks/{id} - aktualizacja zadania
- Dane wejściowe::
  ```sh
    {
       "name": "Et cum edit.",
       "description": "Necessitatibus omnis necessitatibus quisquam est culpa. Esse officiis molestias voluptatum ut.",
       "priority": "high",
       "status": "done",
       "deadline": "2025-03-22",
    }
    ```
- Odpowiedź (200 - Ok):
  ```sh
    true
  ```
- Odpowiedź (404 - Not Found)
  ```sh
    {
        "message": "Task not found",
    }
  ```
### DELETE /api/tasks/{id} - usunięcie zadania
- Odpowiedź (200 - OK):
    ```sh
    {
        "message": "Task deleted successfully"
    }
    ```
- Odpowiedź (404 - Not Found)
    ```sh
    {
        "message": "Task not found"
    }
    ```

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

