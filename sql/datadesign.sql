ALTER DATABASE amoreno28 CHARACTER SET UTF8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS vote;
DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS phone;

CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileHash CHAR(97) NOT NULL,
	profileEmail VARCHAR(128) NOT NULL,
	UNIQUE(profileEmail),
	PRIMARY KEY(profileId)
);

CREATE TABLE phone (
	phoneId BINARY(16) NOT NULL,
	phoneBrand VARCHAR(64) NOT NULL,
	phoneModel VARCHAR(128) NOT NULL,
	phoneCamera VARCHAR(32),
	phoneScreen VARCHAR(64),
	phoneProcessor VARCHAR(64),
	phoneRam VARCHAR(8),
	phoneMemory VARCHAR(32),
	phoneBattery VARCHAR(32),
	UNIQUE(phoneModel),
	INDEX(phoneId),
	INDEX(phoneBrand),
	INDEX(phoneModel),
	PRIMARY KEY(phoneId)
);

CREATE TABLE vote (
	voteProfileId BINARY(16) NOT NULL,
	votePhoneId BINARY(16) NOT NULL,
	voteType VARCHAR(8) NOT NULL,
	INDEX(voteProfileId),
	INDEX(votePhoneId),
	FOREIGN KEY(voteProfileId) REFERENCES profile(profileId),
	FOREIGN KEY(votePhoneId) REFERENCES phone(phoneId),
	PRIMARY KEY(voteProfileId, votePhoneId)
);