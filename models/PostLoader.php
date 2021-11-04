<?php
declare(strict_types=1);

class PostLoader
{
    private $post;
    private $fields;

    private $data = [];
    private $oldData = [];

    private const MAX_MSG = 20;

    public function __construct($post) {
        $this -> post = $post;
        $this -> fields = $post -> getFields();
    }

    public function setEmotes($string)
    {
        $emotes = [
            ":)" => '😀',
            ":-)" => '😀',
            ":D" => '😁',
            ":-D" =>'😁',
            ":'D" => '😂',
            "O)" => '😇',
            "O-)" => '😇',
            ";-)" => '😉',
            ";)" => '😉',
            ":-o" => '😮',
            ":o" => '😮',
            ":(" => '☹',
            ":-(" => '☹',
            ":@" => '🤬',
            ":-@" => '🤬',
            ':#' => '😶',
            ':&' => '😶',
            ':-#' => '😶',
            ':-&' => '😶',
            ':-X' => '😶',
            ':X' => '😶',
            'o/' => '👋',
            '</3' => '💔',
            '<3' => '💗'
        ];

        $find = array_keys($emotes);
        $replace = array_values($emotes);

        return str_ireplace($find, $replace, $string);
    }

    public function setContent($content)
    {
        // https://promptapi.com/marketplace/description/bad_words-api#documentation-tab
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.promptapi.com/bad_words?censor_character=*",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            // It works, trust me
            // But I won't share this key
            "apikey: ******"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $content
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response) -> censored_content;

        return $result;
    }

    public function setDecoded()
    {
        $this -> data = Array (
            $this -> fields[0] => $this -> setEmotes($this -> post -> getTitle()),
            $this -> fields[1] => $this -> setEmotes($this -> post -> getDate()),
            $this -> fields[2] => $this -> setContent($this -> setEmotes($this -> post -> getContent())),
            $this -> fields[3] => $this -> setEmotes($this -> post -> getAuthor())
        );

        $jsonData = file_get_contents("data.json");
        $decode = json_decode($jsonData, true);

        if (isset($decode['data'])) {
            $this -> oldData = $decode['data'];
            array_unshift($this -> oldData, $this -> data);
        } else $this -> oldData = [0 => $this -> data];
    }

    public function setEncoded()
    {
        $this -> setDecoded();

        if (count($this -> oldData) > self::MAX_MSG) {
            array_pop($this->oldData);
            $json = json_encode(array("data" => $this -> oldData));
        } else $json = json_encode(array("data" => $this -> oldData));

        file_put_contents("data.json", $json);
    }
}