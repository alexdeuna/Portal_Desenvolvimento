<?php
$arr = array
  (
  array("OI" => array("LinuxBox" => array("LinuxBox1" => array("usuario","senha1","senha2","senha3","desc"),"IP","porta","SO",))),
  array("OI" => array("LinuxBox" => array("LinuxBox1" => array("usuario","senha1","senha2","senha3","desc"),"IP","porta","SO",))),
  );
$a=json_encode($arr);
printf(json_encode($arr));

?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <ol> 
            <li>OI</li>
            <ul>
                <li>INTEGRA</li>
            </ul>
            <ul>
                <li>LINUXBOX</li><ol>
                    <li>Linuxbox01 10.121.247.125 </li>
                </ol>
                <ol>
                    <li>Linuxbox02 10.121.247.65 </li>
                </ol>
                <ol>
                    <li>Linuxbox1
                        10.121.240.135 </li>
                    <li>10.121.240.135 - Linux - root - 0 - 0 - 0 -  </li>
                </ol>
                <ol>
                    <li>Linuxbox2 10.121.240.178 </li>
                    <li>10.121.240.178 - Linux - root - 0 - 0 - 0 -  </li>
                </ol>
                <ol>
                    <li>Linuxbox3 10.221.44.73 </li>
                    <li>10.221.44.73 - Linux - root - 0 - 0 - 0   </li>
                    <li>10.221.44.73 - Linux - vozadm - 0 - 0 - 0 -  </li>
                </ol>
                <ol>
                    <li>Linuxbox4 10.121.229.70 </li>
                    <li>10.121.229.70 - Linux - root - 0 - 0 - 0 -  </li>
                </ol>
                <ol>
                    <li>Linuxbox5 192.9.200.168 </li>
                </ol>
                <ol>
                    <li>Linuxbox6 192.9.200.12 </li>
                </ol>
            </ul>
            <ul>
                <li>SCRIPTSERVER</li>
            </ul>
            <ul>
                <li >GATEWAY-OSS</li>
            </ul>
            <ul>
                <li>SCINO</li>
            </ul>
        </ol>
        <ol> 
            <li>Ericsson</li>
            <ul>
                <li>PEM-R2</li>
            </ul>
            <ul>
                <li>SoEM</li>
            </ul>
            <ul>
                <li>OSS RC</li>
            </ul>
            <ul>
                <li>OSS-RC 4.1</li>
            </ul>
            <ul>
                <li>OSS-RC RED GEO</li>
            </ul>
            <ul>
                <li>EMA</li>
            </ul>
        </ol>

    </body>
</html>
