require('./bootstrap');

require('alpinejs');

async function ajaxService(url, params, method) {
  return $.ajax( {
    url: url,
    type: method,
    dataType: 'json',
    data: params
  });
}