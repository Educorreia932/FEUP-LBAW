-- Edit user information
UPDATE member
SET username = $username, email = $email, password = $password, name = $name, bio = $bio
WHERE id = $id;