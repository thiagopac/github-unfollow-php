<?php

require 'GitHub.php';

function main($token, $whitelist) {
    $gitHub = new GitHub($token);
    $currentPage = 1;

    while (true) {
        $followed = $gitHub->followedUsers($currentPage);
        if (!$followed) {
            break;
        }

        foreach ($followed as $user) {

            $targetUser = $user['login'];
            if (!in_array($targetUser, $whitelist)) {
                $followsBack = $gitHub->checkFollowBack($targetUser);
                if (!$followsBack) {
                    $gitHub->unfollowUser($targetUser);
                }
            }
        }

        $currentPage++;
    }

    echo "Unfollow script completed.\n";
}

if ($argc < 2) {
    echo "Usage: php unfollow.php <TOKEN> [user1 user2 user3 ...]\n";
    exit(1);
}

$token = $argv[1];
$whitelist = array_slice($argv, 2);
main($token, $whitelist);
