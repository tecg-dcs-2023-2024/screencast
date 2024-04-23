<?php

// Seed tables
echo 'Seeding User table'.PHP_EOL;

$password = password_hash('ch4nge_th1s', PASSWORD_DEFAULT);
$users = [
    ['email' => 'dominique.vilain@hepl.be', 'password' => $password],
    ['email' => 'daniel.schreurs@hepl.be', 'password' => $password],
];
$insert_user_in_users_table_sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
$insert_user_in_users_table_stmt = $db->prepare($insert_user_in_users_table_sql);
foreach ($users as $user) {
    $insert_user_in_users_table_stmt->bindValue('email', $user['email']);
    $insert_user_in_users_table_stmt->bindValue('password', $user['password']);
    $insert_user_in_users_table_stmt->execute();
}
$count_users = count($users);
echo "User table seeded with {$count_users} users".PHP_EOL;

echo 'Seeding Jiri table'.PHP_EOL;
$jiris = [
    ['name' => 'Projets Web 2024', 'starting_at' => '2024-01-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Design Web 2024', 'starting_at' => '2024-06-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Design Web 2022', 'starting_at' => '2022-06-19 08:30:00', 'user_id' => '2'],
    ['name' => 'Design Web 2021', 'starting_at' => '2021-06-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Projets Web 2025', 'starting_at' => '2025-01-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Projets Web 2026', 'starting_at' => '2026-01-19 08:30:00', 'user_id' => '2'],
    ['name' => 'Projets Web 2027', 'starting_at' => '2027-01-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Design Web 2023', 'starting_at' => '2023-06-19 08:30:00', 'user_id' => '2'],
];
$insert_jiri_in_jiris_table_sql = 'INSERT INTO jiris (name, starting_at, user_id) VALUES (:name, :starting_at, :user_id)';
$insert_jiri_in_jiris_table_stmt = $db->prepare($insert_jiri_in_jiris_table_sql);
foreach ($jiris as $jiri) {
    $insert_jiri_in_jiris_table_stmt->bindValue('name', $jiri['name']);
    $insert_jiri_in_jiris_table_stmt->bindValue('starting_at', $jiri['starting_at']);
    $insert_jiri_in_jiris_table_stmt->bindValue('user_id', $jiri['user_id']);
    $insert_jiri_in_jiris_table_stmt->execute();
}
$count_jiris = count($jiris);
echo "Jiri table seeded with {$count_jiris} jiris".PHP_EOL;


