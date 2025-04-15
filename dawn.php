<?php


$authFile = 'dawn.json';

if (file_exists($authFile)) {
    $auth = trim(file_get_contents($authFile));
    echo "Data yang disimpan sebelumnya :\n";
    echo "Auth : " . $auth . "\n\n";
} else {
    echo "Masukkan auth disini : ";
    $token = trim(fgets(STDIN));


    if (file_put_contents($authFile, $token)) {
        echo "Data berhasil disimpan ke data.json\n\n";
        $auth = $token;
    } else {
        echo "Gagal menyimpan data\n";
    }
       exit;
echo "Auth token kadaluarsa. Masukkan auth token baru : ";
$auth = trim(fgets(STDIN));
if (file_put_contents($authFile, $auth)) {
 echo "Auth token diperbarui dan disimpan ke data.json \n";
 } else {
 echo "Gagal memperbarui auth token \n";
 exit;
 }
}
sleep(3);
system("clear");

while(true){




$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.aeropres.in/api/atom/v1/userreferral/getpoint?appid=674a8f1a547b228648656d78',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36',
    'content-type: application/json',
    'authorization: Berear ' . $auth,
    'origin: chrome-extension://fpdkjdnhkakefebpekbdhillbhonfjjp',
    'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
    'if-none-match: W/"33c-MoVroSaR6zHfp+lf1NpRqoWIDJs"',
  ],
]);

$res = curl_exec($curl);
$json = json_decode($res);

echo "Login  : " . ($json->message ?? 'N/A');
echo "\n";
echo "ID     : " . ($json->data->referralPoint->_id ?? 'N/A') . "\n";
echo "Streak : " . ($json->data->rewardPoint->activeStreak ?? 'N/A') . "\n";
echo "Points : " . ($json->data->rewardPoint->points ?? 'N/A') . "\n";
echo "Bonus  : " . ($json->data->rewardPoint->bonus_points ?? 'N/A') . "\n";
echo "Sync   : " . ($json->data->rewardPoint->isNewPointSync ?? 'N/A') . "\n";
echo "Active : " . ($json->data->rewardPoint->active_status ?? 'N/A');
echo "\n";
echo "Server : " . ($json->servername ?? 'N/A');
echo "\n\n";

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://www.aeropres.in/chromeapi/dawn/v1/userreward/keepalive?appid=674a8f1a547b228648656d78',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"username":"youremail","extensionid":"fpdkjdnhkakefebpekbdhillbhonfjjp","numberoftabs":0,"_v":"1.1.1"}',
  CURLOPT_HTTPHEADER => [
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36',
    'Content-Type: application/json',
    'authorization: Berear ' . $auth,
    'origin: chrome-extension://fpdkjdnhkakefebpekbdhillbhonfjjp',
    'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
  ],
]);

$reward = curl_exec($curl);
$json = json_decode($reward);

echo "Reward  : " . ($json->success ?? 'N/A') . "\n";
echo "Message : " . ($json->message ?? 'N/A') . "\n";
echo "\n";
sleep(5);


}
