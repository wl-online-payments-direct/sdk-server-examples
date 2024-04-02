const env = process.env.NODEJS_SDK_ENV || 'local';
const config = require(`./config.${env}.json`);

module.exports = config;