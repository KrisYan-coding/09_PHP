
<?php

header('Content-Type: application/json');

$success = false;
$error = '';
$note = empty($_FILES['avatar']);

// 後端沒送檔案，沒有key--
if($note){
    $error = '沒有檔案';
    echo json_encode([
        'success' => $success,
        'FILES' => $_FILES,
        'error' => $error,
        'note' => $note
    ]);
    exit;

}

if (!empty($_FILES['avatar']) and $_FILES['avatar']['name'] === ''){
    $error = '沒有檔案';
    echo json_encode([
        'success' => $success,
        'FILES' => $_FILES,
        'error' => $error,
        'note' => $note
    ]);
    exit;
}

if (!empty($_FILES['avatar']) and is_string($_FILES['avatar']['name'])) { // string: 1 file; array: multiple files

    // move_uploaded_file 只能針對上傳的檔案--
    if (move_uploaded_file(
        $_FILES['avatar']['tmp_name'],
        './../uploads/' . $_FILES['avatar']['name']
    )) {
        $success = true;
    } else {
        $error = '無法搬移';
    };
};



echo json_encode([
    'success' => $success,
    'FILES' => $_FILES,
    'error' => $error,
    'note' => $note
]);


?>