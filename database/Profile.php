<?php

function completeProfile($data) {
    global $con;

    $fullName = htmlspecialchars($data["inputFullName"]);
    $phoneNumber = htmlspecialchars($data["inputPhoneNumber"]);
    $address = htmlspecialchars($data["inputAddress"]);

    $query = "UPDATE users
                SET user_fullname='$fullName', user_phone='$phoneNumber', user_address='$address'
                WHERE user_id={$_SESSION['user']}
            ";
    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}