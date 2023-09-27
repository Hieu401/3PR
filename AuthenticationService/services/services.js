const pgp = require('pg-promise')();
const crypto = require('crypto');
const jwt = require('jsonwebtoken');

const db = pgp('postgres://3pr:1234@localhost:3000/authdb')

let hashpassword = async (pw) => crypto.createHash('sha256').update(pw).digest("hex")

async function signup(username, password) {

	let hashedpassword = await hashpassword(password)
      
	return db.query('INSERT INTO users (username, password) VALUES ($1, $2);', [username, hashedpassword])
		.then(
			(data) => {
				return {code: 200, json: "OK"}
			}
		)
		.catch(
			(error) => {
	  			if (error.code === "23505") {
					return {code: 400, json: {"message": "Name already exists"}}
	  			} else {
					return {code: 500, json: {"message": "Unknown error"}}
	  			}
			}
		)
}
async function createJTWtoken(userUid) {
	return jwt.sign(
		{userUid: userUid},
		"bananananana",
		{expiresIn: "3h"}
	)
}

async function login(username, password) {

	let hashedpassword = await hashpassword(password)

  	return db.oneOrNone('SELECT uuid, password FROM users WHERE username=($1);', username)
		.then(async (data) => {
			if (data === null) {
				return {code: 400, json: {message: "No user with given argument", username: username }}
			} else if (data["password"] === hashedpassword) {
				let token = await createJTWtoken(data.uuid)
				return {code: 200, json: "Succes", token: token}
			} else {
				return {code: 400, json: "Incorrect password"}
			}
		})
		.catch((error) => {
			return {code: 500, json: {"message": "Unknown error"}}
		})
}

module.exports = {signup, login};