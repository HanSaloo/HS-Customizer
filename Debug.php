<?php

class Debug
{
    function DDoSPost(){


//    $faker = Faker\Factory::create();
//        for ($i = 0; $i <500; $i++) {
////            $fname = $faker->firstName;
////            $lname = $faker->lastName;
//            $phone = $faker->phoneNumber;
////            $email = $faker->email;
////            $company = $faker->company;
////            $website = $faker->word;
////            $city = $faker->;
//            $domain = $faker->domainName;
//            $industry = $faker->word;
//            $name = $faker->company;
//            $dealname = $faker->name;
//            $amount = $faker->randomNumber();
//            $closedate = $faker->date;
//            $stage = $faker->randomNumber(1,4);
////            $priority = $faker->random('HIGH','LOW','MEDIUM');
////            $Tpriority = mb_strtoupper($priority);
//            $subject = $faker->word;


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/ticket?limit=100&archived=false&hapikey='.HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 5000,
            CURLOPT_TIMEOUT => 2,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true)['results'];
        $filename = "tickets.json";
//    $file = file_get_contents('contacts.json');
        foreach ($response as $key => $arr) {
//        var_dump($arr);
//$encArr = json_decode($arr, true);
//var_dump($encArr);
//        file_put_contents('contacts.json',$encArr);

//    $taskList = json_decode($file,TRUE);
//    $taskList[] = array('name'=>$name);
        }
        $encArr = json_encode($response, JSON_PRETTY_PRINT);
        $fp = fopen($filename,"w");
        fputs($fp,$encArr);
        fclose($fp);






//    unset($taskList);


//    //names list
//            $res = json_decode($response, true)['results'];
////                var_dump($res);
//            foreach ($res as $array) {
//                $namesArr[$array['id']] = $array['properties']['name'];
////            $array['id'] - id of current name
//            }
//            $finalID = 0;
//            echo "Copy associate id:\n";
//            print_r($namesArr);


    }
}