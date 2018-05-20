<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>EpicAim.net</title>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body, td { 
            font-family: 'Helvetica Neue', Arial, Helvetica, Geneva, sans-serif; 
            font-size:14px; 
            color: white;
        }
        
        body { 
            background-color: #181818; 
            margin: 0; 
            padding: 0; 
            -webkit-text-size-adjust:none; 
            -ms-text-size-adjust:none; 
        }

        h2{ 
            padding-top:12px; 
            color:#ba2323; 
            font-size:22px; 
        }
    </style>
</head>
<body style="margin:0px; padding:0px; -webkit-text-size-adjust:none;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#181818;" >
        <tbody>
            <tr>
                <td align="center" bgcolor="#181818">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>                            
                            <tr><td class="w640" width="640" height="10"></td></tr>
                            <tr><td class="w640" width="640" height="10"></td></tr>
                            <tr>
                                <td class="w640" width="640">
                                    <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" style="background: rgba(0, 0, 0, 0.5);">
                                        <tbody>
                                            <tr>
                                                <td class="w20" width="20"></td>
                                                <td  class="w580"  width="580" valign="middle" align="left">
                                                    <div>
                                                        <img class="w580" style="text-decoration: none; display: block; color: white; font-size: 48px;font-family: 'Dosis' !important;font-weight: 600;" alt="EpicAim" src="https://i.imgur.com/L6AWgNh.png"/>
                                                    </div>
                                                </td> 
                                                <td class="w30"  width="30"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="w640" class="w640"  width="640" bgcolor="#181818">
                                    <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" style="border-left: 1px solid #ba2323; border-right: 1px solid #ba2323;">
                                        <tbody>
                                            <tr>
                                                <td  class="w30"  width="30"></td>
                                                <td  class="w580"  width="580">
                                                    <table class="w580"  width="580" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>                                                            
                                                            <tr>
                                                                <td class="w580"  width="580">
                                                                    <h2 style="color:#ba2323; font-size:22px; padding-top:12px;"><?= $translate->element("confirm_account", "title"); ?></h2>

                                                                    <div align="left" class="article-content" style="color: white;">
                                                                        <p> <?= str_replace("%username%", $username, $translate->element("commons", "heading")); ?> </p>
                                                                        <p>
                                                                            <?= $translate->element("confirm_account", "line_1"); ?>
                                                                        </p>
                                                                        <p>
                                                                            <a style="color: grey;" href="<?= $url;?>"><?= $translate->element("confirm_account", "line_2"); ?></a>
                                                                        </p>
                                                                        <p>
                                                                            <?= $translate->element("confirm_account", "line_3"); ?>
                                                                        </p>
                                                                        <p>
                                                                            <?= $url;?>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w580"  width="580" height="1" bgcolor="#ba2323"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="w580"  width="580" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="w180"  width="180" valign="top" style="color: white;">
                                                                    <div align="left">
                                                                        <p><?= $translate->element("commons", "ending"); ?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="w30" class="w30"  width="30"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="w640" width="640">
                                    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ba2323">
                                        <tbody>
                                            <tr>
                                                <td colspan="5" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td class="w30" width="30"></td>
                                                <td class="w580" width="580" valign="top">
                                                    <p align="left">
                                                        <a style="color:#ba2323;" href="https://epicaim.net"><span style="color:white;">© Copyright 2018 EpicAim.net</span></a>
                                                    </p>
                                                </td>
                                                <td class="w30" width="30"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" height="10"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="w640" width="640" height="60"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>