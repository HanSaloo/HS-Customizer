<?php
const HAPIKEY = "eu1-b68e-599d-4807-a510-185ab00f80ee";
const OWNER_ID = "237972720";
require_once 'vendor/autoload.php';
require_once 'Debug.php';

class Connect
{
    public function SwitchManager()
    {
        echo "1 - Create custom Contact\n";
        echo "2 - Create custom Deal \n";
        echo "3 - Create custom Company \n";
        echo "4 - Create custom Ticket \n";
        echo "5 - Create custom Note \n";

//        echo "9 - debug zone\n\n";


        $i = readline();
        switch ($i) {
            case 1:
                $this->PutContact();
                break;
            case 2:
                $this->PutDeal();
                break;
            case 3:
                $this->PutCompany();
                break;
            case 4:
                $this->PutTicket();
                break;
            case 5:
                $this->PutNote();
                break;

//            case 66:
//
//                break;
            case 99:
                //dev zone
                $this->GetRandomID();

//                $debug = new Debug();
//                $debug->DDoSPost();
                break;
        }
    }

    function PutContact()
    {
        echo "Enter company:\n";
        $company = readline();
        echo "Enter e-mail:\n";
        $email = readline();
        echo "Enter First name;\n";
        $fname = readline();
        echo "Enter Last name:\n";
        $lname = readline();
        echo "Enter phone:\n";
        $phone = readline();
        echo "Enter website:\n";
        $website = readline();

        echo "\n\n";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/contacts?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "company": "' . $company . '",
    "email": "' . $email . '",
    "firstname": "' . $fname . '",
    "lastname": "' . $lname . '",
    "phone": "' . $phone . '",
    "website": "' . $website . '"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        print_r($response);
    }

    function PutDeal()
    {
        echo "Enter amount:\n";
        $amount = readline();
        echo "Enter close date:\n";
        $closedate = readline();
        echo "Enter deal name:\n";
        $dealname = readline();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/deals?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "amount": "' . $amount . '",
    "closedate": "' . $closedate . '",
    "dealname": "' . $dealname . '",
    "dealstage": "appointmentscheduled",
    "hubspot_owner_id": "' . OWNER_ID . '",
    "pipeline": "default"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }

    function PutCompany()
    {

        echo "Enter city:\n";
        $city = readline();
        echo "Enter domain:\n";
        $domain = readline();
        echo "Enter industry:\n";
        $industry = readline();
        echo "Enter name:\n";
        $name = readline();
        echo "Enter phone:\n";
        $phone = readline();
        echo "Enter state:\n";
        $state = readline();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/companies?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "city": "' . $city . '",
    "domain": "' . $domain . '",
    "industry": "' . $industry . '",
    "name": "' . $name . '",
    "phone": "' . $phone . '",
    "state": "' . $state . '"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response[] = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }

    function PutTicket()
    {

        echo "Enter ticket priority(low, medium of high):\n";
        $priority = readline();
        $Tpriority = mb_strtoupper($priority);
        echo "Enter stage (1 - new, 2 - Waiting on contact\n 3 - Waiting on us 4 - closed):\n";
        $stage = readline();
        echo "Enter subject:\n";
        $subject = readline();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/tickets?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "hs_pipeline": "0",
    "hs_pipeline_stage": "' . $stage . '",
    "hs_ticket_priority": "' . $Tpriority . '",
    "hubspot_owner_id": "' . OWNER_ID . '",
    "subject": "' . $subject . '"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        print_r($response);
    }

    function GetRandomID()
    {
//plan B
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/ticket?limit=100&archived=false&hapikey='.HAPIKEY,
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 5000,
//            CURLOPT_TIMEOUT => 2,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//
//        $res = json_decode($response, true)['results'];
//$res
        $Obj = ['contacts.json', 'company.json', 'deals.json', 'tickets.json'];
        shuffle($Obj);
        $randObj = array_rand($Obj, 2);
        $file = $Obj[$randObj[1]];

        $responce = file_get_contents($file, 1);

        $res = json_decode($responce, true);
        foreach ($res as $array) {
            $keys[] = $array['id'];
        }

        shuffle($keys);
        $randObj = array_rand($keys, 2);
        $endKey = $keys[$randObj[1]];
        return $endKey;
    }

    function PutNote()
    {
        ///////////////////GENERATING NOTE
//        echo "Enter your note:\n";
//        $body = readline();
        for ($i = 0; $i < 1000; $i++) {
            $faker = Faker\Factory::create();
            $body = $faker->text;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/notes?hapikey=' . HAPIKEY,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
  "properties": {
    "hs_timestamp": "2019-10-30T03:30:17.883Z",
    "hs_note_body": "' . $body . '",
    "hubspot_owner_id": "' . OWNER_ID . '"
  }
}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $responseNote = curl_exec($curl);
            curl_close($curl);
            $res = json_decode($responseNote, true);

            $note_id = 0;
            foreach ($res as $key => $val) {
                if ($key == 'id') {
                    $note_id = $val;
                }
            }

////////////////////////////////////
///
/// ////////////////////////////////ASSOCIATING NOTE
//todo 100 comp + 1000 company in file + 1000 contact + 1000 deal to comp
            echo "Begin randomize association \n";

            $Obj = ['contacts.json', 'company.json', 'deals.json', 'tickets.json'];
            shuffle($Obj);
            $randObj = array_rand($Obj, 2);
            $file = $Obj[$randObj[1]];

            if ($file == 'company.json'){
                $toOjb = 'companies';
                $toNote = 'company';
            }elseif ($file == 'contacts.json'){
                $toOjb = 'contacts';
                $toNote = 'contact';
            }elseif ($file == 'deals.json'){
                $toOjb = 'deals';
                $toNote = 'deal';
            }elseif ($file == 'tickets.json'){
                $toOjb = "tickets";
                $toNote = 'ticket';
            }

            $responceAss = file_get_contents($file, 1);

            $res = json_decode($responceAss, true);
            foreach ($res as $array) {
                $keys[] = $array['id'];
            }

            shuffle($keys);
            $randObj = array_rand($keys, 2);
            $endKey = $keys[$randObj[1]];


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/' . $toOjb . '/' . $endKey . '/associations/notes/' . $note_id . '/'.$toNote.'_to_note?hapikey=' . HAPIKEY,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
            ));

            $responseAss = curl_exec($curl);

            curl_close($curl);
        $res = json_decode($responseAss, true);
//        var_dump($res);
            var_dump($endKey);
            echo "\n";
        }
    }
}
