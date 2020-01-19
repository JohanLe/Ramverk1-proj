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
    "answer_id" INT,
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





/**
*   Triggers

INSERT INTO ANSWER (id,question_id,user_id,date,text) VALUES(1,3,223,'2020-01-15','very interesting question sir');
*/



/**
*   log User activity after insert into question table.
*/

CREATE TRIGGER Log_question_activity AFTER INSERT ON Question
BEGIN
    INSERT INTO User_Activity(user_id, type_id, type) 
        VALUES (NEW.user_id, NEW.id, "question");

END;

/**
*   log User activity after insert into question table.
*/

CREATE TRIGGER Log_answer_activity AFTER INSERT ON Answer
BEGIN
    INSERT INTO User_Activity(user_id, type_id, type) 
        VALUES (NEW.user_id, NEW.id, "answer");

END;

/**
*   log User activity after insert into question table.
*/

CREATE TRIGGER Log_comment_activity AFTER INSERT ON Comment
BEGIN
    INSERT INTO User_Activity(user_id, type_id, type) 
        VALUES (NEW.user_id, NEW.id, "comment");

END;


insert into User (username, email, password, gravatar) VALUES ("strix", "aa@gmail.com", "superHash", "none");
insert into User (username, email, password, gravatar) VALUES ("Lenon", "bb@gmail.com", "superHash", "none");
insert into User (username, email, password, gravatar) VALUES ("Thor321", "acc@gmail.com", "superHash", "none");
insert into User (username, email, password, gravatar) VALUES ("Steve", "steve@gmail.com", "superHash", "none");


insert into Tag (text) VALUES ("Marvels");
insert into Tag (text) VALUES ("Superman");


insert into Question (user_id, title, text, date, likes) VALUES (1, "Who is best?", "Superman or batman?", "2020-10-11", -5);
insert into Question (user_id, title, text, date, likes) VALUES (2, "Who is best 2?", "Harley Quin or Joker?", "2020-09-10", 5);
insert into Question (user_id, title, text, date, likes) VALUES (2, "Captain america strong?", "Is he?", "2020-11-10", 5);
insert into Question (user_id, title, text, date, likes) VALUES (2,  "Who is batman?", "Mr rogers?", "2021-11-10", 5);
insert into Question (user_id, title, text, date, likes) VALUES (2, "Where does hulk live?", "India", "2020-01-02", 5);
insert into Question (user_id, title, text, date, likes) VALUES (3,"How old is captain america?", "I belive he is 97", "2020-01-03", 5);
insert into Question (user_id, title, text, date, likes) VALUES (4,  "Why is marvel movies so good?", "Thor or Hulk?", "2020-02-01", 5);
insert into Question (user_id, title, text, date, likes) VALUES (4,  "How old is Bruce Wayne?", "I belive he is 38.What do u think?", "2020-02-01", 5);


insert into Tag_Activity (tag_id, question_id) VALUES (1, 1);
insert into Tag_Activity (tag_id, question_id) VALUES (2, 1);
insert into Tag_Activity (tag_id, question_id) VALUES (2, 2);
insert into Tag_Activity (tag_id, question_id) VALUES (2, 3);



INSERT INTO Answer (question_id,user_id,date,text) VALUES(1,1,'2020-01-15','Captain america is very storong');
INSERT INTO Answer (question_id,user_id,date,text) VALUES(2,2,'2020-01-15','Captain america is very storong');
INSERT INTO Answer (question_id,user_id,date,text) VALUES(1,3,'2020-01-15','Hulk is better');
INSERT INTO Answer (question_id,user_id,date,text) VALUES(1,4,'2020-01-15','Iron man way better then CA');

INSERT INTO Comment (user_id, question_id, answer_id,date,text) VALUES(3,1,0,'2020-01-15','AWEFUL COMMENT sir');
INSERT INTO Comment (user_id, question_id, answer_id,date,text) VALUES(3,1,0,'2020-01-17','very interesting COMMENT sir');
INSERT INTO Comment (user_id, question_id, answer_id,date,text) VALUES(3,1,1,'2020-01-1','COMMENT sir');
INSERT INTO Comment (user_id, question_id, answer_id,date,text) VALUES(3,1,1,'2020-01-21','COMMENT TO an ANSWER');