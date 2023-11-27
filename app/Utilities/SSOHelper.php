<?php 

namespace App\Utilities;

class SSOHelper
{
    public static function checkIp(string $ip){
        if (!empty($ip) && ip2long($ip)!=-1) {
            $reserved_ips = array (
                array('0.0.0.0','2.255.255.255'),
                array('10.0.0.0','10.255.255.255'),
                array('127.0.0.0','127.255.255.255'),
                array('169.254.0.0','169.254.255.255'),
                array('172.16.0.0','172.31.255.255'),
                array('192.0.2.0','192.0.2.255'),
                array('192.168.0.0','192.168.255.255'),
                array('255.255.255.0','255.255.255.255')
            );
    
            foreach ($reserved_ips as $r) {
                $min = ip2long($r[0]);
                $max = ip2long($r[1]);
                if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
            }
            return true;
        }
        else return false;
    }

    public static function getClientIp(): string{
        if (self::checkIp(isset($_SERVER["HTTP_CLIENT_IP"])?? '')) {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
    
        foreach (explode(",",isset($_SERVER["HTTP_X_FORWARDED_FOR"])?? '') as $ip) {
            if (self::checkIp(trim($ip))) return $ip;
        }
    
        if (self::checkIp(isset($_SERVER["HTTP_X_FORWARDED"])?? ''))
            return $_SERVER["HTTP_X_FORWARDED"];
    
        elseif (self::checkIp(isset($_SERVER["HTTP_FORWARDED_FOR"])?? ''))
            return $_SERVER["HTTP_FORWARDED_FOR"];
    
        elseif (self::checkIp(isset($_SERVER["HTTP_FORWARDED"])?? ''))
            return $_SERVER["HTTP_FORWARDED"];
    
        elseif (self::checkIp(isset($_SERVER["HTTP_X_FORWARDED"])?? ''))
            return $_SERVER["HTTP_X_FORWARDED"];
    
        else
            return $_SERVER["REMOTE_ADDR"];
    }

    public static function getClientMacAddr(string $ip){
        $ip = self::checkIp($ip)? $ip : SSOHelper::getClientIp();

        $macCommandString   =   "arp " . $ip . " | awk 'BEGIN{ i=1; } { i++; if(i==3) print $3 }'";

        $mac = exec($macCommandString);

        return $mac;
    }

    public static function getHardwareId(){
        return trim(shell_exec('cat /etc/machine-id 2>/dev/null'));
    }

    public static function getServerInfo()
    {
        $route = "/bin/netstat -rn";
    
        exec($route, $aoutput);
        foreach($aoutput as $key => $line)
        {
            if($key > 1)
            {
                $line = preg_replace('/\s+/',",",$line);
                list($network, $gateway, $mask, $flags, $mss, $window, $irtt, $iface) = explode(",", $line);
                if((ip2long($_SERVER['SERVER_ADDR']) & ip2long($mask)) == ip2long($network))
                {
                    return array('network' => $network, 
                        'gateway' => $gateway,
                        'mask' => $mask,
                        'flags' => $flags,
                        'mss' => $mss,
                        'window' => $window,
                        'irtt' => $irtt,
                        'iface' => $iface,
                        'machineId' => self::getHardwareId()
                    );
                }
            }
        }
    }

    public static function getClientInfo(){
        $ipAddr= self::getClientIp();
        $macAddr= self::getClientMacAddr($ipAddr);
        $hostname = gethostbyaddr($ipAddr);
        
        return array(
            'ipAddress' => $ipAddr,
            'macAddress' => $macAddr,
            'hostname' => $hostname,
            'userAgent' => strtolower($_SERVER['HTTP_USER_AGENT'])
        );
    }

    public static function getServerTime(): int {
        return intval(ceil(time() / 21600));
    }

    public static function calcOtp(string $data, string $key, int $length): string {
        $hash       = hash_hmac('sha256', $data, $key);
        $hash       = preg_replace("/(.)\\1+/", "$1", $hash);
        $startIdx   = -1*$length - 2;
        $hash       = substr($hash, $startIdx, $length);
        return $hash;
    }

    public static function isMobile(){
        $userAgent= strtolower($_SERVER['HTTP_USER_AGENT']);
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$userAgent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($userAgent,0,4))) return true;
        return false;
    }
}