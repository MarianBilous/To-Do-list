# DONE.md - Raport z wykonanej pracy

## Opis ogólny
Ten projekt realizuje system zarządzania zadaniami z pełnym wsparciem dla operacji CRUD, filtrowania zadań, powiadomień e-mail oraz historii zmian.

## Zrealizowane funkcje:

### 1. **CRUD:**
- Tworzenie, odczyt, aktualizacja i usuwanie zadań z polami:
    - Nazwa, opis, priorytet, status, termin wykonania.
- Zastosowanie Eloquent ORM do pracy z bazą danych.

### 2. **Przeglądanie zadań:**
- Zadania można filtrować według priorytetu, statusu i terminu wykonania.

### 3. **Powiadomienia e-mail:**
- Użyto Laravel Queues oraz Scheduler do wysyłania powiadomień e-mail na dzień przed terminem wykonania zadania.

### 4. **Walidacja:**
- Zaimplementowane walidatory dla formularzy tworzenia oraz edytowania zadań.

### 5. **Obsługa wielu użytkowników:**
- Użyto wbudowanej autentykacji Laravel przy użyciu pakietu laravel/breeze.

### 6. **Publiczny dostęp przez linki z tokenem:**
- Dodano możliwość generowania publicznych linków do zadań z ograniczonym czasem dostępu.

### 7. **Historia zmian:**
- Zaimplementowano zapisywanie historii zmian zadań za pomocą observerów i zapisów w bazie danych.

### 8. API
- Implementacja operacji CRUD.
- Walidacja danych przy użyciu `Validator`.
- Ochrona endpointów przed nieautoryzowanym dostępem.

### 9. **Bezpieczeństwo:**
- Wszystkie API są chronione za pomocą autentykacji oraz autoryzacji. 
- Zastosowano mechanizmy ochrony przed SQL Injection.
- Ochrona przed XSS leży po stronie frontendu.
- W przypadku API mechanizm CSRF nie jest wymagany.

### Podsumowanie:
Projekt demonstruje efektywne wykorzystanie Laravel do stworzenia prostego, ale potężnego systemu zarządzania zadaniami. Zrealizowane wszystkie kluczowe funkcjonalności, uwzględniając dobre praktyki bezpieczeństwa oraz czystość kodu.
