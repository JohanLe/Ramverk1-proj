DROP TABLE IF EXISTS User;

CREATE TABLE User(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "username" VARCHAR(20),
    "email" VARCHAR(255),
    "password" VARCHAR(255),
    "gravatar" TEXT
);

DROP TABLE IF EXISTS Question;

CREATE TABLE Question(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "title" VARCHAR(255),
    "user_id" INT,
    "date" DATE,
    "likes" INT,
    "categories" TEXT,
    "text" TEXT NOT NULL
);

DROP TABLE IF EXISTS Answer;

CREATE TABLE Answer(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "question_id" INT NOT NULL,
    "user_id" INT NOT NULL,
    "date" DATE NOT NULL,
    "likes" INT,
    "text" TEXT NOT NULL
);

DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "user_id" INT NOT NULL,
    "question_id" INT NOT NULL,
    "date" DATE NOT NULL,
    "likes" INT,
    "text" TEXT NOT NULL
);


DROP TABLE IF EXISTS Tag;

CREATE TABLE Tag(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "text" TEXT NOT NULL
);

DROP TABLE IF EXISTS Tag_Activity;

CREATE TABLE Tag_Activity(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "tag_id" INT NOT NULL,
    "question_id" INT NOT NULL
);





DROP TABLE IF EXISTS User_Activity;

CREATE TABLE User_Activity(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "user_id" INT NOT NULL,
    "type_id" INT NOT NULL,
    "type" VARCHAR(50) NOT NULL
);

insert into tag (text) VALUES ("Marvels");
insert into tag (text) VALUES ("Batman");
insert into tag (text) VALUES ("Thor");
insert into tag (text) VALUES ("Joker");
insert into tag (text) VALUES ("Steve Rogers");





insert into tag_activity (tag_id, question_id) VALUES (1, 223);
insert into tag_activity (tag_id, question_id) VALUES (1, 1232);
insert into tag_activity (tag_id, question_id) VALUES (1, 1232);

insert into tag_activity (tag_id, question_id) VALUES (2, 1232);
insert into tag_activity (tag_id, question_id) VALUES (2, 1232);
insert into tag_activity (tag_id, question_id) VALUES (2, 11);
insert into tag_activity (tag_id, question_id) VALUES (2, 223);
insert into tag_activity (tag_id, question_id) VALUES (2, 1232);
insert into tag_activity (tag_id, question_id) VALUES (2, 223);

insert into tag_activity (tag_id, question_id) VALUES (3, 421);
insert into tag_activity (tag_id, question_id) VALUES (3, 1232);

insert into tag_activity (tag_id, question_id) VALUES (4, 1212332);

insert into tag_activity (tag_id, question_id) VALUES (5, 12123232);
           
insert into user (id, username, email, password, gravatar) VALUES (1234, "strix", "aa@gmail.com", "superHash", "none");
insert into user (id, username, email, password, gravatar) VALUES (223, "Lenon", "bb@gmail.com", "superHash", "none");
insert into user (id, username, email, password, gravatar) VALUES (523, "Thor321", "acc@gmail.com", "superHash", "none");
insert into user (id, username, email, password, gravatar) VALUES (5223, "Steve", "steve@gmail.com", "superHash", "none");

insert into question (id, user_id, title, text, date, likes) VALUES (3325, "strix", "Who is best?", "Superman or batman?", "2020-10-11", -5);
insert into question (id, user_id, title, text, date, likes) VALUES (12, "Lenon", "Who is best?", "Harley Quin or Joker?", "2020-09-10", 5);
insert into question (id, user_id, title, text, date, likes) VALUES (6668, "Thor321", "Captain america strong?", "Is he?", "2020-11-10", 5);
insert into question (id, user_id, title, text, date, likes) VALUES (33, "Steven", "Who is batman?", "Mr rogers?", "2021-11-10", 5);
insert into question (id, user_id, title, text, date, likes) VALUES (662268, "Thor321", "Where does hulk live?", "India", "2020-01-02", 5);
insert into question (id, user_id, title, text, date, likes) VALUES (6612368, "Thor321", "How old is captain america?", "I belive he is 97", "2020-01-03", 5);
insert into question (id, user_id, title, text, date, likes) VALUES (6555668, "Thor321", "Why is marvel movies so good?", "Thor or Hulk?", "2020-02-01", 5);
