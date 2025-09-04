SQL
`USE your_database_name;

-- 1) Extend users (run once; remove if columns already exist)
ALTER TABLE users
ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 1 AFTER password,
ADD COLUMN settings JSON NULL AFTER remember_token;

-- 2) Personas
CREATE TABLE IF NOT EXISTS personas (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
key VARCHAR(64) NOT NULL UNIQUE,
name VARCHAR(120) NOT NULL,
type VARCHAR(120) NULL,
version VARCHAR(20) NULL,
last_updated DATE NULL,
is_active TINYINT(1) NOT NULL DEFAULT 1,
data JSON NOT NULL,
updated_by BIGINT UNSIGNED NULL,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL,
INDEX idx_personas_active (is_active),
CONSTRAINT personas_updated_by_fk
FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3) Persona revision history (optional but recommended)
CREATE TABLE IF NOT EXISTS persona_revisions (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
persona_id BIGINT UNSIGNED NOT NULL,
version INT NOT NULL,
data JSON NOT NULL,
created_by BIGINT UNSIGNED NULL,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
UNIQUE KEY persona_version_unique (persona_id, version),
CONSTRAINT pr_persona_fk
FOREIGN KEY (persona_id) REFERENCES personas(id) ON DELETE CASCADE,
CONSTRAINT pr_user_fk
FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4) App-wide settings (single row: id=1)
CREATE TABLE IF NOT EXISTS app_settings (
id TINYINT UNSIGNED NOT NULL PRIMARY KEY,
site_name VARCHAR(120) DEFAULT 'iFairy',
url VARCHAR(255) NULL,
timezone VARCHAR(64) DEFAULT 'UTC',
locale VARCHAR(10) DEFAULT 'en',
flags JSON NULL,
data JSON NULL,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed app_settings (safe upsert pattern)
INSERT INTO app_settings (id, site_name, url, timezone, locale, flags, data, created_at, updated_at)
VALUES (1, 'iFairy', 'https://why.ifairy.ai', 'UTC', 'en', NULL, NULL, NOW(), NOW())
ON DUPLICATE KEY UPDATE
site_name=VALUES(site_name),
url=VALUES(url),
timezone=VALUES(timezone),
locale=VALUES(locale),
updated_at=NOW();

-- 5) Seed the WHY persona metadata (data = empty for now; fill via phpMyAdmin editor)
INSERT INTO personas (key,name,type,version,last_updated,is_active,data,created_at,updated_at)
VALUES ('why','Why','iFairy (Interactive Fairy)','1.0','2025-08-16',1,'{}',NOW(),NOW())
ON DUPLICATE KEY UPDATE
name=VALUES(name),
type=VALUES(type),
version=VALUES(version),
last_updated=VALUES(last_updated),
is_active=VALUES(is_active),
updated_at=NOW();`