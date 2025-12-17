create database `Backoffice Unity CC`;
use `Backoffice Unity CC`;
create table departement(
    id int(11) PRIMARY key AUTO_INCREMENT,
    departementName varchar(50),
    location VARCHAR(100)
);
create table patient(
    id int(11) PRIMARY key AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    gender enum('male','female'),
    dateOfBirth DATE,
    phoneNum varchar(15),
    email VARCHAR(100),
    address VARCHAR(255) 
);
create table doctor(
    id int(11) PRIMARY key AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    specialization varchar(50),
    phoneNum varchar(15),
    email VARCHAR(100),
    departement_id int(11),
    foreign key (departement_id) references departement(id)
);
--departement table's fake data
INSERT INTO departement (departementName, location) VALUES
('Cardiology', 'Block A'),
('Neurology', 'Block B'),
('Pediatrics', 'Block C'),
('Orthopedics', 'Block D'),
('Radiology', 'Block E'),
('Emergency', 'Block A'),
('Oncology', 'Block F'),
('Dermatology', 'Block C'),
('Psychiatry', 'Block B');
--patient table's fake data
INSERT INTO patient 
(firstName, lastName, gender, dateOfBirth, phoneNum, email, address) VALUES
('John', 'Doe', 'male', '1990-05-12', '555-123-4567', 'john.doe@email.com', '12 Elm Street'),
('Sarah', 'Connor', 'female', '1985-08-22', '555-987-6543', 'sarah.connor@email.com', '45 Oak Avenue'),
('Michael', 'Brown', 'male', '1978-02-10', '555-456-7890', 'michael.brown@email.com', '78 Pine Road'),
('Emily', 'Watson', 'female', '1996-11-30', '555-321-9988', 'emily.watson@email.com', '22 Maple Lane'),
('David', 'Nguyen', 'male', '2001-01-15', '555-654-1122', 'david.nguyen@email.com', '90 Cedar Drive');
--doctor table's fake 
INSERT INTO doctor
(firstName, lastName, specialization, phoneNum, email, departement_id) VALUES
('James', 'Wilson', 'Cardiologist', '555-200-1001', 'j.wilson@hospital.com', 3),
('Anna', 'Miller', 'Neurologist', '555-200-1002', 'a.miller@hospital.com', 6),
('Robert', 'Johnson', 'Pediatrician', '555-200-1003', 'r.johnson@hospital.com', 9),
('Laura', 'Smith', 'Orthopedic Surgeon', '555-200-1004', 'l.smith@hospital.com', 4),
('Daniel', 'Garcia', 'Radiologist', '555-200-1005', 'd.garcia@hospital.com', 7),
('Sophia', 'Martinez', 'Emergency Physician', '555-200-1006', 's.martinez@hospital.com', 6),
('Kevin', 'Anderson', 'Psychiatrist', '555-200-1007', 'k.anderson@hospital.com', 9);

INSERT INTO patient 
(firstName)
VALUES ('Mahomed');
