# Relational Schema

# C2C Josiah Stearns
Documentation: Github copilot enabled during development (primarily syntax suggestions)
No other help received


## Rooms
This table stores data for each laundry room referenced in the system, including geographic location, an image which is a floorplan of the room, and the dimensions of the room.

| Attribute | Data Type    | Key and Constraints |
|-----------|--------------|---------------------|
| id        | int(16)      | PRIMARY KEY         |
| name      | varchar(64)  | NOT NULL            |
| image     | varchar(256) | NOT NULL            |
| lat       | float(10, 6) | NOT NULL            |
| lon       | float(10, 6) | NOT NULL            |
| width     | int(16)      | NOT NULL            |
| height    | int(16)      | NOT NULL            |

## Types
This table stores the types of laundry machines which are available in the system, and includes the name of the type (i.e. Washer, Dryer, etc.), an image which is used as an icon for that machine, the dimensions of the machine, and the amount of time that once cycle will take to complete.

| Attribute | Data Type    | Key and Constraints |
|-----------|--------------|---------------------|
| id        | int(16)      | PRIMARY KEY         |
| name      | varchar(64)  | NOT NULL            |
| image     | varchar(256) | NOT NULL            |
| cycleTime | int(16)      | NOT NULL            |
| width     | int(16)      | NOT NULL            |
| height    | int(16)      | NOT NULL            |


## Machines
This table represents the actual laundry machines in the system, and contains attributes for the machine's type, the room that the machine is placed in, and the QR code numbrer that is located on the machine's sticker (which will be used by users when scanning the machine to select an action on that specific machine).

| Attribute | Data Type    | Key and Constraints |
|-----------|--------------|---------------------|
| id        | int(16)      | PRIMARY KEY         |
| typeID    | int(16)      | FOREIGN KEY         |
| roomID    | int(16)      | FOREIGN KEY         |
| qr        | int(16)      | NOT NULL            |
| lat       | float(10, 6) | NOT NULL            |
| lon       | float(10, 6) | NOT NULL            |

## Users
This table simply stores the users that have signed up, with their name.  It is used to correlate loads and issues to user names so that identifying information can be displayed when necessary, but does not store any other personal information or a password (because user-login is not required - login functionality only implemented for admins in order to streamline the user experience).

| Attribute | Data Type    | Key and Constraints |
|-----------|--------------|---------------------|
| id        | int(16)      | PRIMARY KEY         |
| name      | varchar(256  | NOT NULL            |


## Loads
This table tracks the loads of laundry that have been placed into machines and reported by users (by click the "I'm loading laundry" button in the user interface).  It tracks the user that owns the load, the machine it was placed in, and the time it was loaded.  It can be used to view the owner of the last load placed in a machine, as well as aggregated to determinet the business of the laundry room.

| Attribute | Data Type    | Key and Constraints |
|-----------|--------------|---------------------|
| id        | int(16)      | PRIMARY KEY         |
| machineID | int(16)      | FOREIGN KEY         |
| userID    | int(16)      | FOREIGN KEY         |
| load      | datetime     | NOT NULL            |


## Issues
This table tracks issues reported about laundry machines by users (i.e. not cleaning well, broken, etc.).  It tracks the user that reported the issue, the machine that the issue was reported on, time time the issue was reported, and a brief description of the issue.

| Attribute   | Data Type    | Key and Constraints |
|-------------|--------------|---------------------|
| id          | int(16)      | PRIMARY KEY         |
| machineID   | int(16)      | FOREIGN KEY         |
| userID      | int(16)      | FOREIGN KEY         |
| severity    | int(16)      | NOT NULL            |
| description | varchar(256  | NOT NULL            |