drop table event_registrations;
CREATE TABLE event_registrations (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  registration_number VARCHAR(50) UNIQUE,
  registration_name VARCHAR(50) NOT NULL,
  phone VARCHAR(10) NOT NULL,
  whatsapp VARCHAR(10),
  email VARCHAR(100),
  sex VARCHAR(10),
  food_habit VARCHAR(20),
  address TEXT,
  age INT(3),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE `event_registrations` ADD UNIQUE `my_uniq_student`(`registration_name`, `phone`);