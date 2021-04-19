-- User profile information
SELECT id, username, email, name, bio, joined, credit, rating
    FROM member
    WHERE $username = username;