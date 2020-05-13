# SELECT a score
`SELECT * FROM scores;`

# SELECT a score where id
`SELECT * FROM scores WHERE id = '$id';`

# INSERT a score
`INSERT INTO scores (id, timestamp, name, description, score, maxScore) VALUES (NULL, '$timestamp', '$name', '$description', '$score', '$maxScore');`

# UPDATE a score
`UPDATE scores SET timestamp = '$timestamp', name = '$name', description = '$description', score = '$score', maxScore = '$maxScore' WHERE id = '$id';`

# DELETE a score
`DELETE FROM scores WHERE id = '$id';`