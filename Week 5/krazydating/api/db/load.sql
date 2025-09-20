drop database if exists krazydating;

create database if not exists krazydating;

use krazydating;

CREATE TABLE if not exists `person_table` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `occupation` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `photo_url` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `quote` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


insert into person_table values (10001, 'Brandon Single', 56, 'M', 'Journalist', 'New York', '/krazydating/photos/brandon.png', "brandon@email.com", "pass", "Fitness enthusiast with a soft spot for pizza. Can we be workout buddies...and cheat day partners?");
insert into person_table values (10002, 'Chein Mingle', 23, 'M', 'Musician', 'Sydney', '/krazydating/photos/chein.png', "chein@email.com", "pass", "Bringing good vibes and spicy ramen to the table. Let's swap playlists and life stories.");
insert into person_table values (10003, 'Darryl Oppa', 34, 'M', 'HR Professional', 'Los Angeles', '/krazydating/photos/darryl.png', "darryl@email.com", "pass", "Adventurer by day, Netflix aficionado by night - looking for someone to explore both sides with.");
insert into person_table values (10004, 'Nick Kim', 22, 'M', 'Architect', 'Pyongyang', '/krazydating/photos/nick.png', "nick@email.com", "pass", "Dog dad, coffee lover, and always down for a spontaneous road trip. Let's make life an adventure.");
insert into person_table values (10005, 'Ryan Lala', 27, 'M', 'Dancer', 'London', '/krazydating/photos/ryan.png', "ryan@email.com", "pass", "Sarcasm is my love language, but I promise I'm serious about finding someone special.");
insert into person_table values (10006, 'Zac Bundy', 43, 'M', 'Customer Success Manager', 'Hong Kong', '/krazydating/photos/zac.png', "zac@email.com", "pass", "Part-time musician, full-time dreamer. Let's create a life with epic soundtracks and good vibes.");
insert into person_table values (10007, 'Eric Tan', 20, 'M', 'Software Engineer', 'Singapore', '/krazydating/photos/eric.png', "eric@email.com", "pass", "Lost in a crowd but still feeling alone - maybe you're the connection I've been looking for.");
insert into person_table values (10008, 'Doug Toe', 37, 'M', 'Accountant', 'Helsinki', '/krazydating/photos/doug.png', "doug@email.com", "pass", "Got the house, now just looking for someone to make it a home - ready to move in?");
insert into person_table values (10009, 'Mike Tyson', 58, 'M', 'Boxer', 'Las Vegas', '/krazydating/photos/mike.png', "mike@email.com", "pass", "Punching through life with strength and heart. Looking for someone to stand in my corner.");
insert into person_table values (10010, 'Joe Black', 30, 'M', 'Photographer', 'Paris', '/krazydating/photos/joe.png', "joe@email.com", "pass", "Capturing moments and chasing sunsets. Let's create a picture-perfect story together.");
insert into person_table values (10011, 'Buck Niceman', 29, 'M', 'Carpenter', 'Toronto', '/krazydating/photos/buck.png', "buck@email.com", "pass", "Building a life full of love, laughter, and the perfect wooden furniture. Ready to join?");
insert into person_table values (10012, 'Kenny Dear', 25, 'M', 'Barista', 'Melbourne', '/krazydating/photos/kenny.png', "kenny@email.com", "pass", "Brewing the perfect cup of coffee, but missing the perfect company to share it with.");
insert into person_table values (10013, 'Bill Clinton', 77, 'M', 'Public Speaker', 'Washington D.C.', '/krazydating/photos/bill.png', "bill@email.com", "pass", "A former president with a passion for storytelling. Let's write the next chapter together.");
insert into person_table values (10014, 'Eddie Peng', 41, 'M', 'Actor', 'Taipei', '/krazydating/photos/eddie.png', "eddie@email.com", "pass", "Lights, camera, romance! Looking for someone to share the spotlight with.");
insert into person_table values (10015, 'Jim Halpert', 24, 'M', 'Graphic Designer', 'Miami', '/krazydating/photos/justin.png', "justin@email.com", "pass", "Designing a life of creativity and fun - hoping to find someone to add the final touch.");
insert into person_table values (10016, 'Bob Builder', 35, 'M', 'Construction Worker', 'Chicago', '/krazydating/photos/bob.png', "bob@email.com", "pass", "Let's build something lasting together, one brick at a time.");
insert into person_table values (10017, 'Adam Song', 28, 'M', 'Musician', 'Seoul', '/krazydating/photos/adam.png', "adam@email.com", "pass", "Music is life. If you want to duet in love and harmony, I'm your guy.");
insert into person_table values (10018, 'Frank Hyung', 39, 'M', 'Chef', 'San Francisco', '/krazydating/photos/frank.png', "frank@email.com", "pass", "Cooking up something special, and all I need is the right person to share it with.");



insert into person_table values (20001, 'Yin Kit Catwater', 22, 'F', 'Hacker', 'Paris', '/krazydating/photos/yinkit.png', "yinkit@email.com", "pass", "Quiet nights in with a good movie or exploring the city — I'm down for both. Bonus points if you love cats.");
insert into person_table values (20002, 'Supreme Woman', 55, 'F', 'Unemployed', 'Seoul', '/krazydating/photos/supreme.png', "supreme@email.com", "pass", "I run on good coffee, great books, and even better conversations. Let's keep it classy and quirky.");
insert into person_table values (20003, 'Emily Prada', 35, 'F', 'Financial Consultant', 'Moscow', '/krazydating/photos/emily.png', "emily@email.com", "pass", "If we laugh together, we'll probably get along. Dog lover, sushi enthusiast, and trivia champion.");
insert into person_table values (20004, 'Bingbing Fong', 41, 'F', 'High School Teacher', 'Beijing', '/krazydating/photos/bingbing.png', "bingbing@email.com", "pass", "Creative soul with a love for art, music, and meaningful conversations. Beep me if you're the same.");
insert into person_table values (20005, 'Ananya Bae', 24, 'F', 'Stunt Actor', 'Dubai', '/krazydating/photos/ananya.png', "ananya@email.com", "pass", "Jet-setter with a heart for meaningful connections. Click on me if you believe in love and adventure.");
insert into person_table values (20006, 'Suzy Lee', 20, 'F', 'Student', 'Singapore', '/krazydating/photos/suzy.png', "suzy@email.com", "pass", "Ambitious by day, a hopeless romantic by night. Looking for someone who can handle both.");
insert into person_table values (20007, 'Feebee Potato', 20, 'F', 'Chef', 'New Orleans', '/krazydating/photos/feebee.png', "feebee@email.com", "pass", "Chasing dreams and sunsets, but still waiting for someone to chase them with me.");
insert into person_table values (20008, 'Marie Claire', 32, 'F', 'Journalist', 'London', '/krazydating/photos/marie.png', "marie@email.com", "pass", "Storytelling is my passion, and I'm always chasing the next big adventure. Looking for a partner who shares my curiosity.");
insert into person_table values (20009, 'Wendy Burger', 28, 'F', 'Chef', 'New York', '/krazydating/photos/wendy.png', "wendy@email.com", "pass", "Cooking up gourmet meals and good vibes. If you're hungry for love, I'm ready to serve.");
insert into person_table values (20010, 'Tiffany Trump', 30, 'F', 'Lawyer', 'Washington D.C.', '/krazydating/photos/tiffany.png', "tiffany@email.com", "pass", "Legal expert by day, fashionista by night. Seeking someone who can keep up with my high-flying lifestyle.");
insert into person_table values (20011, 'Elizabeth Taylor', 35, 'F', 'Actress', 'Los Angeles', '/krazydating/photos/elizabeth.png', "elizabeth@email.com", "pass", "Old Hollywood glamour meets modern-day ambition. Looking for someone who can sweep me off my feet.");
insert into person_table values (20012, 'Mariah Carey', 54, 'F', 'Singer', 'New York', '/krazydating/photos/mariah.png', "mariah@email.com", "pass", "Living in a world of melodies and high notes. If you're ready for a diva, let's make beautiful music together.");
insert into person_table values (20013, 'Diana Ross', 80, 'F', 'Singer', 'Detroit', '/krazydating/photos/diana.png', "diana@email.com", "pass", "Still singing the hits and living life like a Motown queen. Join me on this soulful journey.");
insert into person_table values (20014, 'Hillary Rodham', 76, 'F', 'Politician', 'New York', '/krazydating/photos/hillary.png', "hillary@email.com", "pass", "Strong, determined, and always ready for a challenge. Seeking someone who can match my drive and passion.");
insert into person_table values (20015, 'Nancy Pelosi', 83, 'F', 'Politician', 'San Francisco', '/krazydating/photos/nancy.png', "nancy@email.com", "pass", "A lifetime of leadership and service. Looking for someone who believes in partnership and progress.");
insert into person_table values (20016, 'Victoria Beckham', 49, 'F', 'Fashion Designer', 'London', '/krazydating/photos/victoria.png', "victoria@email.com", "pass", "Fashion-forward and business-savvy. Let's walk the runway of life together.");
insert into person_table values (20017, 'Britney Spears', 42, 'F', 'Performer', 'Las Vegas', '/krazydating/photos/britney.png', "britney@email.com", "pass", "A pop icon looking for someone who can keep up with my moves. Let's make this a toxic-free love story.");
insert into person_table values (20017, 'April Mak', 18, 'F', 'Guitarist', 'Osaka', '/krazydating/photos/april.png', "april@email.com", "pass", "April may be my name, but I'm here to make your whole year brighter!");
