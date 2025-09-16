# LUCEROS DE LA SALUD - APP

Aplicación web en PHP 8 + MySQL + Bootstrap 5 con:
- Login con roles (Admin / Usuario)
- CRUD de usuarios (crear, editar –sin cambiar Documento–, inactivar/activar, eliminar solo Admin)
- Tabs del formulario: Datos Personales, Certificados (PDF ≤ 2 MB), Vacunas (PDF ≤ 2 MB)
- Cálculo de días restantes y alertas a partir de 10 días (SweetAlert + correo)
- Dashboard Admin con: búsqueda, exportar Excel/PDF por estado (Creados/Activos/Inactivos), alertas por vencer
- Dashboard Usuario: ver, buscar y editar usuarios, sin eliminar; ver alertas
- Envío automático de correos de alerta diario a las **08:00 a.m. UTC-5** mediante cron
- Reportes con gráfico tipo torta (Chart.js)
- Subidas en `Uploads/images`, `Uploads/Certificados`, `Uploads/Vacunas`. Nombres: `I-<documento>-...`, `C-<documento>-...`, `V-<documento>-...`

## Requisitos
- PHP 8.1+
- MySQL 5.7/8
- Extensiones: `mysqli`, `mbstring`, `openssl`, `curl` (php.ini)
- Servidor web (Apache o Nginx). En Apache habilita `mod_rewrite`.

## Instalación
1. Crea base de datos y usuario en MySQL.
2. Importa `database/db.sql`.
3. Copia el proyecto a tu servidor web y configura permisos de escritura a `Uploads/`.
4. Edita `config.php` con credenciales de BD y SMTP (Gmail u otro).
5. Abre `http://tu-dominio/` para iniciar sesión.
   - Usuario inicial: ** admin@gmail.com ** / ** admin123 **.
6. Programa el CRON (Linux) para el envío automático de alertas:
   ```bash
   # Ejecuta todos los días a las 08:00 a.m. UTC-5 (America/Bogota)
   # Ajusta la ruta a PHP y al archivo.
   0 8 * * * php /mnt/data/php-crud-alerts/cron/send_alerts.php >> /mnt/data/php-crud-alerts/logs/cron.log 2>&1
   ```

## Estructura
- `config.php` — Variables de entorno (DB/SMTP) y utilidades
- `auth/` — Manejo de login/logout y middleware
- `admin/` — Vistas y acciones para Admin
- `user/` — Vistas para Usuario
- `export/` — Exportar a Excel (CSV) y PDF
- `cron/` — Script de alertas
- `vendor/PHPMailer/` — Librería PHPMailer (sin Composer)
- `Uploads/` — Archivos subidos (crear carpetas con permisos 755/775)

## Notas
- Límite de archivo: 2 MB. Ajusta `upload_max_filesize` y `post_max_size`(php.ini) si es necesario.
- Con Gmail, habilita **contraseñas de aplicaciones**. SMTP TLS 587 recomendado.
- Este proyecto es adaptable a tus políticas de seguridad (CSRF, headers, etc.).