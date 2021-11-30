<!doctype html>
<html>
<head>
  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Dint</title>
<style>
  html{
    font-size: 62.5%;;
  }

  body {
    margin: 0;
    padding: 0;
    font-size: 1.6rem;
    font-weight: 300;
    line-height: 1.667;
    background: #ffffff;
  }

  .shadow {
    box-shadow: 0 0 10px rgba(188,190,202,0.32);
  }

  img {
    display: block;
    border: 0;
    width:100%;
    height:auto;
  }
  /***************
  POSITIONING
  ***************/  
  .center {
    margin: 0 auto;
  }
  .vat {
    vertical-align: top;
  }
  .vam {
    vertical-align: middle;
  }
  .vab {
    vertical-align: bottom;
  }
</style>

<style>
  p {
    color: #777777;
    font-family: 'proxima_nova_rgregular', Proxima Nova, Helvetica, Arial, sans-serif;
  }
  .frame {
    background: #fafafa;
  }  

  .justify-content-center{
    justify-content:center;
  }
  .wrapper {
    width: 100%;
    max-width:600px;
    margin:0 auto;
    text-align:center; 
  }

  .box {
    background: #ffffff;
    box-shadow: 0 15px 35px rgba(50,50,93,.1), 0 5px 15px rgba(0,0,0,.07);
  }
  @media screen and (max-width: 600px) {
    .img-max {
      max-width: 100% !important;
      width: 100% !important;
      height: auto !important;
    }
  }
  @media screen and (min-width: 600px) {
    .des-pt50 {
      padding-top: 50px !important;
    }
    .des-pb50 {
      padding-bottom: 50px !important;
    }
  }
  /* Typhography*/
  .text-16{
    font-size: 1.6rem;
  }

  .text-18{
    font-size: 1.8rem;
  }
  .font-weight-700{
    font-weight: 700;
  }

  .p-1{
    padding:15px;
  }

  .p-3{
    padding:30px;
  }

  .ml-2{
    margin-left:25px;
  }
  .mr-2{
    margin-right:25px;
  }

  .mt-20{
    margin-top: 20px;
  }

  /* background-color*/
  .green{
    background:#1DBF73;
  }

  .w{
    width: 100%;
  }

  .d-flex{
    display: flex;
  }
  .img-fluid{
    width: 100%;
    height: auto;
  }

  .text-left{
    text-align: left;
  }

  .text-right{
    text-align: right;
  }
  .text-center{
    text-align: center;
  }

  .text-justify{
    text-align: justify;
  }

  
button {
  position: relative;
  display: inline-block;
  cursor: pointer;
  outline: none;
  border: solid 1px #d8d8d8;
  vertical-align: middle;
  text-decoration: none;
  font-size: inherit;
  font-family: inherit;
  text-align: center;
}
button.learn-more {
  color: #fff;
  padding:10px 7px;
  background: #1dbf73;
  text-transform: uppercase;
}
</style>
</head>
<body>
  <div class="frame">
		<div class="mt-20" style="display: table; margin-right: auto; margin-left: auto; width: 100%;">
			<div class="wrapper box" style="border: solid 1px #d8d8d8; padding: 15px; width: 100%;">
				<div class="d-flex">
            <div>
            <img src="{{URL::asset('front/images/logos/logo.png')}}" class="img-fluid" alt="logo">
          </div>
        </div>

        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
          <tbody>
            <tr>
              <td align="center">
                <table border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td>
                          <p>#message_body#</p>
                          <p class="mt-20 text-center">
                            <a href="#link#" target="_blank">
                              <button type="button" class="learn-more">#lang#</button>
                            </a>
                          </p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="foot">   
        </div>
      </div>
    </div>
  </div>
</body>
</html>

