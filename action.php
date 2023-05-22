<?php
    $connect = new PDO("mysql:host=localhost;dbname=contact", "root", "");
    $received_data = json_decode(file_get_contents("php://input"));
    $data = array();
    if($received_data->action == 'fetchall')
    {
        $query = "
            SELECT * FROM contact_form 
            ORDER BY id DESC
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = $row;
        }
        echo json_encode($data);
    }
    if($received_data->action == 'insert')
    {
        $data = array(
            ':name' => $received_data->name,
            ':sex' => $received_data->sex,
            ':address' => $received_data->address,
            ':phone' => $received_data->phone,
            ':birth' => $received_data->birth
        );

        $query = "
            INSERT INTO contact_form 
            (name, sex, address, phone, birth) 
            VALUES (:name, :sex, :address, :phone, :birth)
        ";

        $statement = $connect->prepare($query);

        $statement->execute($data);

        $output = array(
            'message' => '新增成功'
        );

        echo json_encode($output);
    }
?>