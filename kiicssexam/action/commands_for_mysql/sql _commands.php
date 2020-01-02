<?php


$create_manage_users = "CREATE TABLE manage_users (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, username varchar(60) NOT NULL, password varchar(80) NOT NULL)";


$create_administration = "CREATE TABLE administration (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, admin_username varchar(60) NOT NULL, admin_password varchar(80) NOT NULL, admin_type varchar(40) NOT NULL)";


$create_candidate_details = "CREATE TABLE candidate_details (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, can_name varchar(40) NOT NULL, can_email varchar(150) NOT NULL, can_contact varchar(10), can_gender varchar(10) NOT NULL, can_blood_group varchar(10) NOT NULL, can_DOB date NOT NULL, can_address varchar(100) NOT NULL, can_university varchar(10) NOT NULL, can_college varchar(10) NOT NULL, can_cgpa decimal(10,2) NOT NULL, can_passout_year varchar(10) NOT NULL, dates timestamp)";


$create_login = "CREATE TABLE login (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, sub_id varchar(80) NOT NULL, sub_password varchar(80) NOT NULL, question_nos int(11)";


$create_questions = "CREATE TABLE questions (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, qno int(11) NOT NULL, sub_id varchar(40) NOT NULL, question text, optionA varchar(200) NOT NULL, optionB varchar(200) NOT NULL, optionC varchar(200) NOT NULL, optionD varchar(200) NOT NULL, answer varchar(200) NOT NULL, marks decimal(8,2) NOT NULL, status_given tinyint(1) DEFAULT 1, date_added timestamp)";

$create_answers = "CREATE TABLE answers (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, sub_id varchar(40) NOT NULL, user_name varchar(40) NOT NULL, user_email varchar(150) NOT NULL, qno int(11) NOT NULL, answers_given varchar(10) NOT NULL, marksgot decimal(8,2) NOT NULL, dates timestamp)";

