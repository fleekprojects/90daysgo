<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
   </head>
   <body>
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="80%">
         <tr>
            <td align="center" bgcolor="#000000" style="padding: 18px 0 18px 0;">
               <p style="color:#ffffff"><?= $heading ?> </p>
            </td>
         </tr>
         <tr>
            <td>
               <table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size:14px;text-align:left;">
                  <tbody>
                     <tr style="padding-top:15px;padding-bottom:15px;border-top:solid 1px #ccc;border-bottom:solid 1px #ccc;">
                        <td style="padding:10px;font-family:sans-serif;font-size:15px;line-height:20px;color:#555555;">
                           <h1 style="margin:0 0 10px 0;font-family:sans-serif;font-size:25px;line-height:30px;color:#333333;font-weight:normal;">Trade In <b> <?= strtoupper($order->order_code) ?></b></h1>
                           <br>                           
                           <h1 style="margin:0 0 10px 0;font-family:sans-serif;font-size:25px;line-height:30px;color:#333333;font-weight:normal;">We received your device, but found an issue.</h1>
                           <hr>
                           <p style="margin:0;font-size:16px;line-height:24px;color:#2EB835;"><b><?= $heading ?></b></p>
                           <br><br>                           
                           <p style="margin:0;font-size:16px;line-height:24px;"><?= $firstp ?>                              <br>
						   <?= $Opt; ?>     </p>                      <br>                        
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>