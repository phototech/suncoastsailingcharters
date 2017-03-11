const request = require('request-promise');
const Critical = require('critical');
const CleanCSS = require('clean-css');

const headers = {
  'Host': 'sailvenice.com',
  'X-Forwarded-Proto': 'https',
}

const home = {
    uri: 'http://127.0.0.1:8080',
    headers: headers,
};

const services = {
    uri: 'http://127.0.0.1:8080/services',
    headers: headers,
};

Promise.all([request(home), request(services)]).then(responses => {
  const css = responses.map((response) => {
    return Critical.generate({
      inline: false,
      src: '/',
      base: 'web/',
      html: response,
      timeout: 120000,
      ignore: ['@font-face'],
    });
  });

  return Promise.all(css);
}).then((css) => {
  const clean = new CleanCSS({
    returnPromise: true
  });

  return clean.minify(css.join(' '))
})
.then((output) => {
  console.log(output.styles);
});
