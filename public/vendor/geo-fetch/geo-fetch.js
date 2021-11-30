var userIpAddrFinal = "";
var userIPInfo = "";

const userIpSettings = {
  "async": false,
  "crossDomain": true,
  "url": `https://www.cloudflare.com/cdn-cgi/trace`,
  "method": "GET"
};

const ipInfoSettings = {
  "async": false,
  "crossDomain": true,
  "url": `https://freegeoip.app/json/${userIpAddrFinal}`,
  "method": "GET"
};

$.ajax(userIpSettings, function (ipData) {

  const userIpAddr = String(ipData).match(/ip=.+/gm); // convert to str and return only "ip=xxx.xxx.xxx.xxx"
  const userIpAddr2 = userIpAddr[0].match(/[^ip=]/gm); //return xxx.xxx.xxx.xxx (array)
  userIpAddrFinal = String(userIpAddr2).replace(/\,/gm, ""); //convert array to str

});

$.ajax(ipInfoSettings).done(function (ipInfo) {
  userIPInfo = ipInfo;
});
