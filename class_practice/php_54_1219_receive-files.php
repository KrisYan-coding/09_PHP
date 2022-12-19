
<?php

header('Content-Type: application/json');

echo json_encode($_FILES);


// one file for a key--
// request: 
// POST
// body -> form-data -> key='avatar', type=file -> choose file
// {
//     "avatar": {
//         "name": "batman.jpg",
//         "full_path": "batman.jpg",
//         "type": "image/jpeg",
//         "tmp_name": "C:\\xampp\\tmp\\php1244.tmp", -> 暫存，期限只到此 php 執行完
//         "error": 0,
//         "size": 174638
//     }
// }

// multiple file for a key--
// request: 
// POST
// body -> form-data -> key='avatar[]', type=file -> choose files
// {
//     "avatar": {
//         "name": [
//             "1.png",
//             "4.png"
//         ],
//         "full_path": [
//             "1.png",
//             "4.png"
//         ],
//         "type": [
//             "image/png",
//             "image/png"
//         ],
//         "tmp_name": [
//             "C:\\xampp\\tmp\\phpBEBE.tmp",
//             "C:\\xampp\\tmp\\phpBEBF.tmp"
//         ],
//         "error": [
//             0,
//             0
//         ],
//         "size": [
//             49648,
//             41099
//         ]
//     }
// }
?>