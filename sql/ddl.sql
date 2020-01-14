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

DROP TABLE IF EXISTS Activity;

CREATE TABLE Activity(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "user_id" INT NOT NULL,
    "type_id" INT NOT NULL,
    "type" VARCHAR(50) NOT NULL
);

insert into tag (id, text) VALUES (12345, "Marvels");
insert into tag (id, text) VALUES (225, "Batman");

insert into user (id, username, email, password, gravatar) VALUES (1234, "strix", "aa@gmail.com", "superHash", "none");
insert into user (id, username, email, password, gravatar) VALUES (223, "Lenon", "bb@gmail.com", "superHash", "none");
insert into user (id, username, email, password, gravatar) VALUES (523, "Thor321", "acc@gmail.com", "superHash", "none");

insert into question (id, user_id, title, text, date, likes) VALUES (3325, "strix", "Who is best?", "Superman or batman?", 2020-10-11, -5);
insert into question (id, user_id, title, text, date, likes) VALUES (12, "Lenon", "Who is best?", "Harley Quin or Joker?", 2020-09-10, 5);
insert into question (id, user_id, title, text, date, likes) VALUES (6668, "Thor321", "Who is best?", "Thor or Hulk?", 2020-12-10, 5);