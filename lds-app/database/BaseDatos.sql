CREATE database public_ldls_app;
use public_ldls_app;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  documento VARCHAR(50) UNIQUE NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  correo VARCHAR(160) NOT NULL,
  password VARCHAR(255) NOT NULL,
  perfil ENUM('admin','usuario') NOT NULL DEFAULT 'usuario',
  estado ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  fecha_nacimiento DATE NULL,
  edad INT NULL,
  foto VARCHAR(255) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS certificados (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  fecha_registro DATE NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  archivo VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS vacunas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  fecha_registro DATE NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  archivo VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (documento, nombre, apellido, correo, password, perfil, estado, fecha_nacimiento, edad, foto)
VALUES ('1234567890', 'Administrador', 'Principal', 'admin@gmail.com', 
        '$2y$12$1rm1zL0ur5rXGeP2Qy368e78O3lo16C1Txf5YkCzyRC4XVT52ahYi', 
        'admin', 'Activo', '2000-01-01', '25', 'I-1234567890-foto.jpg')
ON DUPLICATE KEY UPDATE correo=VALUES(correo);

--## Usuario: admin@gmail.com
--## Password: @dmin123
-- Validar al Finalizar
-- 'VALUES function' is deprecated and will be removed in a future release. Please use an alias (INSERT INTO ... VALUES (...) AS alias) and replace VALUES(col) in the ON DUPLICATE KEY UPDATE clause with alias.col instead