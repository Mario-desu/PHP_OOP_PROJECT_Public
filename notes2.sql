-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Sep 2021 um 18:24
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `notes2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `fk_entry_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`id`, `content`, `fk_entry_id`, `time`, `fk_user_id`) VALUES
(9, 'Cooles Zitat!', 1, '2021-09-05 21:13:28', 1),
(19, 'Danke für den Tipp!', 10, '2021-09-05 22:18:51', 1),
(20, 'Gefällt mir auch!', 10, '2021-09-05 22:19:43', 3),
(26, 'Das hab ich in der Schule gelesen. LG Sabine', 17, '2021-09-06 10:58:48', 8),
(27, 'Das hab ich in der Schule gelesen. LG Sabine', 17, '2021-09-06 13:29:10', 8),
(28, 'Ich lese gerade Kafka in der Schule LG Franz', 20, '2021-09-13 09:52:11', 2),
(33, 'alert(\'Meldung\');', 20, '2021-09-13 10:05:49', 2),
(37, ' Bootstrap Link\r\n', 19, '2021-09-14 09:10:39', 1),
(38, 'Lustiger Artikel! LG Franz', 19, '2021-09-14 09:11:04', 1),
(39, 'Mehr davon! LG Martina', 19, '2021-09-14 09:19:05', 1),
(41, 'Noch mehr!', 19, '2021-09-14 09:20:52', 1),
(48, 'Danke für die Info!! LG Mario', 10, '2021-09-14 13:04:31', 1),
(49, 'Hahahaha! LG Mario', 12, '2021-09-14 13:07:28', 1),
(50, 'Danke dir! LG', 10, '2021-09-14 15:03:51', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `entries`
--

INSERT INTO `entries` (`id`, `title`, `content`, `status`, `time`, `fk_user_id`) VALUES
(1, 'Back to Future Zitat', 'Well looky what we have here. No no no, you\'re staying right here with me. That\'s right. Are you sure about this storm? How could I have been so careless. One point twenty-one gigawatts. Tom, how am I gonna generate that kind of power, it can\'t be done, it can\'t. Hey Dad, George, hey, you on the bike.\r\n\r\n', 'public', '2021-09-04 19:29:00', 3),
(2, 'Cupcake Rezept', 'Die kleinen Rührteig-Törtchen mit meist üppigem Hauberl kommen neudeutsch als Cupcakes daher. Ursprünglich kommt der Name ganz einfach vom englischen Wort \"Cup\" für Häferl, denn darin wurden die Küchlein früher gemacht.\r\n\r\nIn der Basis vom berühmten Muffin kaum zu unterscheiden, strahlen die Cupcakes mit ihrer meist aufwändigen Dekoration pure Backschönheit aus. Das sogenannte Cupcake Topping oder auch Frosting kann mit verschiedensten Cremen gemacht werden. Ob Buttercreme oder Frischkäsefrosting, ob Mascarpone oder Erdnussbutter als Basis, das Topping ist der krönende Abschluss eines jeden Cupcakes. Marzipan, Früchte oder allerlei Zuckerdekor und Schokoladeelemente verschönern das Backwerk zusätzlich.\r\n\r\n', 'public', '2021-09-06 08:40:15', 3),
(4, 'Arzttermin vereinbart', '20.09.2021, 15:00', 'public', '2021-09-14 16:03:53', 1),
(5, 'Urlaub buchen', 'The best Lorem Ipsum Generator in all the sea! Heave this scurvy copyfiller fer yar next adventure and cajol yar clients into walking the plank with ev\'ry layout! Configure above, then get yer pirate ipsum...own the high seas, arg!', 'public', '2021-09-04 19:54:30', 1),
(10, 'Bauanleitung Kasten', 'Warum sollte sich jemand die Mühe machen und einen Schrank selber bauen wollen? Ganz einfach: Weil es Spaß macht! Weil die Schränke aus den Möbelgeschäften Massenware sind. Weil die normierten Größen nicht in genau die Nische passen, die in der eigenen Wohnung noch ungenutzt ist. Weil es den „Einen“ Schrank, den, der perfekt zum eigenen Lifestyle passt, noch gar nicht gibt. Deshalb geben wir alles und wollen „unseren“ Schrank selber bauen!!', 'public', '2021-09-13 08:47:00', 2),
(11, 'Katze füttern', 'Pommy ipsum splendid I\'d reet fancy a one feels that curry sauce, cor blimey\' off the hook a tenner bog off. Naff off Victoria sponge cake pillock pulled out the eating irons grab a jumper flog a dead horse numbskull, shortbread hadn\'t done it in donkey\'s years cottage pie tad scones. Hard cheese old boy bloody shambles a cracking toad in the whole, alright geezer. Golly rubbish could murder a pint naff in the goolies I\'m off to Bedfordshire sausage roll nonsense bloody mary Geordie, devonshire cream tea down the village green pork dripping brown sauce gobsmacked 10 pence mix knows bugger all about nowt sorted it.', 'private', '2021-09-06 08:01:26', 1),
(12, 'Britischer Humor', 'Pommy ipsum splendid I\'d reet fancy a one feels that curry sauce, cor blimey\' off the hook a tenner bog off. Naff off Victoria sponge cake pillock pulled out the eating irons grab a jumper flog a dead horse numbskull, shortbread hadn\'t done it in donkey\'s years cottage pie tad scones. Hard cheese old boy bloody shambles a cracking toad in the whole, alright geezer. Golly rubbish could murder a pint naff in the goolies I\'m off to Bedfordshire sausage roll nonsense bloody mary Geordie, devonshire cream tea down the village green pork dripping brown sauce gobsmacked 10 pence mix knows bugger all about nowt sorted it.', 'private', '2021-09-06 08:05:00', 1),
(13, 'Käsefondue Rezept', 'Rubber cheese cheesy grin emmental. Fromage frais melted cheese cheese and wine cheese strings cheddar boursin brie monterey jack. Macaroni cheese edam bavarian bergkase stilton melted cheese red leicester airedale boursin. Cauliflower cheese lancashire babybel.', 'public', '2021-09-06 08:20:16', 2),
(14, 'The Walking Dead 4. Staffel', 'Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium. Qui animated corpse, cricket bat max brucks terribilem incessu zomby. The voodoo sacerdos flesh eater, suscitat mortuos comedere carnem virus. Zonbi tattered for solum oculi eorum defunctis go lum cerebro. Nescio brains an Undead zombies. Sicut malus putrid voodoo horror. Nigh tofth eliv ingdead.', 'public', '2021-09-06 08:21:25', 2),
(15, 'Hipster-Sprache Beispiel', 'I\'m baby health goth mumblecore franzen keytar schlitz glossier cliche ugh. Semiotics tacos viral lo-fi mustache photo booth adaptogen pug swag cornhole. Brooklyn YOLO gentrify, cray bitters bicycle rights chartreuse. Franzen tousled VHS mustache woke edison bulb stumptown hexagon marfa cloud bread intelligentsia put a bird on it organic hoodie pickled. Organic live-edge vape, readymade cronut adaptogen art party gastropub hot chicken sustainable freegan. Irony twee kale chips paleo 3 wolf moon bicycle rights VHS tilde umami fingerstache. Irony whatever mixtape retro meh.', 'private', '2021-09-06 08:22:24', 2),
(16, 'Fantasiesprache Textbeispiel', 'Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic quam Occidental in fact, it va esser Occidental. A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que Occidental es.Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.', 'public', '2021-09-06 09:36:37', 6),
(17, 'Buchzusammenfassung Die Leiden des jungen Werther', 'Eine wunderbare Heiterkeit hat meine ganze Seele eingenommen, gleich den süßen Frühlingsmorgen, die ich mit ganzem Herzen genieße. Ich bin allein und freue mich meines Lebens in dieser Gegend, die für solche Seelen geschaffen ist wie die meine. Ich bin so glücklich, mein Bester, so ganz in dem Gefühle von ruhigem Dasein versunken, daß meine Kunst darunter leidet. Ich könnte jetzt nicht zeichnen, nicht einen Strich, und bin nie ein größerer Maler gewesen als in diesen Augenblicken. Wenn das liebe Tal um mich dampft, und die hohe Sonne an der Oberfläche der undurchdringlichen Finsternis meines Waldes ruht, und nur einzelne Strahlen sich in das innere Heiligtum stehlen, ich dann im hohen Grase am fallenden Bache liege, und näher an der Erde tausend mannigfaltige Gräschen mir merkwürdig werden; wenn ich das Wimmeln der kleinen Welt zwischen Halmen, die unzähligen, unergründlichen Gestalten der Würmchen, der Mückchen näher an meinem Herzen fühle, und fühle die Gegenwart des Allmächtigen, der uns nach seinem Bilde schuf, das Wehen des Alliebenden, der uns in ewiger Wonne schwebend trägt und erhält; mein Freund! Wenn\'s dann um meine Augen dämmert, und die Welt um mich her und der Himmel ganz in meiner Seele ruhn wie die Gestalt einer', 'public', '2021-09-06 09:41:25', 6),
(18, 'Beispiel für Platzhalter', 'Überall dieselbe alte Leier. Das Layout ist fertig, der Text lässt auf sich warten. Damit das Layout nun nicht nackt im Raume steht und sich klein und leer vorkommt, springe ich ein: der Blindtext. Genau zu diesem Zwecke erschaffen, immer im Schatten meines großen Bruders »Lorem Ipsum«, freue ich mich jedes Mal, wenn Sie ein paar Zeilen lesen. Denn esse est percipi - Sein ist wahrgenommen werden. Und weil Sie nun schon die Güte haben, mich ein paar weitere Sätze lang zu begleiten, möchte ich diese Gelegenheit nutzen, Ihnen nicht nur als Lückenfüller zu dienen, sondern auf etwas hinzuweisen, das es ebenso verdient wahrgenommen zu werden: Webstandards nämlich. Sehen Sie, Webstandards sind das Regelwerk, auf dem Webseiten aufbauen. So gibt es Regeln für HTML, CSS, JavaScript oder auch XML; Worte, die Sie vielleicht schon einmal von Ihrem Entwickler gehört haben. Diese Standards sorgen dafür, dass alle Beteiligten aus einer Webseite den größten Nutzen ziehen. Im Gegensatz zu früheren Webseiten müssen wir zum Beispiel nicht mehr zwei verschiedene Webseiten für den Internet Explorer und einen anderen Browser programmieren. Es reicht eine Seite, die - richtig angelegt - sowohl auf verschiedenen Browsern im Netz funktioniert, aber ebenso gut für den Ausdruck oder', 'private', '2021-09-06 09:42:14', 6),
(19, 'Fußballtrainer Sprüche', 'Es gibt im Moment in diese Mannschaft, oh, einige Spieler vergessen ihnen Profi was sie sind. Ich lese nicht sehr viele Zeitungen, aber ich habe gehört viele Situationen. Erstens: wir haben nicht offensiv gespielt. Es gibt keine deutsche Mannschaft spielt offensiv und die Name offensiv wie Bayern. Letzte Spiel hatten wir in Platz drei Spitzen: Elber, Jancka und dann Zickler. Wir müssen nicht vergessen Zickler. Zickler ist eine Spitzen mehr, Mehmet eh mehr Basler. Ist klar diese Wörter, ist möglich verstehen, was ich hab gesagt? Danke. Offensiv, offensiv ist wie machen wir in Platz. Zweitens: ich habe erklärt mit diese zwei Spieler: nach Dortmund brauchen vielleicht Halbzeit Pause. Ich habe auch andere Mannschaften gesehen in Europa nach diese Mittwoch. Ich habe gesehen auch zwei Tage die Training. Ein Trainer ist nicht ein Idiot! Ein Trainer sei sehen was passieren in Platz. In diese Spiel es waren zwei, drei diese Spieler waren schwach wie eine Flasche leer! Haben Sie gesehen Mittwoch, welche Mannschaft hat gespielt Mittwoch? Hat gespielt Mehmet oder gespielt Basler oder hat gespielt Trapattoni? Diese Spieler beklagen mehr als sie spielen! Wissen Sie, warum die Italienmannschaften kaufen nicht diese Spieler? Weil wir haben gesehen viele Male solche Spiel! Haben', 'public', '2021-09-06 10:17:38', 7),
(20, 'Kafka Beispiel', 'Jemand musste Josef K. verleumdet haben, denn ohne dass er etwas Böses getan hätte, wurde er eines Morgens verhaftet. »Wie ein Hund!« sagte er, es war, als sollte die Scham ihn überleben. Als Gregor Samsa eines Morgens aus unruhigen Träumen erwachte, fand er sich in seinem Bett zu einem ungeheueren Ungeziefer verwandelt. Und es war ihnen wie eine Bestätigung ihrer neuen Träume und guten Absichten, als am Ziele ihrer Fahrt die Tochter als erste sich erhob und ihren jungen Körper dehnte. »Es ist ein eigentümlicher Apparat«, sagte der Offizier zu dem Forschungsreisenden und überblickte mit einem gewissermaßen bewundernden Blick den ihm doch wohlbekannten Apparat. Sie hätten noch ins Boot springen können, aber der Reisende hob ein schweres, geknotetes Tau vom Boden, drohte ihnen damit und hielt sie dadurch von dem Sprunge ab. In den letzten Jahrzehnten ist das Interesse an Hungerkünstlern sehr zurückgegangen. Aber sie überwanden sich, umdrängten den Käfig und wollten sich gar nicht fortrühren.Jemand musste Josef K. verleumdet haben, denn ohne dass er etwas Böses getan hätte, wurde er eines Morgens verhaftet. »Wie ein Hund!« sagte er, es war, als sollte die Scham ihn überleben. Als Gregor Samsa eines Morgens aus unruhigen Träumen erwachte, fand er sich', 'public', '2021-09-06 10:19:08', 7),
(21, 'Arzttermin ausmachen', 'Dr. Maier, Zahnarzt', 'private', '2021-09-06 10:20:27', 7),
(22, 'Prüfung verschieben', 'Weit hinten, hinter den Wortbergen, fern der Länder Vokalien und Konsonantien leben die Blindtexte. Abgeschieden wohnen sie in Buchstabhausen an der Küste des Semantik, eines großen Sprachozeans. Ein kleines Bächlein namens Duden fließt durch ihren Ort und versorgt sie mit den nötigen Regelialien. Es ist ein paradiesmatisches Land, in dem einem gebratene Satzteile in den Mund fliegen. Nicht einmal von der allmächtigen Interpunktion werden die Blindtexte beherrscht – ein geradezu unorthographisches Leben. Eines Tages aber beschloß eine kleine Zeile Blindtext, ihr Name war Lorem Ipsum, hinaus zu gehen in die weite Grammatik. Der große Oxmox riet ihr davon ab, da es dort wimmele von bösen Kommata, wilden Fragezeichen und hinterhältigen Semikoli, doch das Blindtextchen ließ sich nicht beirren. Es packte seine sieben Versalien, schob sich sein Initial in den Gürtel und machte sich auf den Weg. Als es die ersten Hügel des Kursivgebirges erklommen hatte, warf es einen letzten Blick zurück auf die Skyline seiner Heimatstadt Buchstabhausen, die Headline von Alphabetdorf und die Subline seiner eigenen Straße, der Zeilengasse. Wehmütig lief ihm eine rhetorische Frage über die Wange, dann setzte es seinen Weg fort. Unterwegs traf es eine Copy. Die Copy warnte das Blindtextchen, da, wo sie herkäme wäre sie', 'private', '2021-09-06 10:54:24', 8),
(23, 'Laufen gehen', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 'public', '2021-09-06 10:55:22', 8),
(27, 'Inhalt darf leer bleiben', '', 'private', '2021-09-14 07:33:50', 1),
(36, 'Schulsachen kaufen gehen', 'Müller, Libro', 'private', '2021-09-14 13:08:37', 1),
(37, 'Laufschuhe bestellen', 'Größe 43', 'private', '2021-09-14 13:48:10', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pwd_reset`
--

CREATE TABLE `pwd_reset` (
  `pwdResetId` int(1) NOT NULL,
  `pwdResetEmail` varchar(255) NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `pwd_reset`
--

INSERT INTO `pwd_reset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(17, 'vie.mario@yahoo.ca', 'a04f39f3ea351edc', '$2y$10$pFaNCtV2MWbgCD/wyc1/Iu7.EOf.rEYOD0x.CgqpECCgzVOC4FNTW', '1630875750');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `role`) VALUES
(1, 'Mario', 'Hartleb', 'mario.hartleb@yahoo.com', '$2y$12$DahzqV/UZa/lC6HmvDVO4eFXMcHd3/1DTKctV3inlf10aJFyDtbwO', 'admin'),
(2, 'Franz', 'Huber', 'franz@mail.com', '$2y$12$xIeglfeDnBYmwsSB7BVsluyDU5L/Nna2MRTQkUuGhoCBa.9FSQQU.', 'user'),
(3, 'Monika', 'Müller', 'monika@gmail.com', '$2y$12$FutD3Vu0hqm68m3RDgrzouWIp63zBL1fcQHJCfnO0ZSfigx8GE.pi', 'user'),
(6, 'Mike', 'Johnsson', 'mike@yahoo.com', '$2y$12$3R4TVC7iM.QzaPiDTzpeCOQw2iSwY8CzFoet4ulsY.59k0Xy7rTKO', 'user'),
(7, 'Martina', 'Maierhofer', 'martina@mail.com', '$2y$12$OsBrIK/wqLEfZogfFk4S2ebsg5wgY3w0XtkBMO4lkZYosoQWg63/C', 'user'),
(8, 'Sabine', 'Bauer', 'sabine@gmail.com', '$2y$12$Nf2PTx.gDRy/GcZH7UTa8ehqMpVvnEeWBcMULYLlWUgqv9uyhvTFa', 'user'),
(11, 'Peter', 'Müllner', 'peter@mail.com', '$2y$12$AEwV.MpOEe2l2c5chItb.OUTU.HqxEkPUtrLerSFeYryzGTW38kvC', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entry_id` (`fk_entry_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `pwd_reset`
--
ALTER TABLE `pwd_reset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT für Tabelle `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT für Tabelle `pwd_reset`
--
ALTER TABLE `pwd_reset`
  MODIFY `pwdResetId` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`fk_entry_id`) REFERENCES `entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
