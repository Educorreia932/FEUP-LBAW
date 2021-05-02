-- Register new user
INSERT INTO member (username, email, password, name, bio, joined, profile_picture, data_consent)
VALUES ($username, $email, $password, $name, $bio, $joined, $profile_picture, $data_consent);