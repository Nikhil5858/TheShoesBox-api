<?php

$user_id = $_GET['user_id'];

$query = "SELECT o.id, o.user_id, o.rate, o.pro_size, o.quantity, o.totalprice, o.status, 
                 p.name AS product_name, p.pro_img AS pro_img, u.name AS user_name, a.address, a.city, a.state, a.pincode, a.phoneno
          FROM `order` o
          LEFT JOIN users u ON o.user_id = u.id
          LEFT JOIN product p ON o.product_id = p.id
          LEFT JOIN addressdetails a ON o.address_id = a.id
          WHERE o.user_id ='$user_id' ORDER BY o.id desc";

$response = select($query);

reply($response);
