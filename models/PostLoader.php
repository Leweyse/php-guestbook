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

        $this -> data = Array (
            $this -> fields[0] => $this -> post -> getTitle(),
            $this -> fields[1] => $this -> post -> getDate(),
            $this -> fields[2] => $this -> post -> getContent(),
            $this -> fields[3] => $this -> post -> getAuthor()
        );
    }

    public function setDecoded()
    {
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