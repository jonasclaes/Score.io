# Usefull SQL statements for PHP

## User
### SELECT a user by username
```sql
SELECT * FROM users WHERE username = '$username';
```

### INSERT a user
```sql
INSERT INTO users (id, username, password) VALUES (NULL, '$username', '$password');
```

### UPDATE a user
```sql
UPDATE users SET username = '$username', password = '$password' WHERE id = '$id';
```

### DELETE a user
```sql
DELETE FROM users WHERE id = '$id';
```

## Score
### SELECT a score
```sql
SELECT * FROM scores;
```

### SELECT a score where id
```sql
SELECT * FROM scores WHERE id = '$id';
```

### INSERT a score
```sql
INSERT INTO scores (id, timestamp, name, description, score, maxScore) VALUES (NULL, '$timestamp', '$name', '$description', '$score', '$maxScore');
```

### UPDATE a score
```sql
UPDATE scores SET timestamp = '$timestamp', name = '$name', description = '$description', score = '$score', maxScore = '$maxScore' WHERE id = '$id';
```

### DELETE a score
```sql
DELETE FROM scores WHERE id = '$id';
```