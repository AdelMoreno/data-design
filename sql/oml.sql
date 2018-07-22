/**
INSERT statements

/sql/oml.sql is where this file should be created for Data-Design
**/

INSERT INTO profile(profileId, profileHash, profileEmail)
VALUES(UNHEX("edd359bbb89315f721bc9797233293da"), "7f4b42d3dca8d419a7c6d10dd893fa43460000f10a2b6f0e38b96314a3f21e979c207c6279f640170c399334f546a6",
"amoreno28@cnm.edu"
);

UPDATE profile SET profileActivationToken="2a8bc4e5984dc59c3b1171bb2ec0e20c" WHERE profileId=(UNHEX("edd359bbb89315f721bc9797233293da"));

DELETE FROM profile WHERE profileId = UNHEX("edd359bbb89315f721bc9797233293da");

SELECT profileEmail FROM profile WHERE profileEmail="amoreo28@cnm.edu";