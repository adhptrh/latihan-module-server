/*!
 * @websanova/vue-auth v4.1.4
 * https://websanova.com/docs/vue-auth
 * Released under the MIT License.
 */

'use strict';

var bearer = {
  request: function (req, token) {
    this.drivers.http.setHeaders.call(this, req, {
      Authorization: 'Bearer ' + token
    });
  },
  response: function (res) {
    var headers = this.drivers.http.getHeaders.call(this, res),
        token = headers.Authorization || headers.authorization;

    if (token) {
      token = token.split(/Bearer:?\s?/i);
      return token[token.length > 1 ? 1 : 0].trim();
    }
  }
};

module.exports = bearer;