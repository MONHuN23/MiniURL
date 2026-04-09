# Funkcionális Specifikáció - MiniURL

## 1. Áttekintés
A MiniURL célja, hogy a felhasználók hosszú, nehezen kezelhető URL-eket rövid, megjegyezhető hivatkozásokká alakítsanak. A rendszer fő hangsúlya a sebességen és az egyszerű kezelhetőségen van.

## 2. Felhasználói Szerepkörök
* **Vendég:** Olyan felhasználó, aki nem regisztrált. Rövidíthet linkeket, de nem látja a korábbi előzményeit.
* **Regisztrált Felhasználó:** Saját profillal rendelkezik, ahol mentve maradnak a linkjei és törölheti azokat.

## 3. Részletes Funkciók

### 3.1. Link rövidítés (Alap)
A felhasználó megad egy érvényes URL-t (pl. `https://google.com`). A rendszer generál egy 8 karakteres véletlenszerű azonosítót (pl. `aB2x9K1m`).
* **Eredmény:** `http://localhost:8000/aB2x9K1m`

### 3.2. Egyedi link rövidítés
A felhasználó megadhat egy egyedi utótagot. 
* **Bemenet:** `https://laracasts.com` + `tanulas`
* **Eredmény:** `http://localhost:8000/tanulas`
* **Szabály:** Ha az utótag már foglalt, a rendszer hibaüzenetet dob.

### 3.3. Átirányítás (Redirect)
Amikor valaki megnyitja a rövidített linket, a rendszer az adatbázis alapján megkeresi az eredeti URL-t és `302 Found` (vagy 301) státuszkóddal átirányítja a böngészőt.

## 4. Adatbázis Modell (Link)
| Mező | Típus | Leírás |
| :--- | :--- | :--- |
| `id` | BigInt | Elsődleges kulcs |
| `original_url` | Text | A hosszú link |
| `short_url` | String | Az egyedi azonosító (Unique) |
| `user_id` | Foreign Key | Kapcsolat a User táblával (Nullable) |
| `created_at` | Timestamp | A létrehozás ideje |