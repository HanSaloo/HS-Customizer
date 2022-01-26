<?php
const HAPIKEY = "eu1-b68e-599d-4807-a510-185ab00f80ee";
const OWNER_ID = "237972720";
require_once 'vendor/autoload.php';
require_once 'Debug.php';

class Connect
{
    public function SwitchManager()
    {
        echo "1 - Create custom Contact \n";
        echo "2 - Create custom Deal \n";
        echo "3 - Create custom Company \n";
        echo "4 - Create custom Ticket \n";
//        echo "5 - Create custom Note \n";
        $i = readline();
        echo "Enter count of operation\n";
        $counter = readline();
        switch ($i) {
            case 1:
                $this->PutContact($counter);
                break;
            case 2:
                $this->PutDeal($counter);
                break;
            case 3:
                $this->PutCompany($counter);
                break;
            case 4:
                $this->PutTicket($counter);
                break;
            case 5:
                $this->NoteLinker($counter);
                break;

            case 99:

                break;
        }
    }

    function PutContact($counter)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $counter; $i++) {
            $fname = $faker->firstName;
            $lname = $faker->lastName;
            $phone = $faker->phoneNumber;
            $email = $faker->email;
            $company = $faker->company;
            $website = $faker->word;
            $postArrJson = '{
              "properties": {
                "company": "' . $company . '",
                "email": "' . $email . '",
                "firstname": "' . $fname . '",
                "lastname": "' . $lname . '",
                "phone": "' . $phone . '",
                "website": "' . $website . '" } }';
            $this->Request('contacts', 'POST', $postArrJson);
        }
    }

    function PutDeal($counter)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $counter; $i++) {
            $dealname = $faker->name;
            $amount = $faker->randomNumber();
            $closedate = $faker->date;
            $postArrJson = '{
                    "properties": {
                    "amount": "' . $amount . '",
                    "closedate": "' . $closedate . '",
                    "dealname": "' . $dealname . '",
                    "dealstage": "appointmentscheduled",
                    "hubspot_owner_id": "' . OWNER_ID . '",
                    "pipeline": "default"}}';
            $this->Request('deals', 'POST', $postArrJson);
        }
    }

    function PutCompany($counter)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $counter; $i++) {
            $city = $faker->city;
            $domain = $faker->domainName;
            $industry = $faker->word;
            $name = $faker->company;
            $phone = $faker->phoneNumber;
            $state = $faker->state();
            $postArrJson = '{
                    "properties": {
                        "city": "' . $city . '",
                        "domain": "' . $domain . '",
                        "industry": "' . $industry . '",
                        "name": "' . $name . '",
                        "phone": "' . $phone . '",
                        "state": "' . $state . '"}}';
            $this->Request('companies', 'POST', $postArrJson);
        }
    }

    function PutTicket($counter)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $counter; $i++) {
            $stage = $faker->randomNumber(1, 4);
            $priority = ['HIGH', 'LOW', 'MEDIUM'];
            shuffle($priority);
            $randObj = array_rand($priority, 2);
            $Tpriority = $priority[$randObj[1]];
            $subject = $faker->word;
            $postArrJson = '{
                  "properties": {
                    "hs_pipeline": "0",
                    "hs_pipeline_stage": "' . $stage . '",
                    "hs_ticket_priority": "' . $Tpriority . '",
                    "hubspot_owner_id": "' . OWNER_ID . '",
                    "subject": "' . $subject . '"}}';
            $this->Request('tickets', 'POST', $postArrJson);
        }
    }

    function PutNote($counter)
    {
        for ($i = 0; $i < $counter; $i++) {
            $faker = Faker\Factory::create();
            $body = $faker->text;
            $postArrJson = '{
  "properties": {
    "hs_timestamp": "2019-10-30T03:30:17.883Z",
    "hs_note_body": "' . $body . '",
    "hubspot_owner_id": "' . OWNER_ID . '" } }';
            $this->Request('notes', 'POST', $postArrJson);

        }
    }

    function NoteLinker($counter)
    {

        $response = $this->PutNote($counter);
        var_dump($response);
//            $res = json_decode($responseNote, true);
//
//            $note_id = 0;
//            foreach ($res as $key => $val) {
//                if ($key == 'id') {
//                    $note_id = $val;
//                }
//            }
///// ////////////////////////////////ASSOCIATING NOTE
//            echo "Begin randomize association \n";
//
//            $Obj = ['contacts.json', 'company.json', 'deals.json', 'tickets.json'];
//            shuffle($Obj);
//            $randObj = array_rand($Obj, 2);
//            $file = $Obj[$randObj[1]];
//
//            if ($file == 'company.json') {
//                $toOjb = 'companies';
//                $toNote = 'company';
//            } elseif ($file == 'contacts.json') {
//                $toOjb = 'contacts';
//                $toNote = 'contact';
//            } elseif ($file == 'deals.json') {
//                $toOjb = 'deals';
//                $toNote = 'deal';
//            } elseif ($file == 'tickets.json') {
//                $toOjb = "tickets";
//                $toNote = 'ticket';
//            }
//
//            $responceAss = file_get_contents($file, 1);
//
//            $res = json_decode($responceAss, true);
//            foreach ($res as $array) {
//                $keys[] = $array['id'];
//            }
//
//            shuffle($keys);
//            $randObj = array_rand($keys, 2);
//            $endKey = $keys[$randObj[1]];
//
//
//            $curl = curl_init();
//
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/' . $toOjb . '/' . $endKey . '/associations/notes/' . $note_id . '/' . $toNote . '_to_note?hapikey=' . HAPIKEY,
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => '',
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => 'PUT',
//            ));
//
//            $responseAss = curl_exec($curl);
//
//            curl_close($curl);
//            $res = json_decode($responseAss, true);
////        var_dump($res);
//            var_dump($endKey);
//            echo "\n";
//        }
    }

    function Request(string $toObj, string $requestType, string $postArrJson)
    {
        $toObj = strtolower($toObj);
        $requestType = strtoupper($requestType);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/' . $toObj . '?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 100,
            CURLOPT_TIMEOUT => 2,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_POSTFIELDS => $postArrJson,

            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $res = json_decode($response, true);
//            print_r($res);
        return $res;
    }

}