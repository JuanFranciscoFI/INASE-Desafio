-- init.sql

DROP TABLE IF EXISTS analysis_results;
DROP TABLE IF EXISTS samples;

CREATE TABLE samples (
  id CHAR(36) NOT NULL PRIMARY KEY,
  seal_number VARCHAR(50) NOT NULL,
  company VARCHAR(150) NOT NULL,
  species VARCHAR(100) NOT NULL,
  seed_quantity INT UNSIGNED NOT NULL CHECK (seed_quantity >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE analysis_results (
  sample_id CHAR(36) NOT NULL PRIMARY KEY,
  germination_power DECIMAL(5,2) NOT NULL,
  purity DECIMAL(5,2) NOT NULL,
  inert_materials TEXT NULL,
  CONSTRAINT fk_analysis_sample FOREIGN KEY (sample_id) REFERENCES samples(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
