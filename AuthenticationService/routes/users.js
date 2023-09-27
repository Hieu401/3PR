var express = require('express');
const services = require('../services/services')

var router = express.Router();

router.post('/signup', function(req, res, next) {
  services.signup(req.body["username"], req.body["password"])
    .then((result) => res.status(result.code).json(result.json))
});

router.post('/login', function(req, res, next) {
  services.login(req.body["username"], req.body["password"])
    .then((result) => {
      if (result.token) {
        res.cookie("sessionToken", result.token, {httpOnly: true, maxAge: 1000*60*180})
      } 
      return res.status(result.code).json(result.json)
    })
});

module.exports = router;
