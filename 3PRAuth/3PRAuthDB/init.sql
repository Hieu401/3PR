
CREATE TABLE users (
	"uuid" 			UUID DEFAULT gen_random_uuid() PRIMARY KEY,
	"username" 		VARCHAR(255) UNIQUE,
	"password" 		VARCHAR(255)
)