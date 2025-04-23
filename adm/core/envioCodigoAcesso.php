<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendEmailAsync(string $emailDestino, string $texto, string $senha_gerada): void {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'suporteti@castelobranco.br';
        $mail->Password = '@J1e2a3n4';
        $mail->setFrom('suporteti@castelobranco.br', 'Acesso Sistema Protocolos - UCB');
        $mail->addReplyTo('suporteti@castelobranco.br', 'UCB');
        $mail->addAddress($emailDestino);
        $mail->Subject = 'Email Automático do Sistema Protocolos - UCB';
        $mail->isHTML(true);
        $mail->CharSet = 'utf-8';
        
        $mail->Body = "
        <html >

<head>

    <title></title>
    <!--[if !mso]><!-->

    <!--<![endif]-->
    <style type='text/css'>
        body {
            margin: 0;
            padding: 0;
        }

        table,
        td,
        tr {
            vertical-align: top;
            border-collapse: collapse;
        }

        * {
            line-height: inherit;
        }

        a[x-apple-data-detectors=true] {
            color: inherit !important;
            text-decoration: none !important;
        }
    </style>
    <style id='media-query' type='text/css'>
        @media (max-width: 785px) {

            .block-grid,
            .col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }

            .block-grid {
                width: 100% !important;
            }

            .col {
                width: 100% !important;
            }

            .col>div {
                margin: 0 auto;
            }

            img.fullwidth,
            img.fullwidthOnMobile {
                max-width: 100% !important;
            }

            .no-stack .col {
                min-width: 0 !important;
                display: table-cell !important;
            }

            .no-stack.two-up .col {
                width: 50% !important;
            }

            .no-stack .col.num4 {
                width: 33% !important;
            }

            .no-stack .col.num8 {
                width: 66% !important;
            }

            .no-stack .col.num4 {
                width: 33% !important;
            }

            .no-stack .col.num3 {
                width: 25% !important;
            }

            .no-stack .col.num6 {
                width: 50% !important;
            }

            .no-stack .col.num9 {
                width: 75% !important;
            }

            .video-block {
                max-width: none !important;
            }

            .mobile_hide {
                min-height: 0px;
                max-height: 0px;
                max-width: 0px;
                display: none;
                overflow: hidden;
                font-size: 0px;
            }

            .desktop_hide {
                display: block !important;
                max-height: none !important;
            }
        }
    </style>
</head>

<body class='clean-body' style='margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #F5F5F5;'>
    <!--[if IE]><div class='ie-browser'><![endif]-->
    <table bgcolor='#F5F5F5' cellpadding='0' cellspacing='0' class='nl-container' role='presentation' style='table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; width: 100%;' valign='top' width='100%'>
        <tbody>
            <tr style='vertical-align: top;' valign='top'>
                <td style='word-break: break-word; vertical-align: top;' valign='top'>
                    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td align='center' style='background-color:#F5F5F5'><![endif]-->
                    <div style='background-color:transparent;'>
                        <div class='block-grid' style='Margin: 0 auto; min-width: 320px; max-width: 765px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;'>
                            <div style='border-collapse: collapse;display: table;width: 100%;background-color:transparent;'>
                                <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:765px'><tr class='layout-full-width' style='background-color:transparent'><![endif]-->
                                <!--[if (mso)|(IE)]><td align='center' width='765' style='background-color:transparent;width:765px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
                                <div class='col num12' style='min-width: 320px; max-width: 765px; display: table-cell; vertical-align: top; width: 765px;'>
                                    <div style='width:100% !important;'>
                                        <!--[if (!mso)&(!IE)]><!-->
                                        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
                                            <!--<![endif]-->
                                            <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
                                                <tbody>
                                                    <tr style='vertical-align: top;' valign='top'>
                                                        <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;' valign='top'>
                                                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' height='10' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 10px;' valign='top' width='100%'>
                                                                <tbody>
                                                                    <tr style='vertical-align: top;' valign='top'>
                                                                        <td height='10' style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--[if (!mso)&(!IE)]><!-->
                                        </div>
                                        <!--<![endif]-->
                                    </div>
                                </div>
                                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                            </div>
                        </div>
                    </div>
                    <div style='background-color:transparent;'>
                        <div class='block-grid' style='Margin: 0 auto; min-width: 320px; max-width: 765px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;'>
                            <div style='border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;'>
                                <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:765px'><tr class='layout-full-width' style='background-color:#FFFFFF'><![endif]-->
                                <!--[if (mso)|(IE)]><td align='center' width='765' style='background-color:#FFFFFF;width:765px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:5px;'><![endif]-->
                                <div class='col num12' style='min-width: 320px; max-width: 765px; display: table-cell; vertical-align: top; width: 765px;'>
                                    <div style='width:100% !important;'>
                                        <!--[if (!mso)&(!IE)]><!-->
                                        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
                                            <!--<![endif]-->
                                            <div align='center' class='img-container center autowidth fullwidth' style='padding-right: 0px;padding-left: 0px;'>
                                                <a href='https://aplicacao.castelobranco.br/lgpdHML/dist/img/'><img align='center' alt='logo_ucb' border='0' src='https://aplicacao.castelobranco.br/lgpdHML/dist/img/logo_ucb.png' width='30%' height='30%' /></a>

                                            </div>
                                            <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif'><![endif]-->
                                            <div style='color:#052d3d;font-family:' Lato', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;'>
                                                <div style='line-height: 14px; font-size: 12px; font-family: ' Lato', Tahoma, Verdana, Segoe, sans-serif; color: #052d3d;'>
                                                    <p style='line-height: 26px; text-align: center; font-size: 12px; margin: 0;'><span style='font-size: 22px;'><strong><span style='line-height: 26px; font-size: 22px;'>AVISO! SISTEMA PROTOCOLOS</span></strong></span></p>
                                                </div>
                                            </div>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                            <!--[if (!mso)&(!IE)]><!-->
                                        </div>
                                        <!--<![endif]-->
                                    </div>
                                </div>
                                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                            </div>
                        </div>
                    </div>
                    <div style='background-color:transparent;'>
                        <div class='block-grid' style='Margin: 0 auto; min-width: 320px; max-width: 765px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;'>
                            <div style='border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;'>
                                <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:765px'><tr class='layout-full-width' style='background-color:#FFFFFF'><![endif]-->
                                <!--[if (mso)|(IE)]><td align='center' width='765' style='background-color:#FFFFFF;width:765px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
                                <div class='col num12' style='min-width: 320px; max-width: 765px; display: table-cell; vertical-align: top; width: 765px;'>
                                    <div style='width:100% !important;'>
                                        <!--[if (!mso)&(!IE)]><!-->
                                        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
                                            <!--<![endif]-->
                                            <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif'><![endif]-->
                                            <div style='color:#555555;font-family:' Lato', Tahoma, Verdana, Segoe, sans-serif;line-height:180%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;'>
                                                <div style='font-family: ' Lato', Tahoma, Verdana, Segoe, sans-serif; font-size: 12px; line-height: 21px; color: #555555;'>
                                                    <p style='font-size: 12px; line-height: 50px; text-align: center; margin: 0;'><span style='color: #000000; font-size: 25px;'><span style='line-height: 50px; font-size: 25px;'>$texto <font color='red'></font></span></span></p>
                                                    <p style='font-size: 12px; line-height: 50px; text-align: center; margin: 0;'><span style='color: #000000; font-size: 20px;'><span style='line-height: 50px; font-size: 20px;'>Nova Senha:  $senha_gerada</span></span></p>


                                                </div>
                                            </div>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                            <!--[if (!mso)&(!IE)]><!-->
                                        </div>
                                        <!--<![endif]-->
                                    </div>
                                </div>
                                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                            </div>
                        </div>
                    </div>
                    <div style='background-color:transparent;'>
                        <div class='block-grid' style='Margin: 0 auto; min-width: 320px; max-width: 765px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;'>
                            <div style='border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;'>
                                <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:765px'><tr class='layout-full-width' style='background-color:#FFFFFF'><![endif]-->
                                <!--[if (mso)|(IE)]><td align='center' width='765' style='background-color:#FFFFFF;width:765px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
                                <div class='col num12' style='min-width: 320px; max-width: 765px; display: table-cell; vertical-align: top; width: 765px;'>
                                    <div style='width:100% !important;'>
                                        <!--[if (!mso)&(!IE)]><!-->
                                        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
                                            <!--<![endif]-->



                                            <div style='background-color:transparent;'>
                                                <div class='block-grid' style='Margin: 0 auto; min-width: 320px; max-width: 765px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;'>
                                                    <div style='border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;'>
                                                        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:765px'><tr class='layout-full-width' style='background-color:#FFFFFF'><![endif]-->
                                                        <!--[if (mso)|(IE)]><td align='center' width='765' style='background-color:#FFFFFF;width:765px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:20px;'><![endif]-->
                                                        <div class='col num12' style='min-width: 320px; max-width: 765px; display: table-cell; vertical-align: top; width: 765px;'>
                                                            <div style='width:100% !important;'>
                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:20px; padding-right: 0px; padding-left: 0px;'>
                                                                    <!--<![endif]-->
                                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
                                                                        <tbody>
                                                                            <tr style='vertical-align: top;' valign='top'>
                                                                                <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;' valign='top'>
                                                                                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 1px solid #BBBBBB;' valign='top' width='100%'>
                                                                                        <tbody>
                                                                                            <tr style='vertical-align: top;' valign='top'>
                                                                                                <td style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
                                                                        <tbody>
                                                                            <tr style='vertical-align: top;' valign='top'>
                                                                                <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;' valign='top'>
                                                                                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' height='0' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;' valign='top' width='100%'>
                                                                                        <tbody>
                                                                                            <tr style='vertical-align: top;' valign='top'>
                                                                                                <td height='0' style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>



                                                                    <div style='background-color:transparent;'>
                                                                        <div class='block-grid' style='Margin: 0 auto; min-width: 320px; max-width: 765px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;'>
                                                                            <div style='border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;'>
                                                                                <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:765px'><tr class='layout-full-width' style='background-color:#FFFFFF'><![endif]-->
                                                                                <!--[if (mso)|(IE)]><td align='center' width='765' style='background-color:#FFFFFF;width:765px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:5px;'><![endif]-->
                                                                                <div class='col num12' style='min-width: 320px; max-width: 765px; display: table-cell; vertical-align: top; width: 765px;'>
                                                                                    <div style='width:100% !important;'>
                                                                                        <!--[if (!mso)&(!IE)]><!-->
                                                                                        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
                                                                                            <!--<![endif]-->
                                                                                            <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
                                                                                                <tbody>
                                                                                                    <tr style='vertical-align: top;' valign='top'>
                                                                                                        <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;' valign='top'>
                                                                                                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' height='0' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;' valign='top' width='100%'>
                                                                                                                <tbody>
                                                                                                                    <tr style='vertical-align: top;' valign='top'>
                                                                                                                        <td height='0' style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
                                                                                                                    </tr>
                                                                                                                   
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                                        </div>
                                                                                        <!--<![endif]-->
                                                                                    </div>
                                                                                </div>
                                                                                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                                                                                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                </td>
            </tr>
        </tbody>
    </table>
    <!--[if (IE)]></div><![endif]-->
</body>

</html>  ";
        
        // Simulação de envio assíncrono
        register_shutdown_function(function () use ($mail) {
            try {
                $mail->send();
              //  echo "Email enviado com sucesso para {$mail->getToAddresses()[0][0]}";
            } catch (Exception $e) {
                echo "Erro ao enviar email: " . $mail->ErrorInfo;
            }
        });
    } catch (Exception $e) {
        echo "Erro ao configurar o e-mail: " . $e->getMessage();
    }
}

// Exemplo de uso:
//$emailAluno = 'destinatario@example.com';
$senha_gerada = $keyAluno ;
$texto = "Prezado usuário, Segue sua senha de acesso ao sistema de protocolos.";
sendEmailAsync($emailAluno, $texto, $senha_gerada);
?>
