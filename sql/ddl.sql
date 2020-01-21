DROP TABLE IF EXISTS User;

CREATE TABLE User(
    "id" INTEGER PRIMARY KEY,
    "username" VARCHAR(20),
    "email" VARCHAR(255),
    "password" VARCHAR(255),
    "gravatar" TEXT
);

DROP TABLE IF EXISTS Question;

CREATE TABLE Question(
    "id" INTEGER PRIMARY KEY NOT NULL,
    "title" VARCHAR(255),
    "text" TEXT NOT NULL,
    "userId" INT,
    "date" DATE
);

DROP TABLE IF EXISTS Answer;

CREATE TABLE Answer(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "questionId" INT NOT NULL,
    "userId" INT NOT NULL,
    "date" DATE NOT NULL,
    "likes" INT,
    "text" TEXT NOT NULL
);

DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "userId" INT NOT NULL,
    "questionId" INT NOT NULL,
    "answerId" INT,
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
    "tagId" INT NOT NULL,
    "questionId" INT NOT NULL
);





DROP TABLE IF EXISTS User_Activity;

CREATE TABLE User_Activity(
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "userId" INT NOT NULL,
    "typeId" INT NOT NULL,
    "type" VARCHAR(50) NOT NULL
);





/**
*   Triggers

INSERT INTO ANSWER (id,questionId,userId,date,text) VALUES(1,3,223,'2020-01-15','very interesting question sir');
*/


/**
*
*/



/**
*   log User activity after insert into question table.
*/

CREATE TRIGGER Log_question_activity AFTER INSERT ON Question
BEGIN
    INSERT INTO User_Activity(userId, typeId, type) 
        VALUES (NEW.userId, NEW.id, "question");

END;

/**
*   log User activity after insert into question table.
*/

CREATE TRIGGER Log_answer_activity AFTER INSERT ON Answer
BEGIN
    INSERT INTO User_Activity(userId, typeId, type) 
        VALUES (NEW.userId, NEW.id, "answer");

END;

/**
*   log User activity after insert into question table.
*/

CREATE TRIGGER Log_comment_activity AFTER INSERT ON Comment
BEGIN
    INSERT INTO User_Activity(userId, typeId, type) 
        VALUES (NEW.userId, NEW.id, "comment");

END;


insert into User (username, email, password, gravatar) VALUES ("strix", "aa@gmail.com", "superHash", "none");
insert into User (username, email, password, gravatar) VALUES ("Lenon", "bb@gmail.com", "superHash", "none");
insert into User (username, email, password, gravatar) VALUES ("Thor321", "acc@gmail.com", "superHash", "none");
insert into User (username, email, password, gravatar) VALUES ("Steve", "steve@gmail.com", "superHash", "none");


insert into Tag (text) VALUES ("Marvels");
insert into Tag (text) VALUES ("Superman");


insert into Question (userId, title, text, date) VALUES (1, "How many Marvel characters can you name?", "Wolverie, Spider-man,Thor, Ironman, Hulk, Captain America, Deadpool ", "2020-10-11");
insert into Question (userId, title, text, date) VALUES (2, "Who is best ?", "Harley Quin or Joker?", "2020-09-10");
insert into Question (userId, title, text, date) VALUES (2, "Captain america strength?", "How many car can he lift??", "2020-11-10");
insert into Question (userId, title, text, date) VALUES (2,  "Who is batman?", "Mr rogers?", "2021-11-10");
insert into Question (userId, title, text, date) VALUES (4,  "Why is marvel movies so good?", "Thor or Hulk?", "2020-02-01");



insert into Tag_Activity (tagId, questionId) VALUES (1, 1);
insert into Tag_Activity (tagId, questionId) VALUES (2, 1);
insert into Tag_Activity (tagId, questionId) VALUES (2, 2);
insert into Tag_Activity (tagId, questionId) VALUES (2, 3);



INSERT INTO Answer (questionId,userId,date,text) VALUES(1,1,'2020-01-15','Silver Surfer, Gambit, Cyclops, Nick Fury');
INSERT INTO Answer (questionId,userId,date,text) VALUES(2,2,'2020-01-15','Captain america is very storong');
INSERT INTO Answer (questionId,userId,date,text) VALUES(1,3,'2020-01-15','Hulk is best');
INSERT INTO Answer (questionId,userId,date,text) VALUES(1,4,'2020-01-15','Well done. Nightcrawler, Ducky Barnes');

INSERT INTO Comment (userId, questionId, answerId,date,text) VALUES(3,1,0,'2020-01-15','Is ant-man from marvels?');
