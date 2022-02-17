-------------  User data --------------
INSERT INTO `rooms` (name, image, lat, lon, width, height) VALUES
('Vandy Laundry Room', 'vandy.jpg', 37.37, -122.0, 20, 20);

INSERT INTO `types` (name, image, cycleTime, width, height) VALUES
('Washer', 'washer.jpg', 30, 20, 20),
('Dryer', 'dryer.jpg', 30, 20, 20);

INSERT INTO `machines` (typeID, roomID, qr, lat lon) VALUES
(1, 1, 1, '37.37', '-122.1'),
(2, 1, 2, '37.37', '-122.2');

INSERT INTO `users` (name) VALUES
('John Doe'),
('Jane Smith');

INSERT INTO `loads` (userID, machineID, load) VALUES
(1, 1, '2022-02-01 12:00:00'),
(1, 2, '2022-02-01 12:02:00');

INSERT INTO `issues` (userID, machineID, issue) VALUES
(1, 1, 'Broken'),
(1, 2, 'Not drying');