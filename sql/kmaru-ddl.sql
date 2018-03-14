ALTER DATABASE kmaru CHARACTER SET utf8 COLLATE utf8_unicode_ci;
DROP TABLE IF EXISTS ledger;
DROP TABLE IF EXISTS board;
DROP TABLE IF EXISTS card;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS profile;

-- profile table:
CREATE TABLE profile(
-- attribute for primary key:
	profileId BINARY(16) NOT NULL,
	-- attributes for profile:
	profileActivationToken CHAR(32),
	profileEmail VARCHAR(128) NOT NULL,
	profileHash CHAR(128) NOT NULL,
	profileName VARCHAR(50),
	profilePrivilege TINYINT UNSIGNED,
	profileSalt CHAR(64) NOT NULL,
	profileUsername VARCHAR(50),
	-- unique index created:
	UNIQUE (profileEmail),
	UNIQUE (profileUsername),
	-- Primary key:
	PRIMARY KEY(profileId)
	);
-- category table:
CREATE TABLE category(
-- attribute for primary key:
	categoryId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	categoryProfileId BINARY(16) NOT NULL,
	-- attributes for category;
	categoryName VARCHAR(64) NOT NULL,
	-- unique index created:
	INDEX (categoryProfileId),
	INDEX (categoryName),
	-- create foreign keys and relationships:
	FOREIGN KEY (categoryProfileId) REFERENCES profile(profileId),
	-- Primary key:
	PRIMARY KEY(categoryId)
);

-- card table:
CREATE TABLE card(
-- attribute for primary key:
	cardId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	cardCategoryId BINARY(16) NOT NULL,
	-- attributes for card:
	cardAnswer VARCHAR(255) NOT NULL,
	cardPoints TINYINT UNSIGNED,
	cardQuestion VARCHAR(255),
	-- unique index created:
	INDEX (cardCategoryId),
	INDEX (cardPoints),
	-- create foreign keys and relationships:
	FOREIGN KEY (cardCategoryId) REFERENCES category(categoryId),
	-- Primary Key:
	PRIMARY KEY(cardId)
);

-- board table:
CREATE TABLE board(
	-- attribute for primary key:
	boardId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	boardProfileId BINARY(16) NOT NULL,
	-- other attribute for board:
	boardName VARCHAR(64),
	-- unique index created:
	INDEX (boardProfileId),
	-- create foreign key and relationships:
	FOREIGN KEY (boardProfileId) REFERENCES profile(profileId),
	-- Primary key:
	PRIMARY KEY (boardId)
);

-- ledger table:
CREATE TABLE ledger(
	-- attribute for foreign keys:
	ledgerBoardId BINARY(16) NOT NULL,
	ledgerCardId BINARY(16) NOT NULL,
	ledgerProfileId BINARY(16) NOT NULL,
	-- attributes for ledger:
	ledgerPoints MEDIUMINT SIGNED,
	ledgerType TINYINT UNSIGNED,
	-- unique index created:
	INDEX (ledgerBoardId),
	INDEX (ledgerCardId),
	INDEX (ledgerProfileId),
	-- create foreign keys and relationships:
	FOREIGN KEY (ledgerBoardId) REFERENCES board(boardId),
	FOREIGN KEY (ledgerCardId) REFERENCES card(cardId),
	FOREIGN KEY (ledgerProfileId) REFERENCES profile(profileId),
	-- Primary Key (compound key):
	PRIMARY KEY (ledgerBoardId, ledgerCardId, ledgerProfileId)
);




-- categories:

INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), UNHEX(REPLACE('C2954660-F27B-4557-8F2D-C68E8B2D8AA8', '-', '')), 'Star Trek Villains');


INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'Star Trek Captains');

INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'Star Trek Kitties');

INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'Star Trek Ships');


-- boards:


INSERT INTO board(boardId, boardProfileId, boardName)
VALUES (UNHEX(REPLACE('0c1c711e-e2e4-439d-9975-9658851b1781', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'DDC');

INSERT INTO board(boardId, boardProfileId, boardName)
VALUES (UNHEX(REPLACE('129c71cf-89e0-4d5d-9968-3c4cf079fd46', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'great game');

-- cards:

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX(REPLACE('32577dd4-4853-4054-a868-d119663f1106', '-', '')), UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 1', '1' , 'The name of the villain 1');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX(REPLACE('d77169b9-f139-487e-b9fd-c91a0d3435bb', '-', '')), UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 2', '2' , 'The name of the villain 2');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('91f5634c-7f7b-437e-bcc0-c69b55db60be', '-', '')),UNHEX (REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 4', '4' , 'The name of the villain 4');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('f7b6b5f9-e4fa-42aa-84a3-770b6938072b', '-', '')),UNHEX (REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 8', '8' , 'The name of the villain 8');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('155456a2-5926-4071-bfa8-5e21fb5402ae', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 1', '1' , 'The name of the captain 1');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('f182ca2e-84e6-4171-acbd-64f7354a215e', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 2', '2' , 'The name of the captain 2');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('6ce80295-f37c-4baf-9eb5-ce03246c38c9', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 4', '4' , 'The name of the captain 4');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('5ce35d28-9fc9-4092-8fcd-e5d9e41b9dcc', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 8', '8' , 'The name of the captain 8');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('fa41de8f-f69b-47cd-8b71-6fff8a3a1185', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 2', '2', 'The name of kitty 2');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('887f97ee-d606-4bbf-afde-b4db4a14d124', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 4', '4', 'The name of kitty 4');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('713d6c92-f9e3-4394-b972-56ff92ad128b', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 32', '32', 'The name of kitty 32');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('dc378e11-8c7d-4086-9238-7b0b76bd9628', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 16', '16', 'The name of kitty 16');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('15beed3c-5abd-4b08-a4ba-c15723be9efc', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')), 'who is ship 16', '16', 'The name of ship 16');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('2c731a3f-c001-4fe8-9886-6984624f7a1a', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')),'who is ship 1', '1', 'The name of ship 1');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('584f6c15-6dbc-420f-854e-35d552235042', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')),'who is ship 8', '8', 'The name of ship 8');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('39b12f66-f8ab-4ea4-b9cf-c18a202e466b', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')),'who is ship 4', '4', 'The name of ship 4');




-- Bootstrap Category:
INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), UNHEX(REPLACE('C2954660-F27B-4557-8F2D-C68E8B2D8AA8', '-', '')), 'Bootstrap');

-- Bootstrap Cards 1:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('8da0b37e-0f50-4237-b8e4-47c7ab717a54', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is 12?', '1', 'The number of columns in the Bootstrap Grid System');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('685a86b2-d2a8-4110-b4cf-514ee0df6a6f', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is .container or .container-fluid?', '1', 'The number of columns in the Bootstrap Grid System');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('5e42ef55-dfb4-4745-aae5-cbd08a1b4509', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')),'What is jQuery and Popper.js?', '1', 'Bootstrap requires these two JavaScript dependencies in order for the all built-in JavaScript components to function properly');
-- Bootstrap Cards 2:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('6b5f8d58-a4e0-4cac-b44f-c3a8a842ff65', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')),'What is 768 - 991px?', '2', 'This is the range of screen widths for the MD breakpoint');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('2ec0ae72-61fc-45f3-bbec-87eddab2692a', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')),'What is .container-fluid?', '2', 'Use this Bootstrap class to create a container that will fill the entire width of the viewport');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('8784e938-7016-4b6c-86b6-95103939ae94', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is .img-fluid?', '2', 'This Bootstrap class will scale an image proportionally within its parent element');
-- Bootstrap Cards 4:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('d3d971c8-be30-4c7a-a3a9-d4ba1a393eaa', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is <576 px?', '4', 'This is the width range of the XS breakpoint');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('3f63ab67-57b9-457d-a8ad-2ab4b5d4c2e0', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What are .btn and .btn-danger?', '4', 'place these two Bootstrap classes on a <button> tag to create a red button');
-- Bootstrap Cards 8:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('a43c1014-4766-4598-91fe-8b8b5eebc270', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is .col-lg-6?', '8', 'This is the Bootstrap grid class to use to make an element 6 columns wide on screens that are larger than 991px wide');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('4b646a7c-6363-4942-9925-0315c5def1b0', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is  box-sizing: border-box;?', '8', 'Bootstrap applies this CSS rule to all elements, which changes the default CSS Box Model');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('a84cf6fc-74ab-46f3-ae2c-c21401a43ef7', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is 16px?', '8', 'This is Bootstrap\'s global default font-size');
-- Bootstrap Cards 16:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('16d4cf1a-a3a3-4e3d-b9c2-62ffcb015fa0', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is 1140 px?', '16', 'This is the size of the fixed-width Bootstrap .container on screens 1200px wide and larger');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('6e42f90d-8281-4d8a-9ee7-95c7ae53fb64', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is .table?', '16', 'To enable basic Bootstrap table styling, add this class to the <table> tag');
-- Bootstrap Cards 32:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('268c8315-128b-4011-8a23-98d05cb9de25', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is .form-control?', '32', 'Use this Bootstrap class to automatically style <input> form fields');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('e1bfb1e2-f06c-4121-979d-f8b7228f1745', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is 768-991px?', '32', 'This is the range of screen widths for the MD breakpoint);');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('bdbdf44a-6d7e-4824-88d9-8c5f3c9ca592', '-', '')),UNHEX(REPLACE('ee37cc48-ab4b-4f91-9845-86efea8f4af4', '-', '')), 'What is .sr-only?', '32', 'You would apply this Bootstrap class on HTML tags that contain content for screen readers only');

-- CSS Category:
INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')), UNHEX(REPLACE('C2954660-F27B-4557-8F2D-C68E8B2D8AA8', '-', '')), 'CSS');

-- CSS Cards 1:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('9c394792-be8c-4dc3-83c5-3faf05bbbe89', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is margin?', '1', 'This is the outermost element in the CSS box model');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('bd327b70-ce40-4c14-a80a-491a1c539b72', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is Selector?', '1', 'This part of a CSS rule targets which elements in your HTML document documents the style will apply to');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('794e87c3-29ad-41b9-a080-14b4c63320d7', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is the Color attribute?', '1', 'This CSS property will alter the color of text');
-- CSS Cards 2:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('4e298473-adf0-4e22-955a-e300c06a109a', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is float: right;?', '2', 'This CSS rule will push an element as far as possible to the right inside its container, and allows other elements to wrap around it');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('4cd4a046-ab02-4c16-b8d9-fc6f2d13310d', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is inline CSS?', '2', 'These kinds of CSS rules are the most specific, and will override any and all other conflicting style rules');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('4f79e8fb-0a4a-4885-9715-c097dbdea325', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is CSS Specificity?', '2', 'This term refers to the rules that determine what CSS styles get applied based on how and where they are written');
-- CSS Cards 4:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('23beab9f-5a8a-4ebb-b775-25c5e445280e', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is the Alpha channel? (Opacity or Transparency also acceptable)', '4', 'The "a" in rgba and hsla color values stands for this');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('fb060eb7-8e62-4c42-ab04-4c3484985b97', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is :last-child?', '4', 'This CSS pseudo-class will target any element that is the last child of its parent');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('796dd201-f79e-4faf-928b-48ff33a69619', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What are media queries?', '4', 'Using these, we can limit certain styles based on the media type and device characteristics, such as screen width');
-- CSS Cards 8:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('d8f899cc-360c-4bfa-9aaa-c4fead7c42bb', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is display: inline-block;?', '8', 'Setting this CSS display value will enable an element to sit inline, while at the same time preserving the box model margins and padding like that of a block element');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('41e0229c-806c-4d76-ba32-2ef98e1ea62f', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is an Attribute Selector?', '8', 'This kind of CSS Selector allows you to target HTML elements with a specific attribute and/or value');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('eb9848bd-5020-467b-979c-25e55b9e126f', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is clear: both; (or clearfix hack)?', '8', 'This CSS rule will clear all space on the left and right sides of block elements');
-- CSS Cards 16:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('9be9d10b-08e7-4808-bc94-d09c44cdc534', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is position: static;?', '16', 'This is the default CSS position for all HTML elements');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('68546015-e8cd-446a-ad31-262271a493c6', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What are user-agent styles or user-agent stylesheets?', '16', 'This is the technical term for browser default styles');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('fcddadff-9ad5-4aa6-9c95-8bc4a0c6927f', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is box-sizing: border-box?', '16', 'This CSS rule changes the default box model by moving the border and padding to the inside of an element\'s box');
-- CSS Cards 32:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('69069085-202a-47d2-b6ae-e0e0e2f1ae9c', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is :nth-child(3)?', '32', 'This CSS pseudo-class will target any element that is the 3rd child of its parent');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('1152d15c-ec4d-4e73-b137-fce9fcdb1080', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What is z-index?', '32', 'This CSS property specifies the stack order of elements that are positioned absolute, relative, or fixed');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('72dbce57-9cf1-4005-bf2a-1350a05015f7', '-', '')),UNHEX(REPLACE('d0e530dd-54e0-46b7-9918-1ead8876fa9c', '-', '')),'What are inline elements?', '32', 'On these kinds of HTML elements, vertical margins, padding and borders will NOT push away other elements above or below');

-- UX Category:
INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')), UNHEX(REPLACE('C2954660-F27B-4557-8F2D-C68E8B2D8AA8', '-', '')), 'UX');
-- UX Class 1:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('19063b93-c2bb-4752-b563-e8ed399cad4f', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is UX or User Experience?', '1', 'This term/acronym refers to all aspects of an end-user\'s interaction with a product, system, or service');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('6afb205d-2b7d-489b-9430-2fc5796fd587', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is a persona?', '1', 'This term refers to a hypothetical model of a user of your product');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('55869cff-e632-4255-843d-526a5bfe300e', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is a Use Case?', '1', 'This term refers to a model of how, when, where a user will interact with your product');
-- UX Class 2:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('a5588577-0223-41e5-90df-632d655ac670', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is a UI or User Interface?', '2', 'This term or acronym refers to the graphical elements of your site or app that a user sees and interacts with on the screen');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('6fd4ff28-6625-43ef-bf10-9e603c4b0442', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is Ease of Use or Usability?', '2', 'This term refers to the ease with which a user can employ a tool, product or service to achieve a specific goal');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('9c2d1390-7e5b-47ab-88b0-c6986c7938b9', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is MVP or Minimum Viable Product?', '2', 'This term or acronym refers to a product development strategy where a new product is developed with only sufficient features necessary to satisfy early adopters');
-- UX Class 4:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('10c0259c-2b90-4a05-8b02-0fc6daca3304', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is Responsive Web Design/Development? (NOTE: Mobile First is NOT Acceptable answer?', '4', 'This term refers to the design and development of websites that scale according to screen size of the device they are accessed with');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('e149d3ca-2a9e-4a5d-9447-b3c0751d8840', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is target market, existing users, or early adopters?(other acceptable answers: Market Research Data, Analytics Data?', '4', 'An ideal persona should be created based upon this');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('a55d18ba-b8c6-4e9b-b4c5-4f5325cb70b4', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'Who is EVERYONE on the team?', '4', 'hese are the individuals on a web development team that are responsible for the UX of a website or application');




-- UX Cards 8:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('c3b6bbd1-7650-434f-90e0-623ac1814fc2', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is Mobile-First Web Development?', '8', 'This term refers to a web development approach where the bare essentials of a website are loaded for smaller platforms first, before adding content, features and functionality for larger devices on an as-needed secondary basis');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('a5637b23-cbec-4b60-8613-69d25f403870', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is Wireframing?', '8', 'This term refers to the process where one begins to plan out the organization and layout of the UI elements in black and white, prior to the graphic design of the website or application');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('bd08aef3-e265-4e50-83b9-5760de10b6bf', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is Sitemapping?', '8', 'This process involves creating a graphical outline that details the grouping and hierarchical structure of the pages of a website or app');
-- UX Class 16:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('97c4b11b-cb72-4195-a9e4-cca66706d3a0', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is Progressive Enhancement?', '16', 'This term refers to the addition of content, features and functionality to a website as it scales up for larger platforms');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('219d4bfa-7484-4486-bf23-3f4f741f4d12', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is Graceful Degradation?', '16', 'This term refers to the addition of content, features and functionality to a website as it scales down for small platforms');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('4144461d-c169-43b6-9175-25c4dc11352f', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is IxD, or Interaction Design?', '16', ' subset of UX design, this term or acronym refers specifically to designing human-computer interactions');
-- UX Cards 32:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('bae855b7-7e4f-42de-89f6-abdffaea78f6', '-', '')),'What is A/B testing?', '32', 'This term refers to the process of testing two different versions of the same website or app, and gathering user interaction data to determine which one performs best');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('2d132161-c40b-4811-ba59-e8f67495253f', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is a Wireframe?', '32', 'This term refers to a visual representation of a user interface that is used to define the hierarchy of content on a screen');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('63af30c7-0929-458f-a088-5bff03f8690c', '-', '')),UNHEX(REPLACE('a73145d8-4253-451e-a3b8-ee963cc2ae89', '-', '')),'What is MVP or Minimum Viable Product?', '32', 'This term refers to the process of testing two different versions of the same website or app, and gathering user interaction data to determine which one performs best');


-- HTML Category:
INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')), UNHEX(REPLACE('C2954660-F27B-4557-8F2D-C68E8B2D8AA8', '-', '')), 'HTML');
-- HTML Cards 1:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('b02f8a4a-9d81-4c53-8a28-21d26b071e2c', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is Hypertext Markup Language?', '1', 'This is what the acronym HTML stands for');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('c7f28e0b-eb09-49ff-af39-251a540969c2', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What are ids?', '1', 'These types of HTML attributes are used to uniquely identify an element and their values can only occur once per page');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('4fd04296-234c-4e06-b95a-a5dd78b5c485', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is a <div>?', '1', 'This HTML tag is a generic block container element');
-- HTML Cards 2:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('a6538f32-bf7d-46dd-bb98-ab16c0450ea8', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is a <span> tag?', '2', 'This HTML tag is a generic inline container element');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('97b77690-8df3-4c86-8a76-f9bf27370365', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the <nav> tag?', '2', 'This HTML tag is used to house links that function as page navigation');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('e5f6b02c-673b-43fb-ac94-47d8acedab98', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is Doctype Declaration, or <!DOCTYPE html>?', '2', 'laced at the top of every HTML document, this line of code tells the browser what version of HTML the document is written in');
-- HTML Cards 4:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('e6faa36e-d6b2-4539-8454-21ed5ea8dd64', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'Who is Tim Berners-Lee?', '4', 'The inventor of HTML');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('f827c940-a54c-4637-9dd5-5796fee4a132', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the <title> tag?', '4', 'Text inside this HTML tag will appear inside a browser tab right next to the favicon');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('d80d9f35-de02-46f2-ad1d-12c88dc02e62', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the <textarea> tag?', '4', 'Used in forms, this HTML tag creates a multiline text input area');
-- HTML Cards 8:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('cc34f8f8-8024-4b3f-a696-72bbd2236499', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the alt attribute?', '8', 'This attribute is required on all image tags, and provides alternate text for screen readers');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('0477abb6-454d-4ec5-9280-5d12dad80faa', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is &amp;?', '8', 'This is the HTML entity code for the "&" symbol');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('c562643c-967e-47e7-9ae6-cd8f60d13e51', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the <pre> tag?', '8', 'This HTML tag preserves all spaces and line breaks in text content exactly as they are typed');
-- HTML CARDS 16:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('8856ed52-3ccf-4591-bff3-fdf74fbdbe8b', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the rel attribute?', '16', 'This attribute, which is required when linking to CSS stylesheets, specifies the relationship between the current document and the linked resource');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('3dbb1324-87c0-40e9-9dd3-1e09bed10ae2', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the DOM or Document Object Model?', '16', 'This model maps the hierarchy of the elements on a web page and provides a programming interface for HTML');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('2f41f7f4-3489-4849-a851-1540ddbc1340', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the <meta name="viewport".../> tag?', '16', 'This specific HTML tag tells the browser to set the width of the viewport to the width of the device');
-- HTML Cards 32:
INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('ef7acd35-6d1c-4704-aae8-229037b35545', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What are custom data attributes?', '32', 'These kinds of HTML attributes are used to store custom data private to the page or application');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('f32e0011-d372-4661-a680-b656c050af2f', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the <canvas> tag??', '32', 'Use this HTML tag as a container for drawing graphics using JavaScript');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('69e94d29-999c-435b-a984-23336612b316', '-', '')),UNHEX(REPLACE('f1ec3a33-e758-481e-8139-506ae284f5d3', '-', '')),'What is the <marquee> tag?', '32', 'This obsolete HTML tag was used in the 90s to create a scrolling line of text');