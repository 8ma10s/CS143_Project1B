-- THIS FILE CREATES ALL TABLES NEEDED FOR THE PROJECT

-- Movie
-- primary key #1: cannot have two movies with same id
create table Movie(id int, title varchar(100),year int, rating varchar(10), company varchar(50),
       primary key(id))
       engine=innodb;

-- Actor
-- primary key #2: cannot have two actors with same id
-- check #1: dob must be less than or equal to dod
create table Actor(id int, last varchar(20), first varchar(20), sex varchar(6), dob date, dod date,
       primary key(id),
       check(dob <= dod))
       engine=innodb;

-- Sales
-- primary key #3: cannot have two sales info with same id (duplicate sales information) and cannot be null
-- referential integrity #1: mid must reference id from Movie table
-- check #2: tickets sold cannot be negative
create table Sales(mid int, ticketsSold int, totalIncome int,
       primary key(mid),
       foreign key (mid) references Movie(id),
       check(ticketsSold >= 0))
       engine=innodb;

-- Director
-- primary key #4: all directors must have different id
-- check #3: dob must be less than or equal to dod
create table Director(id int, last varchar(20), first varchar(20), dob date, dod date,
       primary key(id),
       check (dob <= dod))
       engine=innodb;

-- MovieGenre
-- referential integrity #2: mid must reference id from Movie
create table MovieGenre(mid int, genre varchar(20),
       primary key(mid,genre),
       foreign key (mid) references Movie(id))
       engine=innodb;

-- MovieDirector
-- primary key #5: cannot have 2 records with same combinations of mid and did
-- referential integrity #3: mid must reference id from Movie
-- referential integrity #4: did must reference id from Director
create table MovieDirector(mid int, did int,
       primary key(mid, did),
       foreign key (mid) references Movie(id),
       foreign key (did) references Director(id))
       engine=innodb;

-- MovieActor
-- referential integrity #5: mid must reference id from Movie
-- referential integrity #6: aid must reference id from Actor
create table MovieActor(mid int, aid int, role varchar(50),
       primary key(mid, aid, role),
       foreign key (mid) references Movie(id),
       foreign key (aid) references Actor(id))
       engine=innodb;

-- MovieRating
-- primary key #6: cannot have 2 ratings for same mid
-- referential integrity #7: mid must referene id from Movie
-- check #4: imdb and rot must be number between 0 and 100 
create table MovieRating(mid int, imdb int, rot int,
       primary key(mid),
       foreign key (mid) references Movie(id),
       check(imdb >= 0
       		  and imdb <= 100
		  and rot >= 0
		  and rot <= 100)
       )
       engine=innodb;

-- Review
-- primary key #7: cannot have 2 reviews with same name, timestamp, and mid
-- referential integrity #8: mid must reference id from Movie
create table Review(name varchar(20), time timestamp, mid int, rating int, comment varchar(500),
       primary key(name, time, mid),
       foreign key (mid) references Movie(id))
       engine=innodb;

-- MaxPersonID
create table MaxPersonID(id int);

-- MaxMovieID
create table MaxMovieID(id int);

