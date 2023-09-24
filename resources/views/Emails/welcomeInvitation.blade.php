<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
  <meta charset="utf-8">
  <meta name="x-apple-disable-message-reformatting">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings xmlns:o="urn:schemas-microsoft-com:office:office">
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <style>
    td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
  </style>
  <![endif]-->
  <style>
    @media (max-width: 600px) {
      .sm-w-full {
        width: 100% !important
      }
      .sm-px-0 {
        padding-left: 0 !important;
        padding-right: 0 !important
      }
      .sm-px-2 {
        padding-left: 8px !important;
        padding-right: 8px !important
      }
      .sm-text-sm {
        font-size: 14px !important
      }
    }
  </style>
</head>
<body style="margin: 0; width: 100%; padding: 0; -webkit-font-smoothing: antialiased; word-break: break-word">
  <div role="article" aria-roledescription="email" aria-label lang="en">
    <div class="sm-px-2" style="height: 100vh; border-radius: 8px; padding-top: 24px; padding-bottom: 24px; font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif; background-color: #f2f2f2">
      <table align="center" cellpadding="0" cellspacing="0" role="none">
        <tr>
          <td style="width: 600px; max-width: 100%">
            <table style="width: 100%;" cellpadding="0" cellspacing="0" role="none">
              <tr>
                <td class="sm-px-0" style="width: 100%; padding-left: 16px; padding-right: 16px; text-align: left">
                  <table style="width: 100%;" cellpadding="0" cellspacing="0" role="none">
                    <tr>
                      <td>
                        <table style="width: 100%; border-radius: 12px; background-color: #fff; padding-left: 32px; padding-right: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)" cellpadding="0" cellspacing="0" role="none">
                          <tr>
                            <td style="padding-top: 12px; padding-bottom: 12px; text-align: center; color: #000">
                              <p style="margin: 0 0 12px; font-size: 30px; font-weight: 600; line-height: 24px">Welcome to Sheltez</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="sm-text-sm" style="margin: 32px 0 0; color: #334155">
                                Dear
                                <span style="font-size: 18px; font-weight: 600">{{$userName}}</span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <table class="sm-w-full" align="center" style="width: 400px; border-radius: 8px" cellpadding="0" cellspacing="0" role="none">
                                <tr>
                                  <td>
                                    <img src="https://img.freepik.com/free-vector/group-photo-concept-illustration_114360-9798.jpg?w=740&t=st=1695584959~exp=1695585559~hmac=282dddc4db0ea168c24109c5f1ace8d13166d1d3e54e469adc5eb62420feac14" alt style="max-width: 100%; vertical-align: middle; line-height: 1; border: 0; height: 224px; width: 224px; padding: 8px">
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="margin: 0;">
                              <p class="sm-text-sm" style="margin: 8px 0 0; color: #334155">
                                Welcome to <span style="font-size: 18px; font-weight: 600;">Sheltez!</span> We are delighted to have you on board. As you embark on this journey with us, we want to provide you with the essential information to get started.
                              </p>
                              <p class="sm-text-sm" style="margin: 8px 0 0; font-weight: 600; color: #334155">
                                Your login credentials are as follows:
                              </p>
                              <p class="sm-text-sm" style="margin: 8px 0 0; color: #334155">
                                Username : <span style="font-size: 18px; font-weight: 600;">{{$userEmail}}</span>
                              </p>
                              <p class="sm-text-sm" style="margin: 8px 0 0; color: #334155">
                                Password : <span style="font-size: 18px; font-weight: 600;"></span>{{$password}}
                              </p>
                              <p class="sm-text-sm" style="margin: 8px 0; color: #334155">
                                Click on the <a href="{{$currentDomain}}">Login</a> button.
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>
