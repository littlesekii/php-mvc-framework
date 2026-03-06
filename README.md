## How to run

This project uses Docker to provide a consistent development environment.

### 1️⃣ Clone the repository

```bash
git clone https://github.com/littlesekii/php-mvc-framework.git
cd php-mvc-framework
```

### 2️⃣ Generate PSR-4 composer autoload files

```bash
composer dump-autoload
```

### 3️⃣ Build and start the containers

```bash
docker compose up -d --build
```

This will start:

- Nginx (web server)
- PHP 8.3 (FPM)

### 4️⃣ Access the application

Open your browser and go to:

http://localhost:7001/

---

## 🛑 Stop the containers

```bash
docker compose down
```

---

## 🐚 Access the container

```bash
docker exec -it <container_name> bash
```

---

## 📄 View container logs

```bash
docker compose logs -f
```