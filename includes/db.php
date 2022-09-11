<?php

function insert($name, $city, $email, $tel)
{
    global $wpdb;
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $name = $name;
    $email = $email;
    $tel = $tel;
    $city = $city;
    $mysql_query = "SELECT * FROM  repairman WHERE email = $email";

    //test if user already exists

    $dmtable = 'repairman';
    $my_part_ID = (bool)$wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(email) FROM repairman
                    WHERE email = %s LIMIT 1",
            $email
        )
    );

    echo $wpdb->last_query;
    echo "<br>";
    echo $wpdb->last_error;

    if ($my_part_ID) {
        echo "already exist";
    } else {
        $wpdb->insert('repairman', array('name' => $name, 'email' => $email, 'city' => $city, 'tel' => $tel), array('%s', '%s', '%s', '%s'));
        $wpdb->print_error();

        echo "New entry found";

    }

/*

if ($wpdb->get_row($mysql_query)) {
echo 'Username exists';
echo '<br>';
} else {
if ($wpdb->insert('repairman', array(
'name' => $name,
'email' => $email,
'city' => $city,
'phone' => $tel)) === true) {
echo "<div class='succesjs'>Thank you for
filling out your information,
we will be in contact shortly.</div>";
} else {
echo $wpdb->last_error;
}} //end test user exists

echo $wpdb->last_query;

 */

} //end insert