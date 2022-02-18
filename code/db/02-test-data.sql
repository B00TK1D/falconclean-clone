INSERT INTO `rooms` (name, image, lat, lon, width, height) VALUES
('Vandy Laundry Room', 'vandy.jpg', 37.37, -122.0, 20, 20);

INSERT INTO `types` (name, image, cycleTime, width, height) VALUES
('Washer', 'washer.jpg', 30, 20, 20),
('Dryer', 'dryer.jpg', 30, 20, 20);

INSERT INTO `machines` (typeID, roomID, qr) VALUES
(1, 1, 1),
(2, 1, 2);

INSERT INTO `users` (name) VALUES
('John Doe'),
('Jane Smith');

INSERT INTO `loads` (userID, machineID) VALUES
(1, 1),
(1, 2);

INSERT INTO `issues` (userID, machineID, description) VALUES
(1, 1, 'Broken'),
(1, 2, 'Not drying');