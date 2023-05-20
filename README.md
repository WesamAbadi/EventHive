# EventHive ⬢⬡⬢

##### EventHive is a PHP-based website that allows users to search for, register, and provide feedback on events. It also allows event organizers to manage their events and track attendance and ticket sales.  

⬢ (made for web programming2 course).   
⬡ User Authentication    
⬢ User-Friendly Interface    
⬡ MySQL, HTML/CSS    


##### Get Started with SQL:  
```angular2html
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255),
password VARCHAR(255)
);
ALTER TABLE events ADD likes INT DEFAULT 0;

CREATE TABLE events (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255),
description TEXT,
user_id INT,
likes INT DEFAULT 0,
FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (username, password) VALUES
('john_doe', 'password123'),
('jane_smith', 'pass987'),
('alex_wilson', 'qwerty456');

INSERT INTO events (title, description, user_id, likes) VALUES
('Birthday Party', 'Join us for a fun-filled birthday celebration!', 1, 10),
('Conference', 'Learn about the latest industry trends and network with professionals.', 2, 5),
('Charity Fundraiser', 'Support a noble cause and make a difference.', 3, 15);

CREATE TABLE likes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  event_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (event_id) REFERENCES events(id),
  UNIQUE KEY (user_id, event_id)
);  





```

